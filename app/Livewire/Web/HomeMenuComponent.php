<?php

namespace App\Livewire\Web;

use App\Traits\WebTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeMenuComponent extends Component
{
    use WebTrait;

    public function render()
    {
        return view('livewire.web.home-menu-component');
    }

    public function cerrarSesion(): void
    {
        $this->disableFtcoAnimate();
        Auth::guard('web')->logout();
        session()->flush();
        $this->redirectRoute('web.index');
    }
}
