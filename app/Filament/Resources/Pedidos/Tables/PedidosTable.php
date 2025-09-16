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
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class PedidosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('codigo')
                    ->label('Código')
                    ->searchable(),
                TextColumn::make('cedula')
                    ->numeric()
                    ->searchable()
                    ->visibleFrom('md'),
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
                    ->label('Completo')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedXCircle)
                    ->trueColor('danger')
                    ->falseIcon(Heroicon::OutlinedCheckCircle)
                    ->falseColor(function (Pedido $record): string{
                        return match ($record->estatus) {
                            default => 'gray',
                            2 => 'success',
                        };
                    })
                    ->alignCenter(),
                TextColumn::make('estatus')
                    ->formatStateUsing(function (Pedido $record): string {
                        return match ($record->estatus) {
                            default => 'Incompleto',
                            1 => 'Por Despachar',
                            2 => 'Entregado',
                        };
                    })
                    ->alignEnd(),
                TextColumn::make('created_at')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
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
                            $record->estatus = 2;
                            $record->save();
                        })
                        ->hidden(fn(Pedido $record): bool => $record->estatus == 2 || $record->is_process)
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
