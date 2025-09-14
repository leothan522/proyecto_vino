<?php

namespace App\Livewire\Dashboard;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Livewire;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Livewire\Component;

class StocksInfolistComponent extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public function render()
    {
        return view('livewire.dashboard.stocks-infolist-component');
    }

    public function stockInfolist(Schema $schema): Schema
    {
        return $schema
            ->state([
                'name' => "yonathan"
            ])
            ->components([
                Livewire::make(StocksTableComponent::class)
            ]);
    }

}
