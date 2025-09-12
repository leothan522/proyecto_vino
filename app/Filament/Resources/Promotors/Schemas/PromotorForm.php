<?php

namespace App\Filament\Resources\Promotors\Schemas;

use App\Models\Promotor;
use Closure;
use Filament\Actions\Action;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Illuminate\Database\Query\Builder;

class PromotorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        TextInput::make('cedula')
                            ->unique()
                            ->integer()
                            ->required(),
                        Select::make('users_id')
                            ->label(__('actions.user'))
                            ->relationship(
                                name: 'user',
                                titleAttribute: 'name',
                            )
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
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
                                    ->required(),
                                TextInput::make('telefono')
                                    ->label('Teléfono')
                                    ->tel()
                                    ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                                    ->required(),
                                Hidden::make('access_panel')
                                    ->default(true)
                            ])
                            ->createOptionAction(
                                fn(Action $action) => $action->modalWidth(Width::Small)->modalHeading('Nuevo Usuario')
                            )
                            ->rules([
                                fn(): Closure => function (string $attribute, $value, Closure $fail) {
                                    if (Promotor::where('users_id', $value)->exists()) {
                                        $fail('El campo usuario ya ha sido registrado.');
                                    }
                                }
                            ])
                            ->required(),
                        Select::make('almacenes_id')
                            ->label('Municipio')
                            ->relationship('almacen', 'nombre')
                            ->required(),
                    ])
                    ->compact()
                    ->columns()
                    ->columnSpanFull(),

            ]);
    }
}
