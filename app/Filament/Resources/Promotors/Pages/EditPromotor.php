<?php

namespace App\Filament\Resources\Promotors\Pages;

use App\Filament\Resources\Promotors\PromotorResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditPromotor extends EditRecord
{
    protected static string $resource = PromotorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
