<?php

namespace App\Livewire\Web;

use App\Models\Carrito;
use App\Traits\WebTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CartComponent extends Component
{
    use WebTrait;

    public bool $ocultar = false;

    public mixed $items;
    public mixed $subtotal;
    public mixed $total;
    public mixed $entrega;

    public function render()
    {
        $this->getItems();
        return view('livewire.web.cart-component');
    }

    public function checkOut(): void
    {
        $this->disableFtcoAnimate();
        $rowquid = session('rowquid');
        $items = Carrito::where('rowquid', $rowquid)->get();
        $items->each(function ($item){
            $item->is_invalid = $this->isInvalidStock($item->almacenes_id, $item->productos_id, $item->cantidad);
        });

        $isInvalid = $items->contains(fn($item) => $item['is_invalid']);

        if ($isInvalid){
            LivewireAlert::title('¡Limite Alcanzado!')
                ->text("Tienes cantidades que exceden las piezas disponibles")
                ->info()
                ->withConfirmButton('Ok')
                ->timer(7000)
                ->show();
        }else{
            $checkout = $items->transform(function ($item){
               unset($item['is_invalid']) ;
               return $item;
            });
            foreach ($checkout as $item){
                $item->checkout = true;
                $item->save();
                //descuento el stock disponible
                $stock = $this->getStock($item->almacenes_id, $item->productos_id);
                $stock->disponibles = $stock->disponibles - $item->cantidad;
                $stock->comprometidos = $stock->comprometidos + $item->cantidad;
                $stock->save();
            }
            $this->redirectRoute('web.checkout');
        }
    }

    public function removeCart($id): void
    {
        $this->disableFtcoAnimate();
        $rowquid = session('rowquid');
        $carrito = Carrito::where('rowquid', $rowquid)->where('productos_id', $id)->first();
        $carrito?->delete();
        $this->dispatch('orderLastRefresh');
    }

    public function isInvalidStock($almacenes_id, $productos_id, $cantidad): bool
    {
        $response = true;
        $stock = $this->getStock($almacenes_id, $productos_id);
        if ($stock && $cantidad > 0) {
            $max = $stock->disponibles;
            if ($cantidad <= $max) {
                $response = false;
            }
        }
        return $response;
    }

    #[On('setCantidad')]
    public function setCantidad($cantidad, $id, $original): void
    {
        $this->disableFtcoAnimate();
        $carrito = Carrito::find($id);
        if ($carrito && $cantidad > 0) {
            $carrito->cantidad = $cantidad;
            $carrito->save();
            $this->dispatch('orderLastRefresh');
        }
    }

    protected function getItems(): void
    {
        $rowquid = session('rowquid');
        $carrito = Carrito::where('rowquid', $rowquid);
        $this->items = $carrito->get();
        if ($this->items->isEmpty()) {
            session()->flash('livewireAlert_flast', [
                'title' => '¡Carrito Vacio!',
            ]);
            $this->redirectRoute('web.index');
        }
        $this->subtotal = $this->items->sum(function ($item) {
            return $item->producto->precio * $item->cantidad;
        });
        $parametro = getParametro('precio_delivery');
        $this->entrega = is_numeric($parametro) ? (float)$parametro : 0;
        $this->total = $this->subtotal + $this->entrega;
    }

    protected function getDisponibles($almacenes_id, $productos_id): int|string
    {
        $response = 0;
        $stock = $this->getStock($almacenes_id, $productos_id);
        if ($stock){
            $response = $stock->disponibles > 0 ? $stock->disponibles : 0;
        }
        return cerosIzquierda(formatoMillares($response, 0));
    }

}
