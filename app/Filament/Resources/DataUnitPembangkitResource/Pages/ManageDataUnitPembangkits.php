<?php

namespace App\Filament\Resources\DataUnitPembangkitResource\Pages;

use App\Filament\Resources\DataUnitPembangkitResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageDataUnitPembangkits extends ManageRecords
{
    protected static string $resource = DataUnitPembangkitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
