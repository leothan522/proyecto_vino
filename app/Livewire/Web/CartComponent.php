<?php

namespace App\Livewire\Web;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Traits\WebTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CartComponent extends Component
{
    use WebTrait;

    public mixed $items;

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
        $items->each(function ($item) {
            $item->is_invalid = $this->isInvalidStock($item->almacenes_id, $item->productos_id, $item->cantidad);
        });

        $isInvalid = $items->contains(fn($item) => $item['is_invalid']);

        if ($isInvalid) {
            LivewireAlert::title('¡Limite Alcanzado!')
                ->text("Tienes cantidades que exceden las piezas disponibles")
                ->info()
                ->withConfirmButton('Ok')
                ->timer(7000)
                ->show();
        } else {

            if (!Auth::check()) {
                $this->dispatch('initModalLogin', id: 0);
            }else{

                $pedidoPendiente = Pedido::where('users_id', auth()->id())->where('is_process', true)->exists();

                if (!$pedidoPendiente) {
                    $rowquid = Str::random();
                    if (Auth::user()->email_verified_at){
                        $checkout = $items->transform(function ($item){
                            unset($item['is_invalid']) ;
                            return $item;
                        });
                        $pedido = Pedido::create([
                            'total' => $this->total,
                            'rowquid' => session('rowquid'),
                            'users_id' => auth()->id(),
                            'almacenes_id' => session('order_almacenes_id'),
                        ]);
                        foreach ($checkout as $item) {
                            $item->checkout = true;
                            $item->save();
                        }
                        $rowquid = $pedido->rowquid;
                    }
                    $this->redirectRoute('web.checkout', $rowquid);
                } else {
                    LivewireAlert::title('¡No se puede Procesar!')
                        ->text("Tienes un pedido anterior incompleto, vaya a su cuenta y verifique.")
                        ->info()
                        ->withConfirmButton('Ok')
                        ->timer(7000)
                        ->show();
                }

            }

        }
    }

    public function removeCart($id): void
    {
        $this->disableFtcoAnimate();
        $rowquid = session('rowquid');
        $carrito = Carrito::where('rowquid', $rowquid)->where('productos_id', $id)->first();
        $carrito?->delete();
        $this->dispatch('orderLastRefresh');
        $carrito = Carrito::where('rowquid', $rowquid)->exists();
        if (!$carrito){
            session()->flash('livewireAlert_flast', [
                'title' => '¡Carrito Vacio!',
            ]);
            $this->redirectRoute('web.index');
        }
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
    public function setCantidad($item_id, $cantidad): void
    {
        $this->disableFtcoAnimate();
        $carrito = Carrito::find($item_id);
        if ($carrito) {
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
            session()->forget('order_almacenes_id');
            $this->redirectRoute('web.index');
        }
        $this->subtotal = $this->items->sum(fn($item) => $item->producto->precio * $item->cantidad);
        $parametro = getParametro('precio_delivery');
        $this->entrega = is_numeric($parametro) ? (float)$parametro : 0;
        $this->total = $this->subtotal + $this->entrega;
    }

    protected function getDisponibles($almacenes_id, $productos_id): int|string
    {
        $response = 0;
        $stock = $this->getStock($almacenes_id, $productos_id);
        if ($stock) {
            $response = $stock->disponibles > 0 ? $stock->disponibles : 0;
        }
        return cerosIzquierda(formatoMillares($response, 0));
    }

}
