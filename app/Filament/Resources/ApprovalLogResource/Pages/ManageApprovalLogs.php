<?php

namespace App\Filament\Resources\ApprovalLogResource\Pages;

use App\Filament\Resources\ApprovalLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageApprovalLogs extends ManageRecords
{
    protected static string $resource = ApprovalLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(), // View only, tidak perlu create
        ];
    }
}
