<?php

namespace App\Filament\Resources\Pedidos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PedidoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('codigo'),
                TextInput::make('cedula'),
                TextInput::make('nombre'),
                TextInput::make('parroquia'),
                TextInput::make('telefono')
                    ->tel(),
                Textarea::make('direccion')
                    ->columnSpanFull(),
                Textarea::make('direccion2')
                    ->columnSpanFull(),
                TextInput::make('subtotal')
                    ->numeric(),
                TextInput::make('entrega')
                    ->numeric(),
                TextInput::make('total')
                    ->numeric(),
                TextInput::make('rowquid')
                    ->required(),
                Toggle::make('is_process')
                    ->required(),
                TextInput::make('bodega'),
                TextInput::make('users_id')
                    ->numeric(),
                TextInput::make('almacenes_id')
                    ->numeric(),
                TextInput::make('estatus')
                    ->numeric(),
            ]);
    }
}
