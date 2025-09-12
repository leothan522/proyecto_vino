<?php

namespace App\Filament\Resources\Promotors\Tables;

use App\Models\Promotor;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Toggle;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Support\Enums\Width;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PromotorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('user.profile_photo_path')
                    ->label(__('Image'))
                    ->disk('public')
                    ->circular()
                    ->defaultImageUrl(verImagen(null, true))
                    ->alignCenter()
                    ->visibleFrom('md')
                    ->toggleable()
                    ->visibleFrom('md'),
                TextColumn::make('cedula')
                    ->label('Cédula')
                    ->numeric()
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('user.name')
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('user.telefono')
                    ->label('Teléfono')
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('almacen.nombre')
                    ->label('Municipio')
                    ->alignCenter()
                    ->visibleFrom('md'),
                ToggleColumn::make('user.is_active')
                    ->label('Activo')
                    ->alignCenter()
                    ->disabled(fn(Promotor $record): bool => (auth()->id() == $record->users_id) || !isAdmin() || $record->is_root),
                TextColumn::make('created_at')
                    ->label(__('Created'))
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->label('Eliminado')
                    ->since()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('Municipio')
                    ->relationship('almacen', 'nombre'),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->modalWidth(Width::Small),
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
            ]);
    }
}
