<?php

namespace App\Livewire\Web;

use App\Models\Almacen;
use App\Models\Carrito;
use App\Models\Producto;
use App\Traits\WebTrait;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class RecentProductsComponent extends Component
{
    use WebTrait;



    public function render()
    {
        $this->getAlmacen();
        $productos = $this->getProductos();
        $this->getDatosCarrito($productos);
        return view('livewire.web.recent-products-component')
            ->with('productos',$productos);
    }



    protected function getAlmacen(): void
    {
        $almacen = Almacen::where('is_main', 1)->first();
        if ($almacen) {
            session(['almacenes_id' => $almacen->id]);
            $this->almacenes_id = $almacen->id;
            $this->almacen = $almacen->nombre;
        }
    }

    protected function getProductos(): mixed
    {
        return Producto::where('is_active', 1)
            ->whereRelation('tipo', 'is_active', true)
            ->limit(8)
            ->get();
    }

}
