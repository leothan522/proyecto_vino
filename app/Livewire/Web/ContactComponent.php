<?php

namespace App\Livewire\Web;

use App\Models\Mensaje;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class ContactComponent extends Component
{
    public string $nombre;
    public string $email;
    public string $asunto;
    public string $mensaje;

    public function mount(): void
    {
        $this->nombre = auth()->check() ? auth()->user()->name : '';
        $this->email = auth()->check() ? auth()->user()->email : '';
    }

    public function render()
    {
        return view('livewire.web.contact-component');
    }

    public function sendMessage(): void
    {
        $rules = [
            'nombre' => 'required',
            'email' => 'required',
            'asunto' => 'required',
            'mensaje' => 'required',
        ];
        $this->validate($rules);

        $fecha = now();
        $users_id = auth()->check() ? auth()->id() : null;
        Mensaje::create([
            'fecha' => $fecha,
            'nombre' => $this->nombre,
            'email' => $this->email,
            'asunto' => $this->asunto,
            'mensaje' => $this->mensaje,
            'users_id' => $users_id,
        ]);

        $this->resetErrorBag();
        $this->reset(['asunto', 'mensaje']);
        LivewireAlert::title('¡Mensaje Enviado!')
            ->success()
            ->text('Gracias por escribirnos, nos contactaremos contigo a la brevedad posible.')
            ->withConfirmButton('OK')
            ->timer(7000)
            ->show();
    }


}
