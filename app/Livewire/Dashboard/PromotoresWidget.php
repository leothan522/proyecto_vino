<?php

namespace App\Livewire\Dashboard;

use App\Models\Promotor;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PromotoresWidget extends StatsOverviewWidget
{
    protected string $promotores = '0';
    protected string $codigos = '0';
    protected string $ventas = '0';

    public static function canView(): bool
    {
        return isAdmin();
    }

    protected function getStats(): array
    {
        $this->getDatos();
        return [
            Stat::make('Promotores', $this->promotores)
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('primary'),
            Stat::make('Códigos Activos', $this->codigos)
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('info'),
            Stat::make('Ventas', $this->ventas)
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }

    protected function getDatos(): void
    {
        $promotores = Promotor::query();
        $this->promotores = formatearNumeroWidget($promotores->count());
        $i = 0;
        foreach ($promotores->get() as $promotor){
            if (verificarCodigoPromotor($promotor)){
                $i++;
            }
        }
        $this->codigos = formatearNumeroWidget($i);
        $this->ventas = formatearNumeroWidget($promotores->sum('stock_vendidos'));
    }
}
