<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NomorSuratResource\Pages;
use App\Filament\Resources\NomorSuratResource\RelationManagers;
use App\Models\NomorSurat;
use App\Models\Pegawai;
use DragonCode\Contracts\Cashier\Resources\Model;
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

class NomorSuratResource extends Resource
{
    protected static ?string $model = NomorSurat::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Permohonan';
    protected static ?string $pluralModelLabel  = 'Nomor Surat';

    public static function form(Form $form): Form
    {
        // dd(auth()->user()->id_pegawai == auth()->user()->id_pegawai);
        return $form
            ->schema([
                // Forms\Components\Select::make('id_pegawai')->options(Pegawai::all()->pluck('nama', 'id'))->label('Pegawai')->searchable()->required(),
                (!auth()->user()->is_admin ? Forms\Components\Hidden::make('id_pegawai')->default(auth()->user()->id_pegawai) : Forms\Components\Select::make('id_pegawai')->options(Pegawai::all()->pluck('nama', 'id'))->label('Pegawai')->searchable()->required()),
                Forms\Components\Select::make('kode_surat')->options([
                    'SKT' => 'Surat Keterangan (Keterangan Kerja, Keterangan Selesai Praktek Industri, dll)',
                    'BA/BAPP' => 'Berita Acara (Pembayaran Fix Cost, Var Cost, Pemakaian BBM, dll.)',
                ])->label('Kode Surat')->required(),
                Forms\Components\Select::make('kode_klasifikasi')->options([
                    'KEU.01.02' => 'Untuk BA (Pembayaran Eksternal)',
                    'ORG.00.02' => 'Untuk SK Tim (Struktur Organisasi)',
                    'SDM.15.01' => 'Untuk Surat Keterangan (Personal File)',
                ])->label('Kode Klasifikasi')->required(),
                Forms\Components\Textarea::make('perihal')->label('Perihal')->required(),
                Forms\Components\DatePicker::make('tanggal')->label('Tanggal')->default(now())->required(),
                Forms\Components\Hidden::make('kode_unit')->label('Kode Unit')->default('UPKS')->required(),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pegawai.nama')->label('Nama Pegawai')->sortable(),
                Tables\Columns\TextColumn::make('perihal')->label('Perihal')->sortable(),
            ])
            ->filters(
                [
                    SelectFilter::make('pegawai')->searchable()->label('Pegawai')
                        ->relationship('pegawai', 'nama'),
                    Filter::make('created_at')
                        ->form([
                            DatePicker::make('created_from')->label('Kegiatan dimulai tanggal'),
                            DatePicker::make('created_until')->label('Hingga tanggal'),
                        ])
                        ->query(function (Builder $query, array $data): Builder {
                            return $query
                                ->when(
                                    $data['created_from'],
                                    fn(Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                                )
                                ->when(
                                    $data['created_until'],
                                    fn(Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                                );
                        }),
                    SelectFilter::make('kode_surat')->label('Kode Surat')->options([
                        'SKT' => 'Surat Keterangan',
                        'BA/BAPP' => 'Berita Acara',
                    ]),
                    SelectFilter::make('kode_klasifikasi')->label('Kode Klasifikasi')->options([
                        'KEU.01.02' => 'Untuk BA (Pembayaran Eksternal)',
                        'ORG.00.02' => 'Untuk SK Tim (Struktur Organisasi)',
                        'SDM.15.01 ' => 'Untuk Surat Keterangan (Personal File)',
                    ]),
                ]
            )
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
                // dd(auth()->user()->id_pegawai);
                if (!auth()->user()->is_admin) return $query->where('id_pegawai', auth()->user()->id_pegawai);
                // dd()
            })

        ;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageNomorSurats::route('/'),
        ];
    }
}
