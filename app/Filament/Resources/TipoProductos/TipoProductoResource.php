<?php

namespace App\Filament\Resources\TipoProductos;

use App\Filament\Resources\TipoProductos\Pages\CreateTipoProducto;
use App\Filament\Resources\TipoProductos\Pages\EditTipoProducto;
use App\Filament\Resources\TipoProductos\Pages\ListTipoProductos;
use App\Filament\Resources\TipoProductos\Schemas\TipoProductoForm;
use App\Filament\Resources\TipoProductos\Tables\TipoProductosTable;
use App\Models\TipoProducto;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class TipoProductoResource extends Resource
{
    protected static ?string $model = TipoProducto::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedListBullet;

    protected static string | UnitEnum | null $navigationGroup = 'Productos';

    protected static ?string $recordTitleAttribute = 'nombre';

    protected static ?string $modelLabel = 'tipo';

    public static function form(Schema $schema): Schema
    {
        return TipoProductoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TipoProductosTable::configure($table);
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
            'index' => ListTipoProductos::route('/'),
            'create' => CreateTipoProducto::route('/create'),
            'edit' => EditTipoProducto::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
