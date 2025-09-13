<?php

namespace App\Livewire\Web;

use App\Models\Galeria;
use App\Traits\WebTrait;
use Livewire\Component;
use Livewire\WithPagination;

class BlogComponent extends Component
{
    use WithPagination;
    use WebTrait;

    public function render()
    {
        return view('livewire.web.blog-component')
            ->with('imagenes', $this->getGaleria());
    }

    protected function getGaleria(): \LaravelIdea\Helper\App\Models\_IH_Galeria_C|\Illuminate\Pagination\LengthAwarePaginator|array
    {
        return Galeria::orderBy('fecha', 'desc')->paginate(6);
    }

}
