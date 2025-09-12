<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

trait WebTrait
{
    public bool $ftco_animate = true;
    public int $almacenes_id;
    public string $almacen;
    public mixed $productos;

    public function disableFtcoAnimate(): void
    {
        $this->ftco_animate = false;
    }

    public function productShow($id): void
    {
        $this->disableFtcoAnimate();
        session(['almacenes_id' => $this->almacenes_id]);
        $this->redirectRoute('web.single', $id);
    }

    public function productAddFavorite($id): void
    {
        $this->disableFtcoAnimate();
        if (!Auth::check()) {
            $this->dispatch('initModalLogin', id: $id);
        } else {
            LivewireAlert::title('Agregado a Favoritos')
                ->toast()
                ->success()
                ->position('top')
                ->show();
        }

    }

}
