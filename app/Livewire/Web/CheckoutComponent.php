<?php

namespace App\Livewire\Web;

use App\Models\BancosPagoMovil;
use App\Models\BancosTransferencia;
use App\Models\Cliente;
use App\Models\Parroquia;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoPago;
use App\Traits\WebTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class CheckoutComponent extends Component
{
    use WebTrait;

    public string $rowquid;

    public string $cedula;
    public string $nombre;
    public string $telefono;
    public int $parroquias_id;
    public string $direccion;
    public mixed $direccion2;
    public int $clientes_id = 0;
    public bool $disableInput = false;

    public string $metodoPago;
    public string $referencia;
    public float $monto;

    public function mount($rowquid): void
    {
        $this->rowquid = $rowquid;
        $cliente = Cliente::where('users_id', auth()->id())->first();
        if ($cliente){
            $this->cedula = $cliente->cedula;
            $this->getDatosFacturacion($cliente->cedula);
        }
    }

    public function render()
    {
        $this->getItems();
        return view('livewire.web.checkout-component')
            ->with('parroquias', $this->getParroquias());
    }

    public function saveOrder(): void
    {
        $this->disableFtcoAnimate();
        $rules = [
            'cedula' => 'required',
            'nombre' => 'required',
            'parroquias_id' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
            'metodoPago' => 'required',
            'referencia' => 'required|min:6|unique:pedidos_pagos,referencia',
            'monto' => 'required|numeric|min:0|max:999999.99',
        ];
        $messages = [
            'cedula.required' => 'El campo cédula es obligatorio.',
            'parroquias_id.required' => 'El campo parroquias es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
            'metodoPago.required' => 'El campo método de pago es obligatorio.',
            'monto.max' => 'El campo monto no debe ser mayor que 999.999,99',
        ];
        $this->validate($rules, $messages);

        $codigo = codigoPedidos();
        $parroquia = Parroquia::find($this->parroquias_id);
        $pedido = $this->getPedido();
        if ($pedido) {

            $pedido->codigo = $codigo;
            $pedido->cedula = $this->cedula;
            $pedido->nombre = $this->nombre;
            $pedido->parroquia = $parroquia->parroquia;
            $pedido->telefono = $this->telefono;
            $pedido->direccion = $this->direccion;
            $pedido->direccion2 = $this->direccion2 ?? null;
            $pedido->subtotal = $this->subtotal;
            $pedido->entrega = $this->entrega;
            $pedido->estatus = 1;
            $pedido->total = $this->total;
            $pedido->is_process = false;
            $pedido->bodega = $pedido->almacen->nombre;
            $pedido->save();
            incrementarCodigoPedidos();

            if ($this->clientes_id) {

                if (!$this->disableInput) {
                    $cliente = Cliente::find($this->clientes_id);
                    if ($cliente) {
                        $cliente->cedula = $this->cedula;
                        $cliente->nombre = $this->nombre;
                        $cliente->telefono = $this->telefono;
                        $cliente->parroquias_id = $this->parroquias_id;
                        $cliente->direccion = $this->direccion;
                        $cliente->direccion2 = $this->direccion2 ?? null;
                        $cliente->save();
                    }
                }

            } else {
                if (!Cliente::where('cedula', $this->cedula)->exists()) {
                    Cliente::create([
                        'cedula' => $this->cedula,
                        'nombre' => $this->nombre,
                        'telefono' => $this->telefono,
                        'parroquias_id' => $this->parroquias_id,
                        'direccion' => $this->direccion,
                        'direccion2' => $this->direccion2,
                        'users_id' => auth()->id(),
                    ]);
                }
            }

            if ($this->metodoPago == 'transferencias') {
                //trasnferencias
                $metodo = BancosTransferencia::where('is_main', true)->first();
            } else {
                $metodo = BancosPagoMovil::where('is_main', true)->first();
            }

            $data = [];
            if ($metodo) {
                $data['titular'] = $this->metodoPago == 'transferencias' ? $metodo->titular : null;
                $data['cuenta'] = $this->metodoPago == 'transferencias' ? $metodo->cuenta : null;
                $data['rif'] = $metodo->rif;
                $data['tipo'] = $this->metodoPago == 'transferencias' ? $metodo->tipo : null;
                $data['banco'] = $metodo->banco;
                $data['codigo'] = $this->metodoPago == 'transferencias' ? null : $metodo->codigo;
                $data['telefono'] = $this->metodoPago == 'transferencias' ? null : $metodo->telefono;
            }
            $data['pedidos_id'] = $pedido->id;
            $data['metodo'] = $this->metodoPago;
            $data['referencia'] = $this->referencia;
            $data['monto'] = $this->monto;
            PedidoPago::create($data);

            $this->redirectRoute('web.home');
        }


    }

    #[On('getDatosFacturacion')]
    public function getDatosFacturacion($cedula): void
    {
        $this->disableFtcoAnimate();
        $cliente = Cliente::where('cedula', $cedula)->first();
        if ($cliente) {

            $this->clientes_id = $cliente->id;
            $this->nombre = $cliente->nombre;
            $this->telefono = $cliente->telefono;
            $this->parroquias_id = $cliente->parroquias_id ?? 0;
            $this->direccion = $cliente->direccion;
            $this->direccion2 = $cliente->direccion2;

            if ($cliente->users_id != auth()->id()) {
                $this->disableInput = true;
            }

            $parroquias = $this->getParroquias();
            if (!empty($parroquias)) {
                $idsValidos = $parroquias->pluck('id')->toArray();
                // Si el valor actual no está en el listado, lo reseteamos
                if (!in_array($this->parroquias_id, $idsValidos)) {
                    $this->reset(['parroquias_id', 'direccion', 'direccion2']);
                }
            }

        } else {
            $this->limpiar();
        }
    }

    protected function getItems(): void
    {
        $pedido = $this->getPedido();
        if (!$pedido) {
            $this->redirectRoute('web.index');
        }
        $items = PedidoItem::where('pedidos_id', $pedido->id)->get();
        $this->subtotal = $items->sum(fn($item) => $item->precio * $item->cantidad);
        $parametro = getParametro('precio_delivery');
        $this->entrega = is_numeric($parametro) ? (float)$parametro : 0;
        $this->total = $this->subtotal + $this->entrega;
    }

    protected function getPedido(): ?Pedido
    {
        return Pedido::where('rowquid', $this->rowquid)->where('users_id', auth()->id())->first();
    }

    protected function getParroquias(): mixed
    {
        $response = [];
        $pedido = $this->getPedido();
        if ($pedido) {
            $municipio = $pedido->almacen->id_municipio ?? -1;
            $response = Parroquia::where('id_municipio', $municipio)->get();
        }
        return $response;
    }

    protected function limpiar(): void
    {
        $this->reset(['nombre', 'telefono', 'parroquias_id', 'direccion', 'direccion2', 'disableInput', 'clientes_id']);
    }

}
