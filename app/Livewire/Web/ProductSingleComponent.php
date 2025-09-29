<?php

namespace App\Livewire\Web;

use App\Models\Almacen;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Stock;
use App\Traits\WebTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class ProductSingleComponent extends Component
{
    use WebTrait;

    public int $productos_id;

    public string $nombre;
    public int $tipos_id;
    public string $tipo;
    public string $precio;
    public string $descripcion;
    public string $imagen;
    public string $disponibles;
    public string $vendidos;

    public int $cantidad = 1;
    public int $max = 0;



    public function mount($productos_id): void
    {
        $this->productos_id = $productos_id;
    }

    public function render()
    {
        $this->getAlmacen();
        $this->getProducto();
        return view('livewire.web.product-single-component');
    }

    public function addCart(): void
    {
        $this->disableFtcoAnimate();
        if ($this->cantidad > 0){
            $this->productAddCart($this->productos_id, $this->cantidad);
        }
        $this->reset('cantidad');

    }

    public function showCart(): void
    {
        $this->disableFtcoAnimate();
        $response = true;
        $rowquid = session('rowquid');
        $carrito = Carrito::where('rowquid', $rowquid)->where('productos_id', $this->productos_id)->where('almacenes_id', $this->almacenes_id)->exists();
        if (!$carrito){
            $response = $this->productAddCart($this->productos_id, $this->cantidad);
        }
        if ($response){
            $this->dispatch('showLoader');
            $this->redirectRoute('web.cart');
        }
    }

    public function showTiposProductos(): void
    {
        $this->disableFtcoAnimate();
        session(['tipos_id' => $this->tipos_id]);
        $this->dispatch('showLoader');
        $this->redirectRoute('web.products');
    }

    public function showAlmacen(): void
    {
        $this->disableFtcoAnimate();
        session()->forget('tipos_id');
        $this->dispatch('showLoader');
        $this->redirectRoute('web.products');
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
        } else {
            $this->dispatch('showLoader');
            $this->redirectRoute('web.index');
        }
    }

    protected function getProducto(): void
    {
        $producto = Producto::find($this->productos_id);
        $carrito = Carrito::where('rowquid', session('rowquid'))->where('productos_id', $this->productos_id)->exists();
        if ($producto && ($producto->is_active || $carrito)) {
            $this->nombre = $producto->nombre;
            $this->tipos_id = $producto->tipos_id;
            $this->tipo = $producto->tipo->nombre;
            $this->precio = formatoMillares($producto->precio);
            $this->descripcion = $producto->descripcion;
            $this->imagen = $producto->imagen_path;
            $stock = $this->getStock($this->almacenes_id, $this->productos_id);
            $vendidos = 0;
            if ($stock) {
                $this->max = $stock->disponibles > 0 ? $stock->disponibles : 0;
                $vendidos = $stock->vendidos;
            }
            $this->vendidos = $vendidos > 0 ? cerosIzquierda(formatoMillares($vendidos, 0)) : 0;
            $this->disponibles = $this->max > 0 ? cerosIzquierda(formatoMillares($this->max, 0)) : 0;
        } else {
            $this->dispatch('showLoader');
            $this->redirectRoute('web.index');
        }
    }

}
