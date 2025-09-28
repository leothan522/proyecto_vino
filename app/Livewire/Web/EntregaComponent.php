<?php

namespace App\Livewire\Web;

use App\Models\Parametro;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoPago;
use App\Traits\WebTrait;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Component;

class EntregaComponent extends Component
{
    use WebTrait;

    public string $rowquid;
    public bool $verPedido = false;
    public bool $verSuccess = false;
    public bool $verError = false;

    public int $parametros_id;
    public int $pedidos_id;

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

    public $digitos = ['', '', '', '', '', ''];

    public function mount($rowquid): void
    {
        $this->rowquid = $rowquid;
        $this->getPedido();
    }

    public function render()
    {
        return view('livewire.web.entrega-component');
    }

    public function updatedDigitos(): void
    {
        $this->disableFtcoAnimate();
        foreach ($this->digitos as $i => $valor) {
            // Solo conservar el primer dígito numérico
            $this->digitos[$i] = preg_replace('/\D/', '', substr($valor, 0, 1));
        }
    }


    public function enviar(): void
    {
        $this->disableFtcoAnimate();
        $codigo = implode('', $this->digitos);

        if (strlen($codigo) !== 6 || !ctype_digit($codigo)) {
            $this->addError('codigo', 'El código debe tener 6 dígitos numéricos.');
            $this->resetCodigo(); // ← aquí limpias y reenfocas

            return;
        }

        // Buscar por ID y comparar con la columna valor_codigo
        $parametro = Parametro::find($this->parametros_id);
        if (!$parametro || $parametro->valor_texto !== $codigo){
            $this->addError('codigo', 'El código ingresado no es válido.');
            $this->resetCodigo(); // ← también aquí
            return;
        }

        //proceso la entrega del pedido
        if (Pedido::where('id', $this->pedidos_id)->exists()) {
            Pedido::where('id', $this->pedidos_id)->update(['estatus' => 4]);
        }

        // ✅ Cerrar el modal directamente
        $this->js(<<<'JS'
            $('#codigoModal').modal('hide');
        JS);

        // Mostrar alerta con botón OK
        $this->dispatch('mostrarAlertaEntrega');

    }

    public function resetCodigo(): void
    {
        $this->digitos = ['', '', '', '', '', ''];

        $this->js(<<<'JS'
        window.dispatchEvent(new CustomEvent('focus-primer-input'));
    JS);
    }

    #[On('confirmarEntrega')]
    public function confirmarEntrega(): void
    {
        $this->disableFtcoAnimate();
        $this->reset(['verPedido', 'verSuccess', 'verError']);
        $this->getPedido();
    }


    protected function getPedido(): void
    {
        $parametro = Parametro::where('nombre', 'pedido_'.$this->rowquid)->first();
        if ($parametro){
            $this->parametros_id = $parametro->id;
            $pedido = Pedido::find($parametro->valor_id);
            if ($pedido){
                $this->pedidos_id = $pedido->id;
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
                $this->created_at = Carbon::parse($pedido->created_at)->diffForHumans();

                match ($pedido->estatus) {
                    3 => $this->verPedido = true,
                    4 => $this->verSuccess = true,
                    default => $this->verError = true,
                };


            }else{
                $this->verError = true;
            }
        }else{
            $this->verError = true;
        }
    }
}
