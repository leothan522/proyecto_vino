<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        TextInput::make('name')
                            ->label(__('Name'))
                            ->minLength(3)
                            ->maxLength(255)
                            ->required(),
                        TextInput::make('email')
                            ->label(__('Email'))
                            ->email()
                            ->unique()
                            ->required(),
                        TextInput::make('password')
                            ->label(__('Password'))
                            ->password()
                            ->revealable()
                            ->minLength(8)
                            ->required()
                            ->hiddenOn('edit'),
                        TextInput::make('telefono')
                            ->label('Teléfono')
                            ->tel()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                            ->required(),
                    ])
                    ->columns()
                    ->columnSpanFull()
                    ->compact(),
                Section::make('Permisos')
                    ->schema([
                        Toggle::make('access_panel')
                            ->label('Acceso al panel')
                            ->inline(false),
                        Select::make('roles')
                            ->multiple()
                            ->label(__('Role'))
                            ->relationship(name: 'roles', titleAttribute: 'name')
                            ->requiredIf('access_panel', true),
                    ])
                    ->columns()
                    ->columnSpanFull()
                    ->compact(),
            ]);
    }
}
