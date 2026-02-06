<?php

namespace App\Filament\Resources\ApproverCategoryResource\Pages;

use App\Filament\Resources\ApproverCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageApproverCategories extends ManageRecords
{
    protected static string $resource = ApproverCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
