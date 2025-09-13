<?php

namespace App\Livewire\Web;

use App\Models\Galeria;
use App\Traits\WebTrait;
use Livewire\Component;

class RecentBlogComponent extends Component
{
    use WebTrait;

    public mixed $imagenes;

    public function render()
    {
        $this->getGaleria();
        return view('livewire.web.recent-blog-component');
    }

    protected function getGaleria(): void
    {
        $this->imagenes = Galeria::orderBy('fecha', 'desc')->limit(4)->get();
    }

}
