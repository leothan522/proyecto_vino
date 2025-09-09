<?php

namespace App\Filament\Resources\TipoProductos\Pages;

use App\Filament\Resources\TipoProductos\TipoProductoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditTipoProducto extends EditRecord
{
    protected static string $resource = TipoProductoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
