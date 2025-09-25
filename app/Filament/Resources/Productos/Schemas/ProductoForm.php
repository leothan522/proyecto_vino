<?php

namespace App\Filament\Resources\Productos\Schemas;

use App\Models\TipoProducto;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;

class ProductoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        TextInput::make('nombre')
                            ->required(),
                        Select::make('tipos_id')
                            ->label('Tipo')
                            ->options(TipoProducto::query()->pluck('nombre', 'id'))
                            ->preload()
                            ->required(),
                        Textarea::make('descripcion')
                            ->label('Descripción')
                            ->required()
                            ->columnSpanFull()
                            ->required(),
                        TextInput::make('precio')
                            ->prefixIcon(Heroicon::CurrencyDollar)
                            ->numeric()
                            ->required(),
                    ])
                    ->compact(),
                Section::make('Presentación')
                    ->schema([
                        FileUpload::make('imagen_path')
                            ->label('Imagen')
                            ->image()
                            ->imageEditor()
                            ->disk('public')
                            ->directory('productos-images')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->compact(),
                Toggle::make('is_active')
                    ->label('Acivo')
                    ->default(true)
                    ->hiddenOn('create'),
            ]);
    }
}
