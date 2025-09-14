<?php

namespace App\Filament\Resources\BancosPagoMovils;

use App\Filament\Resources\BancosPagoMovils\Pages\ManageBancosPagoMovils;
use App\Models\BancosPagoMovil;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

class BancosPagoMovilResource extends Resource
{
    protected static ?string $model = BancosPagoMovil::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Configuración';

    protected static ?int $navigationSort = 96;

    protected static ?string $slug = 'bancos-pago-movil';

    protected static ?string $modelLabel = 'pago móvil';

    protected static ?string $pluralModelLabel = 'pago móvil';

    protected static ?string $recordTitleAttribute = 'banco';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('banco')
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('codigo')
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('rif')
                    ->columnSpanFull()
                    ->required(),
                TextInput::make('telefono')
                    ->label('Teléfono')
                    ->columnSpanFull()
                    ->tel()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('banco')
            ->columns([
                TextColumn::make('banco')
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('codigo')
                    ->searchable()
                    ->alignCenter(),
                TextColumn::make('rif')
                    ->searchable()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable()
                    ->alignCenter(),
                IconColumn::make('is_main')
                    ->label("Activo")
                    ->boolean()
                    ->falseIcon('')
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->modalWidth(Width::Small),
                    Action::make('activar')
                        ->label('Activar')
                        ->icon(Heroicon::OutlinedCheckCircle)
                        ->action(function (BancosPagoMovil $record) {
                            $existe = BancosPagoMovil::where('is_main', true)->first();
                            if ($existe) {
                                $existe->is_main = false;
                                $existe->save();
                            }
                            $record->is_main = true;
                            $record->save();
                        })
                        ->color('success')
                        ->hidden(fn(BancosPagoMovil $record): bool => $record->is_main),
                    EditAction::make()
                        ->modalWidth(Width::Small),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageBancosPagoMovils::route('/'),
        ];
    }
}
