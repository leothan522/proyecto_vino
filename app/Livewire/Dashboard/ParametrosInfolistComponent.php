<?php

namespace App\Livewire\Dashboard;

use Filament\Infolists\Components\KeyValueEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Livewire\Component;

class ParametrosInfolistComponent extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public function render()
    {
        return view('livewire.dashboard.parametros-infolist-component');
    }

    public function parametrosInfolist(Schema $schema): Schema
    {
        return $schema
            ->constantState([
                'parametros' => [
                    'contact_nombre' => 'valor_id = null, valor_texto = string',
                    'contact_rif' => 'valor_id = null, valor_texto = string',
                    'contact_telefono' => 'valor_id = null, valor_texto = string',
                    'contact_email' => 'valor_id = null, valor_texto = string',
                    'contact_direccion' => 'valor_id = null, valor_texto = string',
                    'contact_web' => 'valor_id = null, valor_texto = string',
                    'social_facebook' => 'valor_id = null, valor_texto = string',
                    'social_instagram' => 'valor_id = null, valor_texto = string',
                    'about_desde' => 'valor_id = integer, valor_texto = null',
                    'about_clientes' => 'valor_id = integer, valor_texto = null',
                ]
            ])
            ->components([
                Section::make('Parametros manuales')
                    ->schema([
                        KeyValueEntry::make('parametros')
                        ->label('-')
                        ->keyLabel('Nombre')
                        ->valueLabel('Valores'),
                    ])
                    ->compact()
                    ->collapsible()
            ]);
    }

}
