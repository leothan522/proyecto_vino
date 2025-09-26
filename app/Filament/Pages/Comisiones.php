<?php

namespace App\Filament\Pages;

use App\Livewire\Dashboard\PromotoresWidget;
use App\Models\Promotor;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Str;

class Comisiones extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::Link;

    protected static ?int $navigationSort = 80;

    protected static ?string $navigationLabel = 'Ventas Referidas';

    protected static ?string $title = 'Ventas Referidas';

    protected static ?string $slug = 'ventas-referidas';

    protected string $view = 'filament.pages.comisiones';

    public ?int $promotores_id = null;
    public string $labelPromotor = 'Ver Promotor';

    public function mount(): void
    {
        $this->setPromotor();
    }

    protected function getHeaderWidgets(): array
    {
        return [
            PromotoresWidget::class
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('verPromotor')
                ->label($this->labelPromotor)
                ->icon(Heroicon::OutlinedUser)
                ->schema([
                    Select::make('promotor_id')
                        ->label('Promotor')
                        ->options(Promotor::with('user')
                            ->get()
                            ->pluck('user.name', 'id')
                            ->mapWithKeys(fn ($name, $id) => [$id => strtoupper($name)])
                        )
                        ->searchable()
                        ->preload()
                        ->default($this->promotores_id)
                        ->required(),
                ])
                ->action(function (array $data): void {
                    $this->setPromotor($data['promotor_id']);
                })
                ->modalHeading('Selecciona un Promotor')
                ->modalWidth(Width::Small)
                ->disabled(!isAdmin())
                ->hidden(!isAdmin())
        ];
    }

    protected function setPromotor($id = null): void
    {
        $promotor = $id ? Promotor::find($id) : Promotor::where('users_id', auth()->id())->first();
        if ($promotor){
            $this->promotores_id = $promotor->id;
            $this->labelPromotor = Str::upper($promotor->user->name);
        }
    }

}
