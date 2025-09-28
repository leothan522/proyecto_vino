<?php

namespace App\Filament\Resources\Repartidors\Pages;

use App\Filament\Resources\Repartidors\RepartidorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\Width;

class ManageRepartidors extends ManageRecords
{
    protected static string $resource = RepartidorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
            ->modalWidth(Width::Small)
            ->createAnother(false),
        ];
    }
}
