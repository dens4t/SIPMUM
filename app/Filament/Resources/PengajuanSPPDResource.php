<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanSPPDResource\Pages;
use App\Filament\Resources\PengajuanSPPDResource\RelationManagers;
use App\Models\Kota;
use App\Models\Pegawai;
use App\Models\PengajuanSPPD;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajuanSPPDResource extends Resource
{
    protected static ?string $model = PengajuanSPPD::class;

    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';
    protected static ?string $navigationGroup = 'Permohonan';
    protected static ?string $pluralModelLabel = 'SPPD';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                (!auth()->user()->is_admin ? Forms\Components\Hidden::make('id_pegawai')->default(auth()->user()->pegawai->id) : Forms\Components\Select::make('id_pegawai')->options(Pegawai::all()->pluck('nama', 'id'))->label('Pegawai')->searchable()->required()),
                Forms\Components\Select::make('jenis_sppd')->label('Jenis SPPD')->options([
                    'diklat' => 'Diklat',
                    'non_diklat' => 'Non Diklat',
                ])->required(),
                Forms\Components\Textarea::make('judul_kegiatan')->label('Judul Kegiatan')->required(),
                Forms\Components\DatePicker::make('tanggal_awal_kegiatan')->label('Tanggal Awal Kegiatan')->required(),
                Forms\Components\DatePicker::make('tanggal_akhir_kegiatan')->label('Tanggal Akhir Kegiatan')->required(),
                Forms\Components\TextInput::make('nomor_prk')->label('Nomor PRK')->required(),
                Forms\Components\TextInput::make('nomor_pembebanan')->label('Nomor Pembebanan')->required(),
                Forms\Components\Select::make('jenis_angkutan')->label('Jenis Angkutan')->options([
                    'pesawat' => 'Pesawat',
                    'kereta_api' => 'Kereta Api',
                    'kapal' => 'Kapal',
                    'kendaraan_dinas' => 'Kendaraan Dinas',
                    'kendaraan_umum' => 'Kendaraan Umum',
                ])->required(),
                Forms\Components\Select::make('id_kota_asal')->label('Asal Kota Keberangkatan')->searchable()->options(Kota::all()->pluck('nama', 'id'))->required(),
                Forms\Components\Select::make('id_kota_tujuan')->label('Tujuan Kota Keberangkatan')->searchable()->options(Kota::all()->pluck('nama', 'id'))->required(),
                // Forms\Components\TextInput::make('surat_undangan_penugasan')->label('Link Surat Undangan / Surat Penugasan')->required(),
                Forms\Components\FileUpload::make('surat_undangan_penugasan')
                    ->label('Link Surat Undangan / Surat Penugasan')
                    ->directory('dokumen_pegawai')->storeFileNamesIn('surat_undangan_penugasan')
                    ->maxSize(10240) // Limit file size to 10MB
                    ->acceptedFileTypes(['application/pdf'])->openable()->previewable(false)->nullable()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $columns = [
            Tables\Columns\TextColumn::make('id')->sortable(),
            Tables\Columns\TextColumn::make('jenis_sppd')->label('Jenis')->sortable(),
            Tables\Columns\TextColumn::make('judul_kegiatan')->label('Judul Rapat')->sortable(),
            Tables\Columns\TextColumn::make('tanggal_awal_kegiatan')->label('Tanggal Awal Kegiatan')->sortable(),
            Tables\Columns\TextColumn::make('jenis_angkutan')->label('Jenis Angkutan')->sortable(),
            Tables\Columns\TextColumn::make('kota_tujuan.nama')->label('Tujuan Kota')->sortable(),
        ];
        if (auth()->user()->is_admin)
            array_unshift($columns, Tables\Columns\TextColumn::make('pegawai.nama_unit')->label('Pemohon'));
        return $table
            ->columns($columns)
            ->filters([
                SelectFilter::make('jenis_sppd')
                    ->options([
                        'diklat' => 'Diklat',
                        'non_diklat' => 'Non Dikat',
                    ]),
                SelectFilter::make('jenis_angkutan')
                    ->options([
                        'pesawat' => 'Pesawat',
                        'kereta_api' => 'Kereta Api',
                        'kapal' => 'Kapal',
                        'kendaraan_dinas' => 'Kendaraan Dinas',
                        'kendaraan_umum' => 'Kendaraan Umum',
                    ]),
                SelectFilter::make('kota_tujuan')
                    ->relationship('kota_tujuan', 'nama'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query) {
                $query->with(['pegawai.unit', 'kota_tujuan']);
                if (!auth()->user()->is_admin)
                    return $query->where('id_pegawai', auth()->user()->id_pegawai);
            });
    }

    public static function canViewAny(): bool
    {
        return auth()->check();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePengajuanSPPDS::route('/'),
        ];
    }
}
