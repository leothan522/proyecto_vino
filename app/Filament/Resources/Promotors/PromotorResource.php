<?php

namespace App\Filament\Resources\Promotors;

use App\Filament\Resources\Promotors\Pages\CreatePromotor;
use App\Filament\Resources\Promotors\Pages\EditPromotor;
use App\Filament\Resources\Promotors\Pages\ListPromotors;
use App\Filament\Resources\Promotors\Schemas\PromotorForm;
use App\Filament\Resources\Promotors\Tables\PromotorsTable;
use App\Models\Promotor;
use BackedEnum;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use UnitEnum;

class PromotorResource extends Resource
{
    protected static ?string $model = Promotor::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static string|UnitEnum|null $navigationGroup = 'Web';

    protected static ?int $navigationSort = 90;

    protected static ?string $slug = 'promotores';

    protected static ?string $modelLabel = 'Promotor';

    protected static ?string $pluralModelLabel = 'Promotores';

    protected static ?string $recordTitleAttribute = 'cedula';

    public static function form(Schema $schema): Schema
    {
        return PromotorForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PromotorsTable::configure($table);
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
            'index' => ListPromotors::route('/'),
            'create' => CreatePromotor::route('/create'),
            'edit' => EditPromotor::route('/{record}/edit'),
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
                Section::make('Datos Básicos')
                    ->schema([
                        TextEntry::make('cedula')
                            ->label('Cédula')
                            ->numeric()
                            ->copyable(),
                        TextEntry::make('user.name')
                            ->copyable(),
                        TextEntry::make('user.email')
                            ->copyable(),
                        TextEntry::make('user.telefono')
                            ->copyable(),
                    ])
                    ->compact()
                    ->columns()
                    ->columnSpanFull()
            ]);
    }
}
