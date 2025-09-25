<?php

namespace App\Filament\Resources\Promotors\Pages;

use App\Filament\Resources\Promotors\PromotorResource;
use App\Models\Promotor;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ManagePromotors extends ManageRecords
{
    protected static string $resource = PromotorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            //CreateAction::make(),
            Action::make('create')
                ->label('Crear Promotor')
                ->schema(self::$resource::formPromotor())
                ->action(function (array $data): void {

                    $user = User::create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'password' => Hash::make($data['password']),
                        'telefono' => $data['telefono'],
                        'access_panel' => 1,
                    ]);

                    $qr = createQRPromotor();

                    Promotor::create([
                        'codigo' => $qr['codigo'],
                        'inicio_comision' => $data['inicio_comision'],
                        'meses_comision' => $data['meses_comision'],
                        'users_id' => $user->id,
                        'image_qr' => $qr['image_qr']
                    ]);

                    Notification::make()
                        ->title('Promotor Creado.')
                        ->success()
                        ->send();

                }),
        ];
    }


}
