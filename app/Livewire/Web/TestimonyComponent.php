<?php

namespace App\Livewire\Web;

use App\Models\Promotor;
use App\Traits\WebTrait;
use Livewire\Component;

class TestimonyComponent extends Component
{
    use WebTrait;

    public mixed $promotores;

    public function render()
    {
        $this->getPromotores();
        return view('livewire.web.testimony-component');
    }

    protected function getPromotores(): void
    {
        $this->promotores = Promotor::whereRelation('user', 'is_active', 1)->get();
    }

}
