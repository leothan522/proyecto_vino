<?php

namespace App\Livewire\Web;

use App\Models\Parametro;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoPago;
use App\Models\PromotorPedido;
use App\Models\Stock;
use App\Traits\WebTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class HomePedidosComponent extends Component
{
    use WithPagination, WithoutUrlPagination;
    use WebTrait;

    public ?string $codigo = '';
    public ?string $cliente = '';
    public mixed $productos = [];
    public string $verSubtotal = '';
    public string $verEntrega = '';
    public string $verTotal = '';
    public ?string $telefono = '';
    public ?string $parroquia = '';
    public ?string $municipio = '';
    public ?string $direccion = '';
    public ?string $metodo = '';
    public ?string $referencia = '';
    public ?string $monto = '';
    public ?int $estatus = null;
    public ?string $created_at = '';
    public ?string $rowquid = null;
    public bool $is_process;
    public ?int $pedidos_id = null;
    public ?string $codigoEntrega = null;

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
            $this->dispatch('buttonModalPedidos');
            $this->codigo = $pedido->codigo ? '#'.$pedido->codigo : 'Incompleto';
            $this->cliente = Str::upper(formatoMillares($pedido->cedula, 0) .' - '.$pedido->nombre);
            $this->productos = PedidoItem::where('pedidos_id', $pedido->id)->get();
            $this->verSubtotal = formatoMillares($pedido->subtotal);
            $this->verEntrega = formatoMillares($pedido->entrega);
            $this->verTotal = formatoMillares($pedido->total);
            $this->telefono = $pedido->telefono;
            $this->municipio = Str::upper($pedido->bodega);
            $this->parroquia = Str::upper($pedido->parroquia);
            $this->direccion = Str::upper($pedido->direccion.' '.$pedido->direccion2);
            $pago = PedidoPago::where('pedidos_id', $pedido->id)->orderBy('created_at', 'desc')->first();
            if ($pago){
                $this->metodo = $pago->metodo == "tranferencias" ? $pago->metodo : 'Pago Móvil';
                $this->referencia = $pago->referencia;
                $this->monto = formatoMillares($pago->monto);
            }
            $this->estatus = $pedido->estatus;
            $this->created_at = $pedido->created_at;
            $this->reset('codigoEntrega');
            $parametro = Parametro::where('nombre', 'pedido_'.$pedido->rowquid)->first();
            if ($parametro && $pedido->estatus == 3){
                $this->codigoEntrega = $parametro->valor_texto;
            }
            $this->is_process = $pedido->is_process;
            $this->rowquid = $pedido->rowquid;
            $this->pedidos_id = $pedido->id;
            /*if ($pedido->is_process){
                $this->dispatch('showLoader');
                $this->redirectRoute('web.checkout', $pedido->rowquid);
            }*/
        }
    }

    public function irCheckout(): void
    {
        if ($this->is_process || $this->estatus == 6){
            $this->dispatch('showLoader');
            $this->redirectRoute('web.checkout', $this->rowquid);
        }
    }

    #[On('delete')]
    public function delete(): void
    {
        $pedido = Pedido::find($this->pedidos_id);
        if ($pedido){
            $items = $pedido->items;
            foreach ($items as $item){
                $stock = Stock::where('almacenes_id', $item->almacenes_id)->where('productos_id', $item->productos_id)->first();
                if ($stock){
                    $stock->disponibles = $stock->disponibles + $item->cantidad;
                    $stock->comprometidos = $stock->comprometidos >= $item->cantidad ? $stock->comprometidos - $item->cantidad : 0;
                    $stock->save();
                }
            }

            $promotor = PromotorPedido::where('pedidos_id', $pedido->id)->first();
            $promotor?->delete();

            $pedido->delete();
        }
    }

    #[On('buttonModalPedidos')]
    public function buttonModalPedidos()
    {
        //JS
    }

    protected function getPedidos(): \LaravelIdea\Helper\App\Models\_IH_Pedido_C|\Illuminate\Pagination\LengthAwarePaginator|array
    {
        return Pedido::where('users_id', auth()->id())->orderBy('created_at', 'desc')->paginate(6);
    }

}
