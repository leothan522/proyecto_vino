<?php

namespace App\Traits;

use App\Models\Favorito;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;

trait WebTrait
{
    public bool $ftco_animate = true;
    public int $almacenes_id;
    public string $almacen;
    public mixed $productos;

    public function disableFtcoAnimate(): void
    {
        $this->ftco_animate = false;
    }

    public function productShow($id): void
    {
        $this->disableFtcoAnimate();
        session(['almacenes_id' => $this->almacenes_id]);
        $this->redirectRoute('web.single', $id);
    }

    public function productAddFavorite($id): void
    {
        $this->disableFtcoAnimate();
        if (!Auth::check()) {
            $this->dispatch('initModalLogin', id: $id);
        } else {
            $user = Auth::id();
            $favorito = Favorito::where('users_id', $user)->where('productos_id', $id)->first();
            if ($favorito){
                $favorito->delete();
                LivewireAlert::title('Eliminado de Favoritos')
                    ->toast()
                    ->info()
                    ->position('top')
                    ->show();
            }else{
                Favorito::create([
                    'users_id' => $user,
                    'productos_id' => $id
                ]);
                LivewireAlert::title('Agregado a Favoritos')
                    ->toast()
                    ->success()
                    ->position('top')
                    ->show();
            }
        }

    }

    public function productIsFavorite($id): bool
    {
        $response = false;

        if (Auth::check()){
            $user = Auth::id();
            if (Favorito::where('users_id', $user)->where('productos_id', $id)->exists()){
                $response = true;
            }
        }

        return $response;
    }

    #[On('actualizar')]
    public function actualizar()
    {
        //Actualizar
    }

}
