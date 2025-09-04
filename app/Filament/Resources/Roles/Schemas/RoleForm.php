<?php

namespace App\Filament\Resources\Roles\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class RoleForm
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
                    ])
                    ->columns()
                    ->columnSpanFull()
                    ->compact(),
            ]);
    }
}
