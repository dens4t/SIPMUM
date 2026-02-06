<?php

namespace App\Filament\Resources\ApproverResource\Pages;

use App\Filament\Resources\ApproverResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageApprovers extends ManageRecords
{
    protected static string $resource = ApproverResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
