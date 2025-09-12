<?php

namespace App\Filament\Resources\Promotors\Pages;

use App\Filament\Resources\Promotors\PromotorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPromotors extends ListRecords
{
    protected static string $resource = PromotorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
