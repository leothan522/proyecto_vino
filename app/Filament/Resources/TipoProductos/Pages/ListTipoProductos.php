<?php

namespace App\Filament\Resources\TipoProductos\Pages;

use App\Filament\Resources\TipoProductos\TipoProductoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTipoProductos extends ListRecords
{
    protected static string $resource = TipoProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
