<?php

namespace App\Filament\Widgets;

use App\Models\Unit;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class DaftarUnit extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Unit::withCount('pegawai'),
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama_lengkap')
                ->label('Nama Unit'),
            Tables\Columns\TextColumn::make('pegawai_count')
                ->label('Jumlah Pegawai'),
            ]);
    }
}
