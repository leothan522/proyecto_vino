<x-filament-panels::page>
    {{-- Page content --}}
    @livewire(\App\Livewire\Dashboard\PromotorWidget::class, ['promotores_id' => $promotores_id], key($promotores_id))
</x-filament-panels::page>
