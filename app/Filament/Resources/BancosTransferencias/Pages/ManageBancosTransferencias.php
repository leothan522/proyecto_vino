<?php

namespace App\Filament\Resources\BancosTransferencias\Pages;

use App\Filament\Resources\BancosTransferencias\BancosTransferenciaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;
use Filament\Support\Enums\Width;

class ManageBancosTransferencias extends ManageRecords
{
    protected static string $resource = BancosTransferenciaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->createAnother(false)
                ->modalWidth(Width::Small),
        ];
    }
}
