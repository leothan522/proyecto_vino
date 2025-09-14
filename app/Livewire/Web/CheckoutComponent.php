<?php

namespace App\Livewire\Web;

use App\Models\Carrito;
use App\Traits\WebTrait;
use Livewire\Component;

class CheckoutComponent extends Component
{
    use WebTrait;

    public function render()
    {
        $this->getItems();
        return view('livewire.web.checkout-component');
    }

    protected function getItems(): void
    {
        $rowquid = session('rowquid');
        $carrito = Carrito::where('rowquid', $rowquid)->where('checkout', true)->get();
        if ($carrito->isEmpty()) {
            $this->redirectRoute('web.cart');
        }
        $this->subtotal = $carrito->sum(function ($item) {
            return $item->producto->precio * $item->cantidad;
        });
        $parametro = getParametro('precio_delivery');
        $this->entrega = is_numeric($parametro) ? (float)$parametro : 0;
        $this->total = $this->subtotal + $this->entrega;
    }

}
