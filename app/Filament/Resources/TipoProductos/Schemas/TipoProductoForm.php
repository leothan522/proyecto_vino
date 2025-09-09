<?php

namespace App\Filament\Resources\TipoProductos\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class TipoProductoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        TextInput::make('nombre')
                            ->minLength(3)
                            ->maxLength(100)
                            ->unique()
                            ->required(),
                        FileUpload::make('imagen_path')
                            ->label('Imagen')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('tipos-images'),
                    ])
                    ->compact()
                    ->columns()
                    ->columnSpanFull(),
            ]);
    }
}
