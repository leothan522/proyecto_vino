<?php

namespace App\Traits;

use App\Models\Carrito;
use App\Models\Favorito;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;

trait WebTrait
{
    public bool $ftco_animate = true;
    public int $almacenes_id;
    public string $almacen;

    public int $col = 3;

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

    public function productAddCart($id): void
    {
        $this->disableFtcoAnimate();
        $rowquid = session('rowquid');
        $carrito = Carrito::where('rowquid', $rowquid)->where('productos_id', $id)->where('almacenes_id', $this->almacenes_id)->first();
        if ($carrito) {
            $carrito->cantidad++;
            $carrito->save();
        } else {
            $carrito = Carrito::create([
                'rowquid' => $rowquid,
                'productos_id' => $id,
                'almacenes_id' => $this->almacenes_id,
                'cantidad' => 1
            ]);
        }
        $cantidad = cerosIzquierda(formatoMillares($carrito->cantidad, 0));
        $this->dispatch('orderLastRefresh');
        LivewireAlert::title('Agregado 01 al Carrito')
            ->text("Llevas $cantidad en Total")
            ->toast()
            ->position('top')
            ->success()
            ->show();
    }

    public function productInCart($id): bool
    {
        $response = false;
        $rowquid = session('rowquid');
        if (Carrito::where('rowquid', $rowquid)->where('productos_id', $id)->where('almacenes_id', $this->almacenes_id)->exists()){
            $response = true;
        }
        return $response;
    }

    #[On('productRefresh')]
    public function productRefresh()
    {
        //Actualizar
    }

    public function updatingPage($page): void
    {
        // Runs before the page is updated for this component...
        $this->disableFtcoAnimate();
    }

}
