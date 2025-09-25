<?php

namespace App\Filament\Resources\Galerias\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class GaleriaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        FileUpload::make('imagen_path')
                            ->label('Imagen')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('galeria-images')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->compact(),
                Section::make('Datos Complementarios')
                    ->schema([
                        DatePicker::make('fecha')
                            ->default(now())
                            ->required(),
                        TextInput::make('titulo')
                            ->maxLength(100)
                            ->required(),
                        Textarea::make('descripcion')
                            ->label('Descripción')
                            ->maxLength(255),
                    ])
                    ->compact(),
            ]);
    }
}
