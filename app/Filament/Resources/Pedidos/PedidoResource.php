<?php

namespace App\Filament\Resources\Pedidos;

use App\Filament\Resources\Pedidos\Pages\CreatePedido;
use App\Filament\Resources\Pedidos\Pages\EditPedido;
use App\Filament\Resources\Pedidos\Pages\ListPedidos;
use App\Filament\Resources\Pedidos\Schemas\PedidoForm;
use App\Filament\Resources\Pedidos\Tables\PedidosTable;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoPago;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingBag;

    protected static ?string $recordTitleAttribute = 'codigo';

    public static function form(Schema $schema): Schema
    {
        return PedidoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PedidosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPedidos::route('/'),
            //'create' => CreatePedido::route('/create'),
            // 'edit' => EditPedido::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalles de Facturación')
                    ->inlineLabel()
                    ->schema([
                        TextEntry::make('created_at')
                            ->label(__('Fecha'))
                            ->date()
                            ->color('primary'),
                        TextEntry::make('cedula')
                            ->label('Cédula')
                            ->numeric()
                            ->color('primary'),
                        TextEntry::make('nombre')
                            ->label('Nombre')
                            ->formatStateUsing(fn(string $state): string => Str::upper($state))
                            ->color('primary'),
                        TextEntry::make('telefono')
                            ->label('Teléfono')
                            ->color('primary'),
                        TextEntry::make('bodega')
                            ->label('Municipio')
                            ->formatStateUsing(fn(string $state): string => Str::upper($state))
                            ->color('primary'),
                        TextEntry::make('parroquia')
                            ->label('Parroquia')
                            ->formatStateUsing(fn(string $state): string => Str::upper($state))
                            ->color('primary'),
                        TextEntry::make('direccion')
                            ->label('Dirección')
                            ->formatStateUsing(fn(Pedido $record): string => Str::upper($record->direccion . ' ' . $record->direccion2))
                            ->color('primary'),
                        TextEntry::make('total')
                            ->label('Total')
                            ->money()
                            ->color('primary'),
                    ])
                    ->compact(),
                Section::make('Método de pago')
                    ->schema([
                        RepeatableEntry::make('pagos')
                            ->hiddenLabel()
                            ->schema([
                                TextEntry::make('is_validated')
                                    ->hiddenLabel()
                                    ->badge()
                                    ->formatStateUsing(fn(bool $state): string => $state ? 'Pago Validado' : 'Esperando Validación')
                                    ->icon(fn(bool $state): Heroicon => $state ? Heroicon::OutlinedCheckCircle : Heroicon::OutlinedClock)
                                    ->color(fn(bool $state): string => $state ? 'success' : 'gray')
                                    ->afterContent(
                                        Action::make('validar_pago')
                                            ->label('Validar')
                                            ->requiresConfirmation()
                                            ->button()
                                            ->action(function (PedidoPago $record): void {

                                                $record->is_validated = true;
                                                $record->validated = now();
                                                $record->user_name = auth()->user()->name;
                                                $record->user_email = auth()->user()->email;
                                                $record->user_telefono = auth()->user()->telefono;
                                                $record->users_id = auth()->id();
                                                $record->save();

                                                // Actualizar el estado del pedido
                                                $pedido = $record->pedido;
                                                if ($pedido->pagos()->where('is_validated', true)->exists()) {
                                                    $pedido->estatus = 2;
                                                    $pedido->save();
                                                }

                                                Notification::make()
                                                    ->title('Pago Validado')
                                                    ->success()
                                                    ->send();
                                            })
                                            ->hidden(fn(PedidoPago $record): bool => $record->is_validated)
                                    ),
                                TextEntry::make('metodo')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state == 'transferencias' ? 'Tranferencia' : 'Pago Móvil'))
                                    ->inlineLabel()
                                    ->color('primary'),
                                TextEntry::make('referencia')
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->inlineLabel()
                                    ->color('primary'),
                                TextEntry::make('monto')
                                    ->inlineLabel()
                                    ->color('primary')
                                    ->numeric(decimalPlaces: 2),
                            ])
                            ->contained(false),
                    ])
                    ->compact(),
                Section::make('Productos')
                    ->schema([
                        RepeatableEntry::make('items')
                            ->hiddenLabel()
                            ->schema([
                                TextEntry::make('producto')
                                    ->hiddenLabel()
                                    ->formatStateUsing(fn(string $state): string => Str::upper($state))
                                    ->afterContent(fn(PedidoItem $record) => Text::make('x' . $record->cantidad)->color('primary'))
                                    ->color('primary'),
                            ])
                            ->contained(false)
                    ])
                    ->compact()
                    ->collapsible()
                    ->collapsed(),
                Section::make('Estatus')
                    ->schema([
                        TextEntry::make('estatus')
                            ->hiddenLabel()
                            ->formatStateUsing(fn(Pedido $record) => match (Pedido::find($record->id)?->estatus) {
                                1 => 'Validar Pago',
                                2 => 'Por Despachar',
                                3 => 'Entregado',
                                default => 'Incompleto',
                            })
                            ->icon(fn(Pedido $record): Heroicon => match (Pedido::find($record->id)?->estatus) {
                                1 => Heroicon::OutlinedClock,
                                2 => Heroicon::OutlinedTruck,
                                3 => Heroicon::OutlinedCheckCircle,
                                default => Heroicon::OutlinedXCircle,
                            })
                            ->iconColor(fn(Pedido $record): string => match (Pedido::find($record->id)?->estatus) {
                                1 => 'primary',
                                2 => 'gray',
                                3 => 'success',
                                default => 'danger',
                            }),
                    ])
                    ->compact(),
            ]);
    }
}
