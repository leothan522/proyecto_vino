<?php

namespace App\Livewire\Dashboard;

use Carbon\Carbon;
use DB;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class PromotorTableWidget extends TableWidget
{
    public ?int $promotores_id = null;

    public function table(Table $table): Table
    {
        $promotorId = 4;

        $ventasPorMes = $this->getDatos();

        return $table
            ->heading('Ventas por Mes')
            ->description('Ordenados del más reciente al más antiguo.')
            ->columns([
                TextColumn::make('mes')->label('Mes')
                    ->formatStateUsing(fn ($state):string => ucfirst($state)),
                TextColumn::make('total')->label('Ventas')
                ->numeric()
                ->alignCenter(),
            ])
            ->records(fn () => $ventasPorMes); // ✅ Closure con arrays
    }

    protected function getDatos(): mixed
    {
        return DB::table('promotores_pedidos')
            ->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as mes, SUM(cantidad) as total")
            ->where('promotores_id', $this->promotores_id)
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"), 'desc')
            ->get()
            ->map(function ($item) {
                $item->mes = Carbon::createFromFormat('Y-m', $item->mes)->translatedFormat('F Y');
                return (array) $item; // ✅ convertir a array
            })
            ->take(12); // ✅ limitar a 12 registros
    }
}
