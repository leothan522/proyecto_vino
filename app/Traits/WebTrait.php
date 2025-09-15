<?php

namespace App\Traits;

use App\Models\Carrito;
use App\Models\Favorito;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;

trait WebTrait
{
    public bool $ftco_animate = true;
    public int $almacenes_id;
    public string $almacen;
    public int $col = 3;
    public mixed $subtotal;
    public mixed $total;
    public mixed $entrega;

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
            if ($favorito) {
                $favorito->delete();
                LivewireAlert::title('Eliminado de Favoritos')
                    ->toast()
                    ->info()
                    ->position('top')
                    ->show();
            } else {
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

        if (Auth::check()) {
            $user = Auth::id();
            if (Favorito::where('users_id', $user)->where('productos_id', $id)->exists()) {
                $response = true;
            }
        }

        return $response;
    }

    public function productAddCart($id, $input = null): void
    {
        $this->disableFtcoAnimate();
        //revertirDisponibles();
        $stock = $this->getStock($this->almacenes_id, $id);
        $max = $stock ? $stock->disponibles : 0;

        $rowquid = session('rowquid');
        $carrito = Carrito::where('rowquid', $rowquid)
            ->where('productos_id', $id)
            ->where('almacenes_id', $this->almacenes_id)
            ->first();
        if ($carrito) {
            if (is_null($input)){
                $carrito->cantidad++;
            }else{
                $carrito->cantidad = $carrito->cantidad + $input;
            }

        } else {
            $carrito = new Carrito();
            $carrito->rowquid = $rowquid;
            $carrito->productos_id = $id;
            $carrito->almacenes_id = $this->almacenes_id;
            if (is_null($input)){
                $carrito->cantidad = 1;
            }else{
                $carrito->cantidad = $input;
            }
        }

        if ($carrito->cantidad <= $max) {

            if (!session()->has('order_almacenes_id')){
                session(['order_almacenes_id' => $this->almacenes_id]);
            }

            if (session('order_almacenes_id') == $this->almacenes_id){
                $carrito->save();
                $cantidad = $input ? cerosIzquierda(formatoMillares($input, 0)) : '01';
                $total = cerosIzquierda(formatoMillares($carrito->cantidad, 0));
                $this->dispatch('orderLastRefresh');
                LivewireAlert::title("Agregado $cantidad al Carrito")
                    ->text("Llevas $total en Total")
                    ->toast()
                    ->position('top')
                    ->success()
                    ->show();
            }else{
                LivewireAlert::title('¡No se puede agregar!')
                    ->text("Todos los productos del carrito deben ser de la misma Bodega")
                    ->info()
                    ->withConfirmButton('Ok')
                    ->timer(5000)
                    ->show();
            }

        } else {
            $total = $max > 0 ? cerosIzquierda(formatoMillares($max, 0)) : 0;
            LivewireAlert::title('¡Limite Alcanzado!')
                ->text("$total piezas disponibles")
                ->info()
                ->withConfirmButton('Ok')
                ->timer(5000)
                ->show();
        }


    }

    public function productInCart($id): bool
    {
        $response = false;
        $rowquid = session('rowquid');
        if (Carrito::where('rowquid', $rowquid)->where('productos_id', $id)->where('almacenes_id', $this->almacenes_id)->exists()) {
            $response = true;
        }
        return $response;
    }

    public function productIsAgotado($id): bool
    {
        $response = true;
        $stock = $this->getStock($this->almacenes_id, $id);
        if ($stock){
            $response = is_null($stock->disponibles) || $stock->disponibles < 1;
        }
        return $response;
    }

    public function updatingPage($page): void
    {
        // Runs before the page is updated for this component...
        $this->disableFtcoAnimate();
    }

    protected function getStock($almacenes_id, $productos_id): ?Stock
    {
        return Stock::where('almacenes_id', $almacenes_id)->where('productos_id', $productos_id)->first();
    }

    #[On('productRefresh')]
    public function productRefresh()
    {
        //Actualizar
    }

}
