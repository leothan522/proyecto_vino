<?php

namespace App\Livewire\Web;

use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoPago;
use App\Traits\WebTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class HomePedidosComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    use WebTrait;

    public string $codigo = '';
    public string $cliente = '';
    public mixed $productos = [];
    public string $verSubtotal = '';
    public string $verEntrega = '';
    public string $verTotal = '';
    public string $telefono = '';
    public string $parroquia = '';
    public string $municipio = '';
    public string $direccion = '';
    public string $metodo = '';
    public string $referencia = '';
    public string $monto = '';
    public mixed $estatus = null;
    public mixed $created_at = '';

    public function render()
    {
        return view('livewire.web.home-pedidos-component')
            ->with('pedidos', $this->getPedidos());
    }

    public function show($id): void
    {
        $this->disableFtcoAnimate();
        $pedido = Pedido::find($id);
        if ($pedido){
            if ($pedido->is_process){
                $this->redirectRoute('web.checkout', $pedido->rowquid);
            }else{
                $this->dispatch('buttonModalPedidos');
                $this->codigo = $pedido->codigo;
                $this->cliente = formatoMillares($pedido->cedula, 0) .' - '.$pedido->nombre;
                $this->productos = PedidoItem::where('pedidos_id', $pedido->id)->get();
                $this->verSubtotal = formatoMillares($pedido->subtotal);
                $this->verEntrega = formatoMillares($pedido->entrega);
                $this->verTotal = formatoMillares($pedido->total);
                $this->telefono = $pedido->telefono;
                $this->municipio = Str::upper($pedido->bodega);
                $this->parroquia = Str::upper($pedido->parroquia);
                $this->direccion = Str::upper($pedido->direccion.' '.$pedido->direccion2);
                $pago = PedidoPago::where('pedidos_id', $pedido->id)->first();
                if ($pago){
                    $this->metodo = $pago->metodo == "tranferencias" ? $pago->metodo : 'Pago Móvil';
                    $this->referencia = $pago->referencia;
                    $this->monto = formatoMillares($pago->monto);
                }
                $this->estatus = $pedido->estatus;
                $this->created_at = $pedido->created_at;
            }
        }
    }

    #[On('buttonModalPedidos')]
    public function buttonModalPedidos()
    {
        //JS
    }

    protected function getPedidos(): \LaravelIdea\Helper\App\Models\_IH_Pedido_C|\Illuminate\Pagination\LengthAwarePaginator|array
    {
        return Pedido::where('users_id', auth()->id())->orderBy('created_at', 'desc')->paginate(12);
    }

}
