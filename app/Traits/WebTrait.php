<?php

namespace App\Traits;

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

}
