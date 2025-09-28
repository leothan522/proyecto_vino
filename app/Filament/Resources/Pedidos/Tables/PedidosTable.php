<?php

namespace App\Filament\Resources\Pedidos\Tables;

use App\Filament\Resources\Pedidos\PedidoResource;
use App\Models\Parametro;
use App\Models\Pedido;
use App\Models\PedidoRepartidor;
use App\Models\Repartidor;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class PedidosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->query(fn(): Builder => Pedido::query()
                ->where('is_process', false)
                ->orderBy('created_at', 'desc')
            )
            ->columns([
                TextColumn::make('codigo')
                    ->label('Código')
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('cedula')
                    ->numeric()
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('nombre_codigo')
                    ->label('Pedidos')
                    ->default(fn(Pedido $record): string => Str::upper($record->nombre))
                    ->description(fn(Pedido $record): string => Str::upper('#'.$record->codigo), position: 'above')
                    ->hiddenFrom('md'),
                TextColumn::make('nombre')
                    ->formatStateUsing(fn(Pedido $record): string => Str::upper($record->nombre))
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('telefono')
                    ->label('Teléfono')
                    ->searchable()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('total')
                    ->money()
                    ->alignEnd()
                    ->visibleFrom('md'),
                IconColumn::make('is_process')
                    ->label('Estatus')
                    ->icon(fn(Pedido $record): Heroicon => match ($record->estatus) {
                        default => Heroicon::OutlinedXCircle,
                        1 => Heroicon::OutlinedClock,
                        2 => Heroicon::OutlinedInbox,
                        3 => Heroicon::OutlinedTruck,
                        4 => Heroicon::OutlinedCheckCircle,
                    })
                    ->color(fn(Pedido $record): string => match ($record->estatus) {
                        default => 'danger',
                        1 => 'primary',
                        2 => 'info',
                        3 => 'gray',
                        4 => 'success',
                    })
                    ->hiddenFrom('md')
                    ->alignCenter(),
                TextColumn::make('estatus')
                    ->formatStateUsing(fn(Pedido $record): string => match ($record->estatus) {
                        default => 'Incompleto',
                        1 => 'Validar Pago',
                        2 => 'Por Despachar',
                        3 => 'En Proceso',
                        4 => 'Entregado',
                    })
                    ->icon(fn(Pedido $record): Heroicon => match ($record->estatus) {
                        default => Heroicon::OutlinedXCircle,
                        1 => Heroicon::OutlinedClock,
                        2 => Heroicon::OutlinedInbox,
                        3 => Heroicon::OutlinedTruck,
                        4 => Heroicon::OutlinedCheckCircle,
                    })
                    ->iconColor(fn(Pedido $record): string => match ($record->estatus) {
                        default => 'danger',
                        1 => 'primary',
                        2 => 'info',
                        3 => 'gray',
                        4 => 'success',
                    })
                    ->visibleFrom('md'),
                TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->since()
                    ->toggleable()
                    ->visibleFrom('md'),
            ])
            ->filters([
                SelectFilter::make('estatus')
                    ->options([
                        1 => 'Validar Pago',
                        2 => 'Por Despachar',
                        3 => 'En Proceso',
                        4 => 'Entregado',
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->modalHeading(fn(Pedido $record): string => 'Pedido #' . $record->codigo),
                    Action::make('despachar')
                        ->label('Despachar')
                        ->color('primary')
                        ->icon(Heroicon::OutlinedTruck)
                        ->schema(PedidoResource::formActionDespacho())
                        ->action(function (array $data, Pedido $record) {
                            if ($data['repartidor']) {
                                PedidoRepartidor::create([
                                    'repartidores_id' => $data['repartidor'],
                                    'pedidos_id' => $record->id
                                ]);
                            }
                            $record->estatus = 3;
                            $record->save();
                            //codigo de entrega
                            $codigo = random_int(100000, 999999);
                            Parametro::create([
                                'nombre' => 'pedido_'.$record->rowquid,
                                'valor_id' => $record->id,
                                'valor_texto' => $codigo
                            ]);
                            Notification::make()
                                ->title('Despacho En Proceso')
                                ->success()
                                ->send();
                        })
                        ->modalWidth(Width::Small)
                        ->hidden(fn(Pedido $record): bool => Pedido::find($record->id)?->estatus != 2),
                    Action::make('entregado')
                        ->icon(Heroicon::OutlinedCheckCircle)
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Pedido $record): void {
                            $record->estatus = 4;
                            $record->save();
                            $parametro = Parametro::where('nombre', 'pedido_'.$record->rowquid)->first();
                            if ($parametro){
                                $parametro->delete();
                            }
                        })
                        //->modalIcon(Heroicon::OutlinedCheckCircle)
                        ->hidden(fn(Pedido $record): bool => $record->estatus == 1 || $record->estatus == 4 || $record->is_process)
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
                Action::make('actualizar')
                    ->icon(Heroicon::ArrowPath)
                    ->iconButton(),
            ]);
    }
}
