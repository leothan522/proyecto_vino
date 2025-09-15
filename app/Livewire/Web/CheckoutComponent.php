<?php

namespace App\Livewire\Web;

use App\Models\Carrito;
use App\Traits\WebTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CheckoutComponent extends Component
{
    use WebTrait;

    public string $cedula;

    public function render()
    {
        $this->getItems();
        return view('livewire.web.checkout-component');
    }

    public function saveOrder(): void
    {
        $this->disableFtcoAnimate();
        LivewireAlert::title('Submit: '. $this->cedula)
            ->success()
            ->show();
    }

    #[On('getDatosFacturacion')]
    public function getDatosFacturacion($cedula): void
    {
        $this->disableFtcoAnimate();
        LivewireAlert::title('cedula: '.$cedula)
            ->info()
            ->show();
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
