<?php

namespace App\Filament\Resources\Galerias\Tables;

use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GaleriasTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen_path')
                    ->label('Imagen')
                    ->disk('public')
                    ->default(asset('img/placeholder.jpg'))
                    ->alignCenter(),
                TextColumn::make('titulo')
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('fecha')
                    ->date()
                    ->searchable()
                    ->sortable()
                    ->alignEnd(),
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
                    EditAction::make(),
                    DeleteAction::make(),
                ])
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
