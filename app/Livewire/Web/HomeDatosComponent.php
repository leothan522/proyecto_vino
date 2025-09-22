<?php

namespace App\Livewire\Web;

use App\Models\Cliente;
use App\Models\Pedido;
use App\Traits\WebTrait;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class HomeDatosComponent extends Component
{
    use WebTrait;

    public string $cedula;
    public string $nombre;
    public string $telefono;
    public string $direccion;
    public mixed $direccion2;
    public int $clientes_id = 0;

    public function render()
    {
        return view('livewire.web.home-datos-component')
            ->with('clientes', $this->getClientes());
    }

    public function show($id): void
    {
        $this->disableFtcoAnimate();
        $cliente = Cliente::find($id);
        if ($cliente){
            $this->clientes_id = $cliente->id;
            $this->cedula = $cliente->cedula;
            $this->nombre = $cliente->nombre;
            $this->telefono = $cliente->telefono;
            $this->direccion = $cliente->direccion;
            $this->direccion2 = $cliente->direccion2;
            $this->dispatch('initModalShow');
        }

    }

    public function save(): void
    {
        $this->disableFtcoAnimate();
        $rules = [
            'cedula' => 'required',
            'nombre' => 'required',
            'telefono' => 'required',
            'direccion' => 'required',
        ];
        $messages = [
            'cedula.required' => 'El campo cédula es obligatorio.',
            'telefono.required' => 'El campo teléfono es obligatorio.',
            'direccion.required' => 'El campo dirección es obligatorio.',
        ];
        $this->validate($rules, $messages);

        $cliente = Cliente::find($this->clientes_id);
        if ($cliente){
            $cliente->cedula = $this->cedula;
            $cliente->nombre = $this->nombre;
            $cliente->telefono = $this->telefono;
            $cliente->direccion = $this->direccion;
            $cliente->direccion2 = $this->direccion2 ?? null;
            $cliente->save();
            LivewireAlert::title('Datos Actualizados')
                ->toast()
                ->position('top')
                ->success()
                ->show();
        }

    }

    #[On('initModalShow')]
    public function initModalShow()
    {
        //JS
    }

    protected function getClientes(): array|\Illuminate\Pagination\LengthAwarePaginator|\LaravelIdea\Helper\App\Models\_IH_Cliente_C
    {
        return Cliente::where('users_id', auth()->id())->orderBy('created_at', 'desc')->paginate(6);
    }

}
