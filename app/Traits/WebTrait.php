<?php

namespace App\Traits;

trait WebTrait
{
    public bool $ftco_animate = true;

    public function disableFtcoAnimate(): void
    {
        $this->ftco_animate = false;
    }

}
