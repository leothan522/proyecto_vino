<?php

namespace App\Livewire\Web;

use App\Traits\WebTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Component;

class HomeMenuComponent extends Component
{
    use WebTrait;

    public bool $isPedidos;
    public bool $isFavoritos;
    public bool $isDatos;
    public bool $isPerfil;

    public function mount()
    {
        $show = null;
        if (session()->has('menu_home')){
            $show = session('menu_home');
        }
        $this->getActive($show);
    }

    public function render()
    {
        return view('livewire.web.home-menu-component');
    }

    public function showPedidos(): void
    {
        session()->forget('menu_home');
        if ($this->isPerfil){
            $this->dispatch('showLoader');
            $this->redirectRoute('web.home');
        }else{
            $this->getActive();
        }
    }

    public function showDatos(): void
    {
        session(['menu_home' => 'show.datos']);
        if ($this->isPerfil){
            $this->dispatch('showLoader');
            $this->redirectRoute('web.home');
        }else{
            $this->getActive('show.datos');
        }
    }

    public function showPerfil(): void
    {
        session()->forget('menu_home');
        $this->dispatch('showLoader');
        $this->redirectRoute('web.profile');
    }

    protected function getActive($show = null): void
    {
        $this->disableFtcoAnimate();
        $route = $show ?? Route::currentRouteName();
        switch ($route){
            case 'web.profile':
                $this->isPedidos = false;
                $this->isFavoritos = false;
                $this->isDatos = false;
                $this->isPerfil = true;
                break;
            case 'show.datos':
                $this->isPedidos = false;
                $this->isFavoritos = false;
                $this->isDatos = true;
                $this->isPerfil = false;
                break;
            default:
                $this->isPedidos = true;
                $this->isFavoritos = false;
                $this->isDatos = false;
                $this->isPerfil = false;
                break;
        }
    }

    public function cerrarSesion(): void
    {
        $this->disableFtcoAnimate();
        Auth::guard('web')->logout();
        session()->flush();
        $this->dispatch('showLoader');
        $this->redirectRoute('web.index');
    }
}
