<?php

namespace App\Livewire\Web;

use App\Models\TipoProducto;
use App\Traits\WebTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;

class TiposProductosComponent extends Component
{
    use WebTrait;

    public function render()
    {
        $tipos = TipoProducto::where('is_active', true)->get();
        return view('livewire.web.tipos-productos-component')
            ->with('tiposProductos', $tipos);
    }

    public function show($tipos_id): void
    {
        $this->disableFtcoAnimate();
        $this->redirectRoute('web.products');
    }
}
