<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PegawaiResource\Pages;
use App\Filament\Resources\PegawaiResource\RelationManagers;
use App\Models\Bagian;
use App\Models\DossierPegawai;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\PendidikanTerakhir;
use App\Models\Unit;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Collection;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Instansi';
    protected static ?string $pluralModelLabel  = 'Pegawai';
    protected static ?int $navigationSort = 0;


    public static function canViewAny(): bool
    {
        return auth()->user()->is_admin;
    }

    // protected function mutateFormDataBeforeFill(array $data): array
    // {
    //     // Handle user account creation separately
    //     $user = User::updateOrCreate(
    //         ['username' => $data['username']], // Find user by email
    //         [
    //             'email' => $data['email'] ?? null,
    //             'password' => bcrypt($data['password']),
    //         ]
    //     );

    //     // Link the created user to the Pegawai
    //     // $data['user_id'] = $user->id;

    //     // Remove the `username`, `email`, and `password` fields from Pegawai data

    //     return $data;
    // }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Tabs::make('Pegawai Details')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('Personal Info')
                            ->schema([
                                Forms\Components\TextInput::make('NIP')->label('NIP')->required(),
                                Forms\Components\TextInput::make('nama')->required(),
                                Forms\Components\Select::make('jenis_kelamin')->label('Jenis Kelamin')->options([
                                    'L' => 'Laki-Laki',
                                    'P' => 'Perempuan'
                                ])->required(),
                                Forms\Components\TextInput::make('no_ktp')->label('No KTP'),
                                Forms\Components\TextInput::make('no_npwp')->label('No NPWP'),
                                Forms\Components\TextInput::make('no_hp')->label('No HP')->required(),
                                Forms\Components\TextInput::make('email'),
                                Forms\Components\Textarea::make('alamat_lengkap')->label('Alamat Lengkap'),
                                Forms\Components\TextInput::make('kota'),
                                Forms\Components\TextInput::make('tempat_lahir')->label('Tempat Lahir'),
                                Forms\Components\DatePicker::make('tanggal_lahir')->label('Tanggal Lahir'),
                                Forms\Components\TextInput::make('keterangan_pegawai')->label('Keterangan Pegawai'),
                                Forms\Components\Select::make('id_jabatan')->label('Jabatan')->options(Jabatan::all()->pluck('nama', 'id'))->searchable()->required(),
                                Forms\Components\Select::make('id_bagian')->label('Bagian')->options(Bagian::get()->pluck('nama_lengkap', 'id'))->searchable()->required(),
                                Forms\Components\Select::make('id_unit')->label('Unit')->options(Unit::all()->pluck('nama_lengkap', 'id'))->searchable()->required(),
                                Forms\Components\Select::make('id_pendidikan_terakhir')->label('Pendidikan Terakhir')->options(PendidikanTerakhir::all()->pluck('jenjang', 'id'))->searchable()->required(),
                                Forms\Components\TextInput::make('keterangan_pegawai')->label('Keterangan Pegawai'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Job Info')
                            ->schema([

                                Forms\Components\TextInput::make('jabatan_lengkap')->label('Jabatan Lengkap'),
                                Forms\Components\DatePicker::make('tanggal_masuk')->label('Tanggal Masuk'),
                                Forms\Components\DatePicker::make('tanggal_calon_pegawai')->label('Tanggal Calon Pegawai'),
                                Forms\Components\DatePicker::make('tanggal_pegawai')->label('Tanggal Pegawai'),
                                Forms\Components\DatePicker::make('tanggal_berakhir_kerja')->label('Tanggal Berakhir Kerja'),
                                Forms\Components\DatePicker::make('tanggal_pensiun_normal')->label('Tanggal Pensiun Normal'),
                            ]),

                        Forms\Components\Tabs\Tab::make('Grade Info')
                            ->schema([
                                Forms\Components\TextInput::make('person_grade')->label('Person Grade'),
                                Forms\Components\TextInput::make('position_grade')->label('Position Grade'),
                                Forms\Components\TextInput::make('jenjang_jabatan')->label('Jenjang Grade'),
                                Forms\Components\DatePicker::make('tanggal_grade')->label('Tanggal Grade'),
                                Forms\Components\DatePicker::make('tanggal_mulai')->label('Tanggal Mulai'),
                            ]),
                        // Forms\Components\Tabs\Tab::make('Account Info')
                        //     ->schema([
                        //         // Forms\Components\Checkbox::make('buat_akun')->label('Buat Akun?')->reactive(),
                        //         Forms\Components\TextInput::make('username')->label('Username'),
                        //         Forms\Components\TextInput::make('email')->email()->label('Email'),
                        //         Forms\Components\TextInput::make('password')->label('Password Baru')->password(),
                        //     ]),

                    ])->columnSpanFull(),
            ]);
    }



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama')->sortable(),
                Tables\Columns\TextColumn::make('unit.nama_lengkap')->label('Unit')->sortable(),
                Tables\Columns\TextColumn::make('jabatan.nama')->label('Nama Jabatan')->sortable(),
            ])
            ->filters([
                SelectFilter::make('jabatan')->label('Jabatan')
                ->relationship('jabatan', 'nama'),
                SelectFilter::make('unit')->label('Unit')
                ->relationship('unit', 'nama'),
                SelectFilter::make('jabatan')->label('Jabatan')
                ->relationship('jabatan', 'nama'),
                SelectFilter::make('pendidikan_terakhir')->label('Pendidikan Terakhir')
                ->relationship('pendidikan_terakhir', 'jenjang'),
            ])
            ->actions([
                // Tables\Actions\DossierPegawaAction::make()->closeModalByClickingAway(false),
                Tables\Actions\ViewAction::make()->closeModalByClickingAway(false),
                Tables\Actions\EditAction::make()->closeModalByClickingAway(false),
                Tables\Actions\DeleteAction::make()->closeModalByClickingAway(false),
                Tables\Actions\Action::make('updateDossier')->label('Dossier Pegawai')->slideOver()->icon('heroicon-m-circle-stack')
                    // ->model(DossierPegawai::class)
                    ->fillForm(function (Pegawai $record) {
                        if (!$record->dossier_pegawai) return;
                        return [
                            'sk_pengangkatan' => $record->dossier_pegawai->sk_pengangkatan,
                            'sk_talenta' => $record->dossier_pegawai->sk_talenta,
                            'sk_pembinaan_grade' => $record->dossier_pegawai->sk_pembinaan_grade,
                            'sk_mutasi_rotasi' => $record->dossier_pegawai->sk_mutasi_rotasi,
                            'data_keluarga' => $record->dossier_pegawai->data_keluarga,
                            'data_sertifikasi_kompetensi_dan_pelatihan' => $record->dossier_pegawai->data_sertifikasi_kompetensi_dan_pelatihan,
                            'data_pendidikan_terakhir' => $record->dossier_pegawai->data_pendidikan_terakhir,
                        ];
                    })
                    ->form([
                        Forms\Components\FileUpload::make('sk_pengangkatan')
                            ->label('SK Pengangkatan')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('sk_pengangkatan')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->openable()->previewable(false)->nullable(),
                        // Allow images and PDFs,
                        Forms\Components\FileUpload::make('sk_talenta')
                            ->label('SK Talenta')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('sk_talenta')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->openable()->previewable(false)->nullable(),
                        Forms\Components\FileUpload::make('sk_pembinaan_grade')
                            ->label('SK Talenta')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('sk_pembinaan_grade')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->openable()->previewable(false)->nullable(),
                        Forms\Components\FileUpload::make('sk_mutasi_rotasi')
                            ->label('SK Mutasi Rotasi')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('sk_mutasi_rotasi')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->openable()->previewable(false)->nullable(),
                        Forms\Components\FileUpload::make('data_keluarga')
                            ->label('Data Keluarga')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('data_keluarga')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->openable()->previewable(false)->nullable(),
                        Forms\Components\FileUpload::make('data_sertifikasi_kompetensi_dan_pelatihan')
                            ->label('Data Sertifikasi & Pelatihan')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('data_sertifikasi_kompetensi_dan_pelatihan')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->openable()->previewable(false)->nullable(),
                        Forms\Components\FileUpload::make('data_pendidikan_terakhir')
                            ->label('Data Pendidikan Terakhir')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('data_pendidikan_terakhir')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->openable()->previewable(false)->nullable(),
                        // ...
                    ])

                    ->action(function (array $data, Pegawai $record) {
                        // dd($data);
                        // $idPegawai = $livewire->getRecord()->id;
                        // $data['id_pegawai'] = $record->id;
                        DossierPegawai::updateOrCreate(['id_pegawai' => $record->id], $data);

                        // if (!$record->dossier_pegawai) return $record->dossier_pegawai()->create($data);
                        // $record->dossier_pegawai()->associate($data['id_pegawai']);
                        // $record->save();
                        Notification::make()
                            ->title('Berhasil menyimpan dossier')
                            ->success()
                            ->send();
                    }),
                Tables\Actions\Action::make('buatUser')->label('User Pegawai')->slideOver()->icon('heroicon-m-arrow-right-end-on-rectangle')
                    // ->model(DossierPegawai::class)
                    ->fillForm(function (Pegawai $record) {
                        $data = ['username' => $record->NIP];
                        if ($record->user) {
                            $data['username'] = $record->user->username;
                            $data['email'] = $record->user->email;
                        }
                        return $data;
                    })
                    ->form([
                        Forms\Components\TextInput::make('username'),
                        Forms\Components\TextInput::make('email')->email(),
                        Forms\Components\TextInput::make('password')->label('Password Baru')->password(),
                    ])
                    ->action(function (array $data, Pegawai $record) {
                        $data['name'] = $record['nama'];
                        $data['id_pegawai'] = $record['id'];
                        $data['password'] = Hash::make($data['password']);
                        User::updateOrCreate(['id_pegawai' => $record->id], $data);
                        Notification::make()
                            ->title('Berhasil menyimpan akun pegawai')
                            ->success()
                            ->send();
                    }),
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
            'index' => Pages\ManagePegawais::route('/'),
        ];
    }
}
