<?php

namespace App\Livewire\Web;

use App\Models\Almacen;
use App\Models\Producto;
use App\Traits\WebTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class RecentProductsComponent extends Component
{
    use WebTrait;

    public function render()
    {
        $this->getAlmacen();
        $this->getProductos();
        return view('livewire.web.recent-products-component');
    }

    protected function getAlmacen(): void
    {
        $almacen = Almacen::where('is_main', 1)->first();
        if ($almacen){
            $this->almacenes_id = $almacen->id;
            $this->almacen = $almacen->nombre;
        }
    }

    protected function getProductos(): void
    {
        $this->productos = Producto::where('is_active', 1)
            ->limit(8)
            ->get();
    }

}
