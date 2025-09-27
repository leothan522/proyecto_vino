<x-filament-panels::page>
    {{-- Page content --}}
    @livewire(\App\Livewire\Dashboard\PromotorWidget::class, ['promotores_id' => $promotores_id], key('widget-' .$promotores_id))
    @php
        $ventas = DB::table('promotores_pedidos')
            ->where('promotores_id', $promotores_id)
            ->count();
    @endphp
    @if ($ventas > 0)
        @livewire(\App\Livewire\Dashboard\PromotorTableWidget::class, ['promotores_id' => $promotores_id], key('table-' . $promotores_id))
    @endif

</x-filament-panels::page>
