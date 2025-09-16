<?php

namespace App\Livewire\Web;

use App\Models\Pedido;
use App\Traits\WebTrait;
use Livewire\Component;

class HomeDatosComponent extends Component
{
    use WebTrait;

    public function render()
    {
        return view('livewire.web.home-datos-component');
    }
}
