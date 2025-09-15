<?php

namespace App\Livewire\Web;

use App\Models\BancosPagoMovil;
use App\Models\BancosTransferencia;
use App\Traits\WebTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Livewire\Component;

class MetodosPagosComponent extends Component
{
    use WebTrait;
    public string $titularTransferencia;
    public string $cuentaTransferencia;
    public string $rifTransferencia;
    public string $tipoTransferencia;
    public string $bancoTransferencia;
    public string $bancoPagoMovil;
    public string $codigoPagoMovil;
    public string $rifPagoMovil;
    public string $telefonoPagoMovil;
    public string $smsPagoMovil;
    public float $montoDollar;
    public float $montoBs = 0;
    public array $response = [];
    public float $oficial = 0;
    public string $fecha = '';

    public function mount($total)
    {
        $this->montoDollar = $total;
    }

    public function render()
    {
        $this->getMetodos();
        return view('livewire.web.metodos-pagos-component');
    }

    protected function getMetodos(): void
    {
        $transferencia = BancosTransferencia::where('is_main', true)->first();
        if ($transferencia){
            $this->titularTransferencia = Str::upper($transferencia->titular);
            $this->cuentaTransferencia = $transferencia->cuenta;
            $this->rifTransferencia = Str::upper($transferencia->rif);
            $this->tipoTransferencia = $transferencia->tipo;
            $this->bancoTransferencia = Str::upper($transferencia->banco);
        }
        $pagoMovil = BancosPagoMovil::where('is_main', true)->first();
        if ($pagoMovil){
            $this->bancoPagoMovil = Str::upper($pagoMovil->banco);
            $this->codigoPagoMovil = $pagoMovil->codigo;
            $this->rifPagoMovil = Str::upper($pagoMovil->rif);
            $this->telefonoPagoMovil = $pagoMovil->telefono;
            $monto = $this->oficial ? $this->montoBs : '';
            $this->smsPagoMovil = 'pagar '.$this->codigoPagoMovil.' '. $this->telefonoPagoMovil.' '. $this->rifPagoMovil.' '. $monto;
        }
    }

    public function showModalMetodos(): void
    {
        //refresh
        $this->disableFtcoAnimate();
        $response = Http::get('https://ve.dolarapi.com/v1/dolares/oficial');
        if ($response->successful()){
            $this->response = $response->json();
            $this->oficial = round($this->response['promedio'], 2);
            $this->fecha = Carbon::parse($response['fechaActualizacion'])->isoFormat('dddd, D MMMM YYYY');
            $this->montoBs = round($this->montoDollar * $this->oficial, 2);
        }
    }
}
