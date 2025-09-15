<?php

namespace App\Livewire\Web;

use App\Models\Favorito;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class ModalLoginComponent extends Component
{
    public int $productos_id;
    public string $email;
    public string $password;

    public function render()
    {
        return view('livewire.web.modal-login-component');
    }

    #[On('initModalLogin')]
    public function initModalLogin($id): void
    {
        $this->productos_id = $id;
        $this->resetErrorBag();
        //JS
    }

    public function login(): void
    {
        $rules = [
            'email' => 'required|exists:users',
            'password' => 'required'
        ];
        $this->validate($rules);

        $user = User::where('email', $this->email)->first();
        if ($user) {
            if (password_verify($this->password, $user->password)) {

                //Inicia Sesion
                auth()->login($user);
                $url = isAdmin() ? route('filament.dashboard.pages.dashboard') : route('web.home');
                $this->dispatch('cerrarModalLoginFast', url: $url, name: $user->name);

                if ($this->productos_id){
                    //Agrega a Favoritos
                    $user = Auth::id();
                    if (!Favorito::where('users_id', $user)->where('productos_id', $this->productos_id)->exists()) {
                        Favorito::create([
                            'users_id' => $user,
                            'productos_id' => $this->productos_id
                        ]);
                    }

                    $this->dispatch('productRefresh');

                    LivewireAlert::title('Agregado a Favoritos')
                        ->toast()
                        ->success()
                        ->position('top')
                        ->show();
                }else{
                    //Proceder al pago
                    $this->dispatch('procesarPedido');
                }

            } else {
                $this->reset('password');
                LivewireAlert::title('¡Ups! Algo salió mal.')
                    ->text('Estas credenciales no coinciden con nuestros registros.')
                    ->warning()
                    ->timer(5000)
                    ->withConfirmButton('OK')
                    ->show();
            }
        }
    }

    #[On('cerrarModalLoginFast')]
    public function cerrarModalLoginFast($url, $name)
    {
        //JS
    }

    #[On('procesarPedido')]
    public function procesarPedido()
    {
        //JS
    }

}
