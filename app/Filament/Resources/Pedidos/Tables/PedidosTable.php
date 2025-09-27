<?php

namespace App\Filament\Resources\Pedidos\Tables;

use App\Models\Pedido;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
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
                TextColumn::make('nombre_telefono')
                    ->label('Cliente')
                    ->default(fn(Pedido $record): string => Str::upper($record->nombre))
                    ->description(fn(Pedido $record): string => $record->telefono)
                    ->searchable()
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
                    ->icon(fn (Pedido $record): Heroicon => match ($record->estatus) {
                        default => Heroicon::OutlinedXCircle,
                        1 => Heroicon::OutlinedClock,
                        2 => Heroicon::OutlinedTruck,
                        3 => Heroicon::OutlinedCheckCircle,
                    })
                    ->color(fn (Pedido $record): string => match ($record->estatus) {
                        default => 'danger',
                        1 => 'primary',
                        2 => 'gray',
                        3 => 'success',
                    })
                    ->hiddenFrom('md')
                    ->alignCenter(),
                TextColumn::make('estatus')
                    ->formatStateUsing(fn (Pedido $record): string => match ($record->estatus) {
                        default => 'Incompleto',
                        1 => 'Validar Pago',
                        2 => 'Por Despachar',
                        3 => 'Entregado',
                    })
                    ->icon(fn (Pedido $record): Heroicon => match ($record->estatus) {
                        default => Heroicon::OutlinedXCircle,
                        1 => Heroicon::OutlinedClock,
                        2 => Heroicon::OutlinedTruck,
                        3 => Heroicon::OutlinedCheckCircle,
                    })
                    ->iconColor(fn (Pedido $record): string => match ($record->estatus) {
                        default => 'danger',
                        1 => 'primary',
                        2 => 'gray',
                        3 => 'success',
                    })
                    ->visibleFrom('md'),
                TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('estatus')
                    ->options([
                        1 => 'Validar Pago',
                        2 => 'Por Despachar',
                        3 => 'Entregado',
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    Action::make('entregado')
                        ->icon(Heroicon::OutlinedTruck)
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(function (Pedido $record): void {
                            $record->estatus = 3;
                            $record->save();
                        })
                        ->modalIcon(Heroicon::OutlinedTruck)
                        ->hidden(fn(Pedido $record): bool => $record->estatus == 3 || $record->is_process)
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
