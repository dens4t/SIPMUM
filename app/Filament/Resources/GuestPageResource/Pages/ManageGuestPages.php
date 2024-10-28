<?php

namespace App\Filament\Resources\GuestPageResource\Pages;

use App\Filament\Resources\GuestPageResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageGuestPages extends ManageRecords
{
    protected static string $resource = GuestPageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->closeModalByClickingAway(false),
        ];
    }
}
