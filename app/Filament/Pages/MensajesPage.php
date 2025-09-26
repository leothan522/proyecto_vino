<?php

namespace App\Filament\Pages;

use App\Models\Mensaje;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class MensajesPage extends Page
{
    protected static string | BackedEnum | null $navigationIcon = Heroicon::OutlinedEnvelope;

    protected static string | UnitEnum | null $navigationGroup = 'Web';

    protected static ?string $title = 'Mensajes';

    protected static ?int $navigationSort = 89;

    protected string $view = 'filament.pages.mensajes-page';

    public static function getNavigationBadge(): ?string
    {
        return Mensaje::where('visto', 0)->count();
    }

    public static function getNavigationBadgeTooltip(): ?string
    {
        return 'Mensajes Nuevos';
    }

    public static function canAccess(): bool
    {
        return \Gate::allows('viewAny', Mensaje::class);
    }
}
