<?php

namespace App\Livewire\Dashboard;

use App\Models\Stock;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Livewire\Component;

class StocksTableComponent extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public function render()
    {
        return view('livewire.dashboard.stocks-table-component');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Stock::query())
            ->columns([
                TextColumn::make('producto.nombre')
                    ->description(fn(Stock $record): string => $record->almacen->nombre)
                    ->wrap()
                    ->searchable(),
                ImageColumn::make('producto.imagen_path')
                    ->label('Imagen')
                    ->disk('public')
                    ->visibility('public')
                    ->defaultImageUrl(asset('img/placeholder.jpg'))
                    ->alignCenter()
                    ->visibleFrom('md'),
                TextColumn::make('disponibles')
                    ->numeric()
                    ->default(0)
                    ->alignEnd(),
                TextColumn::make('comprometidos')
                    ->numeric()
                    ->default(0)
                    ->alignEnd()
                    ->visibleFrom('md'),
                TextColumn::make('vendidos')
                    ->numeric()
                    ->default(0)
                    ->alignEnd()
                    ->visibleFrom('md')
            ])
            ->filters([
                SelectFilter::make('almacenes_id')
                    ->label('Municipio')
                    ->relationship('almacen', 'nombre', fn(Builder $query) => $query->orderBy('created_at'))
                    ->preload(),
                TrashedFilter::make()
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make()
                        ->schema($this->getViewSchema()),
                    Action::make('entrada')
                        ->icon(Heroicon::OutlinedPlus)
                        ->color('primary')
                        ->schema([
                            TextInput::make('cantidad')
                                ->integer()
                                ->required(),
                        ])
                        ->action(function (array $data, Stock $record) {
                            $record->disponibles = $record->disponibles + $data['cantidad'];
                            $record->save();
                            Notification::make()
                                ->title('Entrada Procesada')
                                ->success()
                                ->send();
                        })
                        ->modalWidth(Width::Small)
                        ->modalDescription(function (Stock $record): string {
                            return "Producto " . $record->producto->nombre . " en " . $record->almacen->nombre;
                        })
                        ->disabled(fn(Stock $record): bool => !$record->producto->is_active),
                    Action::make('salida')
                        ->icon(Heroicon::OutlinedMinus)
                        ->color('primary')
                        ->schema([
                            TextInput::make('cantidad')
                                ->integer()
                                ->required(),
                        ])
                        ->action(function (array $data, Stock $record) {
                            $response = false;
                            $cantidad = $record->disponibles;
                            if ($cantidad >= $data['cantidad']) {
                                $record->disponibles = $cantidad - $data['cantidad'];
                                $record->save();
                                $response = true;
                            }
                            if ($response) {
                                Notification::make()
                                    ->title('Salida Procesada')
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Stock insuficiente')
                                    ->warning()
                                    ->send();
                            }
                        })
                        ->modalWidth(Width::Small)
                        ->modalDescription(function (Stock $record): string {
                            return "Producto " . $record->producto->nombre . " en " . $record->almacen->nombre;
                        })
                        ->disabled(fn(Stock $record): bool => !$record->producto->is_active),
                ])
            ])
            ->recordAction('view')
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

    #[On('actualizarTablaStock')]
    public function actualizarTablaStock()
    {
        //Refresh
    }

    protected function getViewSchema(): array
    {
        return [
            Section::make()
                ->schema([
                    ImageEntry::make('producto.imagen_path')
                        ->label('Imagen')
                        ->disk('public')
                        ->visibility('public')
                        ->defaultImageUrl(asset('img/placeholder.jpg')),
                    TextEntry::make('producto.nombre')
                        ->label('Producto')
                        ->color('primary')
                        ->icon(fn(Stock $record) => $record->producto->is_active ? Heroicon::CheckCircle : Heroicon::NoSymbol)
                        ->iconColor(fn(Stock $record) => $record->producto->is_active ? 'success' : 'gray')
                        ->iconPosition(IconPosition::After),
                    TextEntry::make('almacen.nombre')
                        ->label('Municipio')
                        ->color('primary'),
                    TextEntry::make('disponibles')
                        ->numeric()
                        ->default(0)
                        ->color('primary'),
                    TextEntry::make('comprometidos')
                        ->numeric()
                        ->default(0)
                        ->color('primary'),
                    TextEntry::make('vendidos')
                        ->numeric()
                        ->default(0)
                        ->color('primary'),
                ])
                ->compact()
                ->columns(3)
                ->columnSpanFull()
        ];
    }


    }
