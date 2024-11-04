<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanKendaraanDinasResource\Pages;
use App\Filament\Resources\PengajuanKendaraanDinasResource\RelationManagers;
use App\Models\Driver;
use App\Models\Kendaraan;
use App\Models\Pegawai;
use App\Models\PengajuanKendaraanDinas;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajuanKendaraanDinasResource extends Resource
{
    protected static ?string $model = PengajuanKendaraanDinas::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $navigationGroup = 'Permohonan';
    protected static ?string $pluralModelLabel  = 'Pengajuan Kendaraan Dinas';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                (!auth()->user()->is_admin ? Forms\Components\Hidden::make('id_pegawai')->default(auth()->user()->pegawai->id) : Forms\Components\Select::make('id_pegawai')->options(Pegawai::all()->pluck('nama', 'id'))->label('Pegawai')->searchable()->required()),
                Forms\Components\DatePicker::make('tanggal_peminjaman')->label('Tanggal Peminjaman')->required(),
                Forms\Components\DatePicker::make('tanggal_pengembalian')->label('Tanggal Pengembalian')->required(),
                Forms\Components\Textarea::make('keperluan')->label('Keperluan')->required(),
                Forms\Components\TextInput::make('tujuan')->label('tujuan')->required(),
                Forms\Components\TextInput::make('stand_km_awal')->label('Stand KM Awal')->required(),
                Forms\Components\Select::make('id_driver')->label('Driver')->options(Driver::all()->pluck('nama', 'id'))->searchable()->required(),
                Forms\Components\Select::make('id_kendaraan')->label('Kendaraan')->options(Kendaraan::all()->pluck('jenis_mobil', 'id'))->searchable()->required(),
                // Forms\Components\Select::make('no_hp')->label('No HP')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('pegawai.nama_unit')->label('Pemohon')->sortable(),
                Tables\Columns\TextColumn::make('tanggal_peminjaman')->label('Tgl Peminjaman')->sortable(),
                Tables\Columns\TextColumn::make('tanggal_pengembalian')->label('Tgl Pengembalian')->sortable(),
                Tables\Columns\TextColumn::make('keperluan')->label('Keperluan')->sortable(),

            ])
            ->filters([
                SelectFilter::make('pegawai')->searchable()->label('Pegawai')
                    ->relationship('pegawai', 'nama'),
                SelectFilter::make('driver')->label('Driver')
                    ->relationship('driver', 'nama'),
                SelectFilter::make('kendaraan')->label('Kendaraan')
                    ->relationship('kendaraan', 'jenis_mobil'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePengajuanKendaraanDinas::route('/'),
        ];
    }
}
