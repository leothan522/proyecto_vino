<?php

namespace App\Filament\Resources\Almacens;

use App\Filament\Resources\Almacens\Pages\ManageAlmacens;
use App\Models\Almacen;
use App\Models\Municipio;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use UnitEnum;

class AlmacenResource extends Resource
{
    protected static ?string $model = Almacen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHomeModern;

    protected static string|UnitEnum|null $navigationGroup = 'Configuración';

    protected static ?int $navigationSort = 96;

    protected static ?string $modelLabel = 'Almacen';

    protected static ?string $pluralModelLabel = 'Almacenes';

    protected static ?string $slug = 'almacenes';

    protected static ?string $recordTitleAttribute = 'nombre';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required()
                    ->columnSpanFull(),
                Select::make('id_municipio')
                    ->label('Municipio')
                    ->options(Municipio::query()->where('id_estado', 11)->pluck('municipio', 'id'))
                    ->preload()
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre')
            ->columns([
                TextColumn::make('nombre')
                    ->searchable(),
                IconColumn::make('is_main')
                    ->label('Principal')
                    ->boolean()
                    ->falseIcon('')
                    ->alignCenter(),
                TextColumn::make('municipio.municipio')
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->since()
                    ->visibleFrom('md')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label('Eliminado')
                    ->since()
                    ->visibleFrom('md')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    Action::make('principal')
                        ->label('Almacen Principal')
                        ->icon(Heroicon::OutlinedCheckCircle)
                        ->requiresConfirmation()
                        ->hidden(fn(Almacen $record): bool => $record->is_main)
                        ->action(function (Almacen $record): void {
                            $almacenes = Almacen::where('is_main', 1)->get();
                            foreach ($almacenes as $almacen) {
                                $almacen->is_main = 0;
                                $almacen->save();
                            }
                            $record->is_main = 1;
                            $record->save();
                        }),
                    EditAction::make()
                        ->modalWidth(Width::Small),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                Action::make('actualizar')
                    ->icon(Heroicon::ArrowPath)
                    ->iconButton(),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageAlmacens::route('/'),
        ];
    }
}
