<?php

namespace App\Filament\Pages;

use App\Models\Bagian;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\Unit;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class Tentang extends Page implements HasForms
{
    use InteractsWithForms;
    public ?array $data = [];

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static string $view = 'filament.pages.tentang';
    protected static ?string $title = 'Profil Saya';


    public Pegawai $pegawai;

    public static function canAccess(): bool
    {
        return !auth()->user()->is_admin;
    }

    public function mount(Pegawai $record)
    {
        $this->pegawai = Pegawai::find(auth()->user()->id_pegawai);
        $this->form->fill([
            'NIP' => $this->pegawai->NIP,
            'nama' => $this->pegawai->nama,
            'jenis_kelamin' => $this->pegawai->jenis_kelamin,
            'no_ktp' => $this->pegawai->no_ktp,
            'no_npwp' => $this->pegawai->no_npwp,
            'email' => $this->pegawai->email,
            'alamat_lengkap' => $this->pegawai->alamat_lengkap,
            'kota' => $this->pegawai->kota,
            'tempat_lahir' => $this->pegawai->tempat_lahir,
            'keterangan_pegawai' => $this->pegawai->keterangan_pegawai,
            'person_grade' => $this->pegawai->person_grade,
            'position_grade' => $this->pegawai->position_grade,
            'jenjang_jabatan' => $this->pegawai->jenjang_jabatan,
            'tanggal_grade' => $this->pegawai->tanggal_grade,
            'tanggal_mulai' => $this->pegawai->tanggal_mulai,
            'id_jabatan' => $this->pegawai->id_jabatan,
            'id_bagian' => $this->pegawai->id_bagian,
            'id_unit' => $this->pegawai->id_unit,
            'jabatan_lengkap' => $this->pegawai->jabatan_lengkap,
            'tanggal_masuk' => $this->pegawai->tanggal_masuk,
            'tanggal_calon_pegawai' => $this->pegawai->tanggal_calon_pegawai,
            'tanggal_pegawai' => $this->pegawai->tanggal_pegawai,
            'tanggal_lahir' => $this->pegawai->tanggal_lahir,
            'tanggal_berakhir_kerja' => $this->pegawai->tanggal_berakhir_kerja,
            'tanggal_pensiun_normal' => $this->pegawai->tanggal_pensiun_normal,
            'no_hp' => $this->pegawai->no_hp,
            'sk_pengangkatan' => $this->pegawai->dossier_pegawai->sk_pengangkatan ?? null,
            'sk_talenta' => $this->pegawai->dossier_pegawai->sk_talenta ?? null,
            'sk_pembinaan_grade' => $this->pegawai->dossier_pegawai->sk_pembinaan_grade ?? null,
            'sk_mutasi_rotasi' => $this->pegawai->dossier_pegawai->sk_mutasi_rotasi ?? null,
            'data_keluarga' => $this->pegawai->dossier_pegawai->data_keluarga ?? null,
            'data_sertifikasi_kompetensi_dan_pelatihan' => $this->pegawai->dossier_pegawai->data_sertifikasi_kompetensi_dan_pelatihan ?? null,
            'data_pendidikan_terakhir' => $this->pegawai->dossier_pegawai->data_pendidikan_terakhir ?? null,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make('Pegawai Details')->tabs([
                Tab::make('Personal Info')
                    ->schema([
                        TextInput::make('NIP')->disabled()->label('NIP')->required(),
                        TextInput::make('nama')->required(),
                        Select::make('jenis_kelamin')->label('Jenis Kelamin')->options([
                            'L' => 'Laki-Laki',
                            'P' => 'Perempuan'
                        ])->required(),
                        TextInput::make('no_ktp')->label('No KTP'),
                        TextInput::make('no_npwp')->label('No NPWP'),
                        TextInput::make('no_hp')->label('No HP')->required(),
                        TextInput::make('email'),
                        Textarea::make('alamat_lengkap')->label('Alamat Lengkap'),
                        TextInput::make('kota'),
                        TextInput::make('tempat_lahir')->label('Tempat Lahir'),
                        DatePicker::make('tanggal_lahir')->label('Tanggal Lahir'),
                        TextInput::make('keterangan_pegawai')->label('Keterangan Pegawai'),
                        Select::make('id_jabatan')->label('Jabatan')->disabled()->options(Jabatan::all()->pluck('nama', 'id'))->searchable()->required(),
                        Select::make('id_bagian')->label('Bagian')->disabled()->options(Bagian::get()->pluck('nama_lengkap', 'id'))->searchable()->required(),
                        Select::make('id_unit')->label('Unit')->disabled()->options(Unit::all()->pluck('nama_lengkap', 'id'))->searchable()->required(),
                        TextInput::make('keterangan_pegawai')->label('Keterangan Pegawai'),
                    ]),
                Tab::make('Job Info')
                    ->schema([
                        TextInput::make('jabatan_lengkap')->label('Jabatan Lengkap'),
                        DatePicker::make('tanggal_masuk')->label('Tanggal Masuk'),
                        DatePicker::make('tanggal_calon_pegawai')->label('Tanggal Calon Pegawai'),
                        DatePicker::make('tanggal_pegawai')->label('Tanggal Pegawai'),
                        DatePicker::make('tanggal_berakhir_kerja')->label('Tanggal Berakhir Kerja'),
                        DatePicker::make('tanggal_pensiun_normal')->label('Tanggal Pensiun Normal'),
                    ]),

                Tab::make('Grade Info')
                    ->schema([
                        TextInput::make('person_grade')->label('Person Grade'),
                        TextInput::make('position_grade')->label('Position Grade'),
                        TextInput::make('jenjang_jabatan')->label('Jenjang Grade'),
                        DatePicker::make('tanggal_grade')->label('Tanggal Grade'),
                        DatePicker::make('tanggal_mulai')->label('Tanggal Mulai'),
                    ]),
                Tab::make('Dossier Pegawai')
                    ->schema([
                        FileUpload::make('sk_pengangkatan')
                            ->label('SK Pengangkatan')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('sk_pengangkatan')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->disabled()->openable()->previewable(false)->nullable(),
                        // Allow images and PDFs,
                        FileUpload::make('sk_talenta')
                            ->label('SK Talenta')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('sk_talenta')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->disabled()->openable()->previewable(false)->nullable(),
                        FileUpload::make('sk_pembinaan_grade')
                            ->label('SK Talenta')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('sk_pembinaan_grade')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->disabled()->openable()->previewable(false)->nullable(),
                        FileUpload::make('sk_mutasi_rotasi')
                            ->label('SK Mutasi Rotasi')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('sk_mutasi_rotasi')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->disabled()->openable()->previewable(false)->nullable(),
                        FileUpload::make('data_keluarga')
                            ->label('Data Keluarga')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('data_keluarga')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->disabled()->openable()->previewable(false)->nullable(),
                        FileUpload::make('data_sertifikasi_kompetensi_dan_pelatihan')
                            ->label('Data Sertifikasi & Pelatihan')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('data_sertifikasi_kompetensi_dan_pelatihan')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->disabled()->openable()->previewable(false)->nullable(),
                        FileUpload::make('data_pendidikan_terakhir')
                            ->label('Data Pendidikan Terakhir')
                            ->directory('dokumen_pegawai')->storeFileNamesIn('data_pendidikan_terakhir')
                            ->maxSize(10240) // Limit file size to 10MB
                            ->acceptedFileTypes(['application/pdf'])->disabled()->openable()->previewable(false)->nullable(),
                        // ...
                    ]),
                // Forms\Components\Tabs\Tab::make('Account Info')
                //     ->schema([
                //         // Forms\Components\Checkbox::make('buat_akun')->label('Buat Akun?')->reactive(),
                //         Forms\Components\TextInput::make('username')->label('Username'),
                //         Forms\Components\TextInput::make('email')->email()->label('Email'),
                //         Forms\Components\TextInput::make('password')->label('Password Baru')->password(),
                //     ]),

            ])->columnSpanFull(),
        ])->statePath('data');
    }

    public function getFormActions()
    {
        return [
            Action::make('save')->submit('save')
        ];
    }

    public function save()
    {
        try {
            $data = $this->form->getState();
            $pegawai = $this->pegawai->update($data);
            if ($pegawai){
                Notification::make()
                            ->title('Berhasil menyimpan data diri')
                            ->success()
                            ->send();

                redirect('admin/tentang');

            }
        } catch (Halt $ex) {
        }
    }
}
