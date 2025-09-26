<?php

namespace App\Filament\Resources\Promotors;

use App\Filament\Resources\Promotors\Pages\ManagePromotors;
use App\Models\Promotor;
use App\Models\User;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\TextSize;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;
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

    protected static ?string $recordTitleAttribute = 'codigo';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('codigo')
                    ->required(),
                DatePicker::make('inicio_comision'),
                TextInput::make('meses_comision')
                    ->numeric(),
                TextInput::make('stock_vendidos')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->required(),
                TextInput::make('users_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(fn (): Builder => Promotor::query()->orderBy('created_at', 'desc'))
            ->recordTitleAttribute('codigo')
            ->columns([
                TextColumn::make('codigo')
                    ->label('Código')
                    ->searchable()
                    ->visibleFrom('md'),
                TextColumn::make('user.name')
                    ->label('Nombre y Teléfono')
                    ->description(fn(Promotor $record): string => $record->user->telefono ?? '')
                    ->searchable(),
                TextColumn::make('inicio_comision')
                    ->label('Inicio Comisíon')
                    ->date()
                    ->sortable()
                    ->alignCenter()
                    ->toggleable()
                    ->visibleFrom('md'),
                TextColumn::make('meses_comision')
                    ->label('Meses')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('stock_vendidos')
                    ->label('Ventas')
                    ->numeric()
                    ->sortable()
                    ->alignCenter()
                    ->visibleFrom('md'),
                ToggleColumn::make('is_active')
                    ->label('Activo')
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->modalHeading('Datos del Promotor'),
                    Action::make('edit')
                        ->label('Editar')
                        ->icon(Heroicon::PencilSquare)
                        ->color('primary')
                        ->fillForm(fn(Promotor $record): array => [
                            'name' => $record->user->name,
                            'email' => $record->user->email,
                            'telefono' => $record->user->telefono,
                            'inicio_comision' => $record->inicio_comision,
                            'meses_comision' => $record->meses_comision,
                            'is_active' => $record->is_active,
                        ])
                        ->schema(fn(Promotor $record): array => self::formPromotor($record->users_id))
                        ->action(function (array $data, Promotor $record): void {
                            $response = false;

                            $user = User::find($record->users_id);
                            $user->name = $data['name'];
                            $user->email = $data['email'];
                            $user->telefono = $data['telefono'];
                            if ($user->isDirty()) {
                                $user->save();
                                $response = true;
                            }

                            $record->inicio_comision = $data['inicio_comision'];
                            $record->meses_comision = $data['meses_comision'];
                            $record->is_active = $data['is_active'];
                            if ($record->isDirty()) {
                                $record->save();
                                $response = true;
                            }

                            if ($response) {
                                Notification::make()
                                    ->title('Datos Actualizados.')
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('No se realizo ningun cambio.')
                                    ->info()
                                    ->send();
                            }

                        })
                        ->modalHeading('Editar Promotor'),
                    DeleteAction::make(),
                    ForceDeleteAction::make(),
                    RestoreAction::make(),
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

    public static function getPages(): array
    {
        return [
            'index' => ManagePromotors::route('/'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function formPromotor($ignoredUser = null): array
    {
        $user = $ignoredUser ? User::find($ignoredUser) : null;

        return [
            Section::make('Datos Básicos')
                ->schema([
                    TextInput::make('name')
                        ->label(__('Name'))
                        ->minLength(3)
                        ->maxLength(255)
                        ->required()
                        ->readOnly(fn() => $user?->is_root || $user?->hasRole('admin')),
                    TextInput::make('email')
                        ->label(__('Email'))
                        ->email()
                        ->unique(table: User::class, ignorable: $ignoredUser ? User::find($ignoredUser) : null, ignoreRecord: false)
                        ->required()
                        ->readOnly(fn() => $user?->is_root || $user?->hasRole('admin')),
                    TextInput::make('password')
                        ->label(__('Password'))
                        ->minLength(8)
                        ->required()
                        ->autocomplete(false)
                        ->hiddenOn('edit'),
                    TextInput::make('telefono')
                        ->label('Teléfono')
                        ->tel()
                        ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/')
                        ->required(),
                ])
                ->columns()
                ->compact(),
            Section::make('Datos Comisión')
                ->schema([
                    DatePicker::make('inicio_comision')
                        ->label('Inicio')
                        ->default(now())
                        ->required(),
                    TextInput::make('meses_comision')
                        ->label('Meses')
                        ->numeric()
                        ->minValue(1)
                        ->maxValue(12)
                        ->required(),
                ])
                ->compact()
                ->columns(),
            Toggle::make('is_active')
                ->label('Acivo')
                ->default(true)
                ->hiddenOn('create'),
        ];
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos Básicos')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('Nombre')
                            ->color('primary')
                            ->copyable(),
                        TextEntry::make('user.email')
                            ->label('Email')
                            ->color('primary')
                            ->copyable(),
                        TextEntry::make('user.telefono')
                            ->label('Teléfono')
                            ->color('primary')
                            ->copyable(),
                        TextEntry::make('inicio_comision')
                            ->date()
                            ->label('Inicio Comisión')
                            ->color('primary'),
                        TextEntry::make('meses_comision')
                            ->label('Meses')
                            ->numeric()
                            ->color('primary'),
                        TextEntry::make('stock_vendidos')
                            ->label('Ventas')
                            ->numeric()
                            ->color('primary'),
                    ])
                    ->compact(),
                Section::make('Código QR')
                    ->schema([
                        ImageEntry::make('image_qr')
                            ->hiddenLabel()
                            ->disk('public')
                            ->visibility('public')
                            ->imageSize(250)
                            ->alignCenter(),
                        TextEntry::make('codigo')
                            ->label('Link')
                            ->formatStateUsing(fn(string $state): string => route('web.codigo', $state))
                            ->wrap(false)
                            ->color('primary')
                            ->copyable()
                            ->columnSpanFull(),])
                    ->compact(),
            ]);
    }

}
