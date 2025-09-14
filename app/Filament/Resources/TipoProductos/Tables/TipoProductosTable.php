<?php

namespace App\Filament\Resources\TipoProductos\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class TipoProductosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable(),
                ImageColumn::make('imagen_path')
                    ->label('Imagen')
                    ->disk('public')
                    ->circular()
                    ->visibility('public')
                    ->defaultImageUrl(asset('img/placeholder.jpg'))
                    ->alignCenter()
                    ->visibleFrom('md'),
                ToggleColumn::make('is_active')
                    ->label('Activo')
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visibleFrom('md'),
                TextColumn::make('deleted_at')
                    ->label('Eliminado')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->visibleFrom('md'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
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
