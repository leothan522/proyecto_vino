<?php

namespace App\Livewire\Web;

use App\Models\Carrito;
use Livewire\Attributes\On;
use Livewire\Component;

class OrderLastComponent extends Component
{
    public int $total;
    public mixed $items;

    public function render()
    {
        $this->getItems();
        return view('livewire.web.order-last-component');
    }

    protected function getItems(): void
    {
        $rowquid = session('rowquid');
        $carrito = Carrito::where('rowquid', $rowquid)->orderBy('created_at', 'desc');
        $this->items = $carrito->limit(3)->get();
        $this->total = $carrito->sum('cantidad');
    }

    #[On('orderLastRefresh')]
    public function orderLastRefresh()
    {
        //Actualizar
    }

}
