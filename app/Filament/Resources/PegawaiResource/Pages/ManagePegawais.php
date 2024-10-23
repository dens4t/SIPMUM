<?php

namespace App\Filament\Resources\PegawaiResource\Pages;

use App\Filament\Resources\PegawaiResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class ManagePegawais extends ManageRecords
{
    protected static string $resource = PegawaiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()->closeModalByClickingAway(false),
        ];
    }
    // protected function handleRecordCreation(array $data): Model
    // {
    //     $record =  static::getModel()::create($data);
    //     if (!isset($data['username'])) return $record;
    //     $user = User::updateOrCreate(
    //         ['username' => $record['nip']],
    //         [
    //             'email' => $data['email'] ?? null,
    //             'username' => $data['username'],
    //             'password' => bcrypt($data['password']),
    //         ]
    //     );
    //     return $record;
    // }
}
