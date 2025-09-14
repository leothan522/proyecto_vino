<?php

namespace App\Filament\Resources\BancosTransferencias;

use App\Filament\Resources\BancosTransferencias\Pages\ManageBancosTransferencias;
use App\Models\BancosTransferencia;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use UnitEnum;

class BancosTransferenciaResource extends Resource
{
    protected static ?string $model = BancosTransferencia::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Configuración';

    protected static ?int $navigationSort = 96;

    protected static ?string $modelLabel = 'transferencia';

    protected static ?string $recordTitleAttribute = 'banco';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titular')
                    ->required()
                    ->maxLength(200)
                    ->columnSpanFull(),
                TextInput::make('cuenta')
                    ->length(20)
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('rif')
                    ->minLength(9)
                    ->required()
                    ->columnSpanFull(),
                Select::make('tipo')
                    ->options([
                        'Corriente' => 'Corriente',
                        'Ahorro' => 'Ahorro',
                    ])
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('banco')
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('banco')
            ->columns([
                TextColumn::make('banco')
                    ->searchable(),
                TextColumn::make('cuenta')
                    ->searchable()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('titular')
                    ->description(fn(BancosTransferencia $record): string => Str::upper($record->rif))
                    ->searchable(),
                IconColumn::make('is_main')
                    ->label("Activo")
                    ->boolean()
                    ->falseIcon('')
                    ->alignCenter(),
                TextColumn::make('created_at')
                    ->since()
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
                        ->action(function (BancosTransferencia $record) {
                            $existe = BancosTransferencia::where('is_main', true)->first();
                            if ($existe) {
                                $existe->is_main = false;
                                $existe->save();
                            }
                            $record->is_main = true;
                            $record->save();
                        })
                        ->color('success')
                        ->hidden(fn(BancosTransferencia $record): bool => $record->is_main),
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
            'index' => ManageBancosTransferencias::route('/'),
        ];
    }
}
