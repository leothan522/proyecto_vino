<?php

namespace App\Livewire\Web;

use App\Models\Almacen;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\TipoProducto;
use App\Traits\WebTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use function Pest\Laravel\get;

class ProductsComponent extends Component
{
    use WithPagination;
    use WebTrait;

    public mixed $almacenes;
    public mixed $tipos;
    public array $filtro = [];

    public function mount(): void
    {
        $this->col = 4;
    }

    public function render()
    {
        $this->getTipos();
        $this->getAlmacen();
        return view('livewire.web.products-component')
            ->with('productos', $this->getProductos());
    }

    public function updating($filtro): void
    {
        $this->disableFtcoAnimate();
        session()->forget('tipos_id');
    }

    public function setAlmacen($id): void
    {
        $this->disableFtcoAnimate();
        if (!Carrito::where('rowquid', session('rowquid'))->count()) {
            session(['almacenes_id' => $id]);
        } else {
            LivewireAlert::title('¡Carrito Lleno!')
                ->text('Para cambiar de Bodega debes tener tu carrito vacio.')
                ->withConfirmButton('Ok')
                ->timer(10000)
                ->warning()
                ->show();
        }

    }

    protected function getAlmacen(): void
    {
        if (session()->has('almacenes_id')) {
            $almacen = Almacen::find(session('almacenes_id'));
        } else {
            $almacen = Almacen::where('is_main', 1)->first();
        }
        if ($almacen) {
            $this->almacenes_id = $almacen->id;
            $this->almacen = $almacen->nombre;
        }
        $this->almacenes = Almacen::all();
    }

    protected function getProductos(): mixed
    {
        if (empty($this->filtro) && session()->has('tipos_id')){
            $this->filtro[] = session('tipos_id');
        }

        $productos = Producto::query();
        if (!empty($this->filtro)){
            $productos->whereIn('tipos_id', $this->filtro);
        }
        $productos->whereRelation('tipo', 'is_active', true);
        return $productos->where('is_active', 1)->paginate(12);
    }

    protected function getTipos(): void
    {
        $this->tipos = TipoProducto::where('is_active', true)->get();
    }


}
