<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanRapatKonsumsiResource\Pages;
use App\Filament\Resources\PengajuanRapatKonsumsiResource\RelationManagers;
use App\Models\Pegawai;
use App\Models\PengajuanRapatKonsumsi;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajuanRapatKonsumsiResource extends Resource
{
    protected static ?string $model = PengajuanRapatKonsumsi::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Permohonan';
    protected static ?string $pluralModelLabel  = 'Rapat Konsumsi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                (!auth()->user()->is_admin ? Forms\Components\Hidden::make('id_pegawai')->default(auth()->user()->pegawai->id) : Forms\Components\Select::make('id_pegawai')->options(Pegawai::all()->pluck('nama', 'id'))->label('Pegawai')->searchable()->required()),
                Forms\Components\Textarea::make('judul_rapat')->label('Judul Rapat')->required(),
                Forms\Components\TextInput::make('jumlah_peserta_rapat')->integer()->label('Jumlah Peserta Rapat')->required(),
                Forms\Components\DateTimePicker::make('tanggal_waktu_mulai')->label('Tanggal dan Waktu Mulai')->required(),
                Forms\Components\DateTimePicker::make('tanggal_waktu_selesai')->label('Tanggal dan Waktu Selesai')->required(),
                Forms\Components\Select::make('metode')->label('Metode')->options([
                    'offline' => 'Offline',
                    'online' => 'Online',
                ])->required(),
                Forms\Components\Select::make('ruang')->label('Ruang')->options([
                    'upks' => 'Ruang Rapat UPKS',
                    'baca' => 'Ruang Baca',
                ])->required(),

                Forms\Components\Select::make('jenis_konsumsi')->label('Jenis Konsumsi')->options([
                    'snack_minum' => 'Snack dan Minum',
                    'snack_minum_makan' => 'Snack, Minum, dan Makan',
                    'makan_minum' => 'Makan dan Minum',
                ])->required(),
                Forms\Components\TextInput::make('surat_undangan_rapat')->label('Link Surat Undangan Rapat')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        $columns = [
            Tables\Columns\TextColumn::make('judul_rapat')->label('Judul Rapat')->sortable(),
            Tables\Columns\TextColumn::make('tanggal_waktu_mulai')->label('Tanggal dan Waktu Mulai')->sortable(),
            Tables\Columns\TextColumn::make('ruang')->label('Lokasi Rapat')->sortable(),
            Tables\Columns\TextColumn::make('metode')->label('Metode Rapat')->sortable(),
        ];
        if (auth()->user()->is_admin) array_unshift($columns, Tables\Columns\TextColumn::make('pegawai.nama_unit')->label('Pemohon')->sortable());
        return $table
            ->columns($columns)
            ->filters([
                Filter::make('tanggal_waktu_mulai')
                    ->form([
                        DatePicker::make('created_from')->label('Tanggal Mulai Rapat'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('created_at', '=', $date),
                            );
                    }),
                SelectFilter::make('metode')
                    ->options([
                        'offline' => 'Offline',
                        'online' => 'Online',
                    ]),

                SelectFilter::make('ruang')
                    ->options([
                        'upks' => 'Ruang Rapat UPKS',
                        'baca' => 'Ruang Baca',
                    ]),
                SelectFilter::make('jenis_konsumsi')
                    ->options([
                        'snack_minum' => 'Snack dan Minum',
                        'snack_minum_makan' => 'Snack, Minum, dan Makan',
                        'makan_minum' => 'Makan dan Minum',
                    ]),
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
            ])
            ->modifyQueryUsing(function (Builder $query) {
                if (!auth()->user()->is_admin) return $query->where('id_pegawai', auth()->user()->id_pegawai);
            });
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePengajuanRapatKonsumsis::route('/'),
        ];
    }
}
