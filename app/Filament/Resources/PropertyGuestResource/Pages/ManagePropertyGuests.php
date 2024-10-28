<?php

namespace App\Filament\Resources\PropertyGuestResource\Pages;

use App\Filament\Resources\PropertyGuestResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePropertyGuests extends ManageRecords
{
    protected static string $resource = PropertyGuestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
