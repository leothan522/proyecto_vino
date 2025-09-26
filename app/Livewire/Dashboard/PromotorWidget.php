<?php

namespace App\Livewire\Dashboard;

use App\Models\Promotor;
use App\Models\PromotorPedido;
use Carbon\Carbon;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Str;

class PromotorWidget extends StatsOverviewWidget
{
    public ?int $promotores_id = null;
    protected ?string $codigo = null;
    protected ?string $codigoDescription = null;
    protected mixed $codigoDescriptionIcon = null;
    protected ?string $codigoColor = null;

    protected ?string $ventasTotales = null;
    protected ?string $ventasMesaje = null;

    protected ?string $mesLabel = null;
    protected ?string $mesTotal = null;
    protected ?int $mesPorcentaje = null;

    protected function getStats(): array
    {
        return $this->getDatos() ? [
            Stat::make('Codigo', $this->codigo)
                ->description($this->codigoDescription)
                ->descriptionIcon($this->codigoDescriptionIcon, IconPosition::Before)
                ->color($this->codigoColor),
            Stat::make('Ventas Totales', $this->ventasTotales)
                ->description($this->ventasMesaje),
            Stat::make('Ventas ' . $this->mesLabel, $this->mesTotal)
                ->description($this->mesPorcentaje . '% del total')
                //->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ] : [];
    }

    protected function getDatos(): bool
    {
        $response = false;
        $promotor = Promotor::find($this->promotores_id);
        if ($promotor) {

            /*Codigo*/
            $this->codigo = $promotor->codigo;
            $this->codigoDescription = verificarCodigoPromotor($promotor) ? 'Activo' : 'Inactivo';
            $this->codigoDescriptionIcon = verificarCodigoPromotor($promotor) ? Heroicon::OutlinedCheckCircle : Heroicon::OutlinedNoSymbol;
            $this->codigoColor = verificarCodigoPromotor($promotor) ? 'success' : 'danger';

            /*Ventas Totales*/
            $pedidos = PromotorPedido::where('promotores_id', $promotor->id)->get();

            $ventasTotales = $pedidos->sum('cantidad');
            $this->ventasTotales = formatearNumeroWidget($ventasTotales);

            $inicio = Carbon::parse($promotor->inicio_comision);
            $fin = $inicio->copy()->addMonths($promotor->meses_comision);
            if ($fin->isFuture()) {
                // Sigue activo
                $mensaje = "En curso desde hace " . Carbon::now()->diffForHumans($inicio, ['syntax' => true, 'part' => 1, 'short' => false,]);
            } else {
                // Ya finalizó
                $mensaje = "Finalizó hace " . Carbon::now()->diffForHumans($fin, ['syntax' => true, 'part' => 1, 'short' => false,]);
            }
            $this->ventasMesaje = $mensaje;

            /*Ventas Mes*/
            $this->mesLabel = Str::ucwords(Carbon::now()->translatedFormat('F'));
            $inicioMes = Carbon::now()->startOfMonth();
            $finMes = Carbon::now()->endOfMonth();
            $ventasMesActual = $pedidos->whereBetween('created_at', [$inicioMes, $finMes])->sum('cantidad');
            $porcentaje = ($ventasMesActual / max($ventasTotales, 1)) * 100;
            $this->mesTotal = formatearNumeroWidget($ventasMesActual);
            $this->mesPorcentaje = number_format($porcentaje, 1);
            $response = true;
        }
        return $response;
    }
}
