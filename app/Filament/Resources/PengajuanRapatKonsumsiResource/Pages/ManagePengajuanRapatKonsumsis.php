<?php

namespace App\Filament\Resources\PengajuanRapatKonsumsiResource\Pages;

use App\Filament\Resources\PengajuanRapatKonsumsiResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePengajuanRapatKonsumsis extends ManageRecords
{
    protected static string $resource = PengajuanRapatKonsumsiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
