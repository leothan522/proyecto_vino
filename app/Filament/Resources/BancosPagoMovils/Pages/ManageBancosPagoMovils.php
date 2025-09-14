<?php

namespace App\Filament\Resources\BancosPagoMovils\Pages;

use App\Filament\Resources\BancosPagoMovils\BancosPagoMovilResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\Width;

class ManageBancosPagoMovils extends ManageRecords
{
    protected static string $resource = BancosPagoMovilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->modalWidth(Width::Small),
        ];
    }
}
