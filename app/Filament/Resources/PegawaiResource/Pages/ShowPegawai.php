<?php

namespace App\Filament\Resources\PegawaiResource\Pages;

use App\Filament\Resources\PegawaiResource;
use App\Models\Pegawai;
use Filament\Resources\Pages\Page;
use Illuminate\Routing\Route;

class ShowPegawai extends Page
{
    protected static string $resource = PegawaiResource::class;
    protected static string $view = 'filament.resources.pegawai-resource.pages.show-pegawai';

    public $pegawai;

    public function mount($pegawaiId)
    {
        $this->pegawai = Pegawai::findOrFail($pegawaiId);
    }


    public static function getRoutes(): array
    {
        return [
            Route::get('/pegawai/{pegawaiId}', static::class)->name('pegawai.show'),
        ];
    }
}
