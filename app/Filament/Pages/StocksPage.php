<?php

namespace App\Filament\Pages;

use App\Livewire\Dashboard\StocksTableComponent;
use App\Models\Almacen;
use App\Models\Producto;
use App\Models\Stock;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Livewire\Component;
use UnitEnum;

class StocksPage extends Page
{

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCube;

    protected static string|UnitEnum|null $navigationGroup = 'Productos';

    protected static ?string $title = 'Stock';

    protected static ?string $slug = 'stock';

    protected static ?string $navigationLabel = 'Stock';

    protected string $view = 'filament.pages.stocks-page';

    public static function canAccess(): bool
    {
        return \Gate::allows('viewAny', Stock::class);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('entrada')
                ->icon(Heroicon::OutlinedPlus)
                ->schema($this->formStock())
                ->action(fn(array $data, Component $livewire) => $this->entrada($data, $livewire))
                ->modalWidth(Width::Small),
            Action::make('salida')
                ->icon(Heroicon::OutlinedMinus)
                ->schema($this->formStock())
                ->action(fn(array $data, Component $livewire) => $this->salida($data, $livewire))
                ->modalWidth(Width::Small),
        ];
    }

    protected function formStock(): array
    {
        return [
            Select::make('almacenes_id')
                ->label('Municipio')
                ->options(Almacen::query()->pluck('nombre', 'id'))
                ->default(function (): int {
                    $response = 0;
                    $almacen = Almacen::where('is_main', true)->first();
                    if ($almacen) {
                        $response = $almacen->id;
                    }
                    return $response;
                })
                ->required(),
            Select::make('productos_id')
                ->label('Producto')
                ->options(Producto::query()->where('is_active', true)->pluck('nombre', 'id'))
                ->searchable()
                ->preload()
                ->required(),
            TextInput::make('cantidad')
                ->integer()
                ->required(),
        ];
    }

    protected function salida(array $data, Component $livewire): void
    {
        $response = false;
        $stock = $this->getStock($data);
        if ($stock) {
            $cantidad = $stock->disponibles;
            if ($cantidad >= $data['cantidad']){
                $stock->disponibles = $cantidad - $data['cantidad'];
                $stock->save();
                $response = true;
            }
        }

        if ($response){
            $livewire->dispatch('actualizarTablaStock');
            Notification::make()
                ->title('Salida Procesada')
                ->success()
                ->send();
        }else{
            Notification::make()
                ->title('Stock insuficiente')
                ->warning()
                ->send();
        }

    }

    protected function entrada(array $data, Component $livewire): void
    {
        $stock = $this->getStock($data);
        if ($stock) {
            $stock->disponibles = $stock->disponibles + $data['cantidad'];
            $stock->save();
        } else {
            Stock::create([
                'almacenes_id' => $data['almacenes_id'],
                'productos_id' => $data['productos_id'],
                'disponibles' => $data['cantidad'],
            ]);
        }
        $livewire->dispatch('actualizarTablaStock');
        Notification::make()
            ->title('Entrada Procesada')
            ->success()
            ->send();
    }

    protected function getStock(array $data): ?Stock
    {
        return Stock::where('almacenes_id', $data['almacenes_id'])
            ->where('productos_id', $data['productos_id'])
            ->first();
    }
}
