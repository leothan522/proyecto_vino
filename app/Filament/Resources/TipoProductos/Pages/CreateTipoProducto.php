<?php

namespace App\Filament\Resources\TipoProductos\Pages;

use App\Filament\Resources\TipoProductos\TipoProductoResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTipoProducto extends CreateRecord
{
    protected static string $resource = TipoProductoResource::class;

    protected static bool $canCreateAnother = false;
}
