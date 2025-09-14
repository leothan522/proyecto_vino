<?php

namespace App\Filament\Resources\Productos\Tables;

use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Forms\Components\Toggle;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProductosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable(),
                TextColumn::make('tipo.nombre')
                    ->visibleFrom('md'),
                ImageColumn::make('imagen_path')
                    ->label('Imagen')
                    ->disk('public')
                    ->visibility('public')
                    ->defaultImageUrl(asset('img/placeholder.jpg'))
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('precio')
                    ->money()
                    ->alignEnd(),
                ToggleColumn::make('is_active')
                    ->label('Activo')
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('created_at')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('tipos_id')
                    ->label('Tipo')
                    ->relationship('tipo', 'nombre')
                    ->preload(),
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
