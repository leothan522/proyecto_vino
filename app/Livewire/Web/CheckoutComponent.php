<?php

namespace App\Livewire\Web;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Traits\WebTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CheckoutComponent extends Component
{
    use WebTrait;

    public string $rowquid;
    public string $cedula;

    public function mount($rowquid): void
    {
        $this->rowquid = $rowquid;
    }

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
        $pedido = $this->getPedido();
        if (!$pedido) {
            $this->redirectRoute('web.index');
        }
        $items = PedidoItem::where('pedidos_id', $pedido->id)->get();
        $this->subtotal = $items->sum(function ($item) {
            return $item->precio * $item->cantidad;
        });
        $parametro = getParametro('precio_delivery');
        $this->entrega = is_numeric($parametro) ? (float)$parametro : 0;
        $this->total = $this->subtotal + $this->entrega;
    }

    protected function getPedido(): ?Pedido
    {
        return Pedido::where('rowquid', $this->rowquid)->where('users_id', auth()->id())->first();
    }

}
