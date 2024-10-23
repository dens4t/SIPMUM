<?php

namespace App\Filament\Resources\PengajuanSPPDResource\Pages;

use App\Filament\Resources\PengajuanSPPDResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePengajuanSPPDS extends ManageRecords
{
    protected static string $resource = PengajuanSPPDResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
