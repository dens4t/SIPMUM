<?php

namespace App\Filament\Resources\PengajuanKendaraanDinasResource\Pages;

use App\Filament\Resources\PengajuanKendaraanDinasResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManagePengajuanKendaraanDinas extends ManageRecords
{
    protected static string $resource = PengajuanKendaraanDinasResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
