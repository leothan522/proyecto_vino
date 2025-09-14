<?php

namespace App\Livewire\Dashboard;

use App\Models\Mensaje;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class MensajesTableComponent extends Component implements HasActions, HasSchemas, HasTable
{
    use InteractsWithActions;
    use InteractsWithSchemas;
    use InteractsWithTable;

    public function render()
    {
        return view('livewire.dashboard.mensajes-table-component');
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Mensaje::query()->orderBy('fecha', 'desc'))
            ->columns([
                TextColumn::make('fecha')
                    ->since()
                    ->sortable()
                    ->visibleFrom('md'),
                TextColumn::make('nombre')
                    //->description(fn(Mensaje $record): string => $record->email)
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable()
                    ->visibleFrom('lg'),
                TextColumn::make('asunto')
                    ->searchable()
                    ->visibleFrom('md'),
                IconColumn::make('visto')
                    ->label('Estatus')
                    ->boolean()
                    ->trueIcon(Heroicon::OutlinedEnvelopeOpen)
                    ->trueColor('gray')
                    ->falseIcon(Heroicon::OutlinedEnvelope)
                    ->falseColor('warning')
                    ->alignCenter(),
            ])
            ->recordActions([
                ViewAction::make()
                    ->schema([
                        Section::make()
                            ->schema([
                                TextEntry::make('fecha')
                                    ->date()
                                    ->copyable()
                                    ->color('primary'),
                                TextEntry::make('asunto')
                                    ->copyable()
                                    ->color('primary'),
                                TextEntry::make('nombre')
                                    ->copyable()
                                    ->color('primary'),
                                TextEntry::make('email')
                                    ->copyable()
                                    ->color('primary'),
                                TextEntry::make('mensaje')
                                    ->copyable()
                                    ->color('primary')
                                    ->columnSpanFull(),
                            ])
                            ->compact()
                            ->columns()
                            ->columnSpanFull()
                    ])
                    ->mutateRecordDataUsing(function (array $data, Mensaje $record): array {
                        $record->visto = 1;
                        $record->save();
                        return $data;
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                Action::make('actualizar')
                    ->icon(Heroicon::ArrowPath)
                    ->iconButton(),
            ]);
    }

}
