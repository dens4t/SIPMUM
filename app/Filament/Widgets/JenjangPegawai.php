<?php

namespace App\Filament\Widgets;

use App\Models\Pegawai;
use App\Models\PendidikanTerakhir;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class JenjangPegawai extends BaseWidget
{
    protected static ?string $title = '';


    public function table(Table $table): Table
    {
        return $table
            ->query(
                PendidikanTerakhir::withCount('pegawai')
            )
            ->columns([
                Tables\Columns\TextColumn::make('jenjang')
                    ->label('Jenjang'),
                Tables\Columns\TextColumn::make('pegawai_count')
                    ->label('Jumlah Pegawai'),
                // Tables\Columns\TextColumn::make('total')
                //     ->label('Jumlah Pegawai'),
            ]);
    }
}
