<?php

namespace App\Filament\Resources\Permissions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PermissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->minLength(4)
                            ->maxLength(12)
                            ->unique()
                            ->required(),
                        Select::make('guard_name')
                            ->options([
                                'web' => 'web',
                                'api' => 'api'
                            ])
                            ->required(),
                        Select::make('roles')
                            ->multiple()
                            ->relationship(titleAttribute: 'name')
                            ->preload()
                            ->columnSpanFull(),
                    ])
                    ->columns()
                    ->columnSpanFull()
                    ->compact(),
            ]);
    }
}
