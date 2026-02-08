<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApproverResource\Pages;
use App\Models\Approver;
use App\Models\ApproverCategory;
use App\Models\Pegawai;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ApproverResource extends Resource
{
    protected static ?string $model = Approver::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Approval';

    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        return auth()->user() && auth()->user()->is_admin;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_pegawai')
                    ->label('Pegawai')
                    ->options(fn () => Pegawai::query()->pluck('nama', 'id'))
                    ->searchable()
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, Forms\Set $set) {
                        if ($state) {
                            $pegawai = Pegawai::find($state);
                            if ($pegawai && $pegawai->id_atasan) {
                                $set('id_atasan', $pegawai->id_atasan);
                            }
                        }
                    }),
                Forms\Components\Select::make('id_approver_category')
                    ->label('Kategori Approver')
                    ->options(fn () => ApproverCategory::active()->ordered()->pluck('nama_kategori', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('id_atasan')
                    ->label('Atasan Langsung')
                    ->options(fn () => Pegawai::query()->pluck('nama', 'id'))
                    ->searchable()
                    ->disabled()
                    ->dehydrated(false)
                    ->nullable(),
                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->nullable(),
                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->nullable(),
                Forms\Components\Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('pegawai.nama')->label('Nama Approver')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('category.nama_kategori')->label('Kategori')->sortable(),
                Tables\Columns\TextColumn::make('atasan.nama')->label('Atasan')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('jumlah_bawahan')->label('Bawahan'),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Status')
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ])
                    ->formatStateUsing(fn ($state) => $state ? 'Aktif' : 'Tidak Aktif'),
                Tables\Columns\TextColumn::make('tanggal_mulai')->label('Mulai')->date()->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')->label('Selesai')->date()->sortable(),
            ])
            ->modifyQueryUsing(fn (Builder $query) => $query->with(['pegawai.bawahan', 'category', 'atasan']))
            ->filters([
                Tables\Filters\SelectFilter::make('id_approver_category')
                    ->label('Kategori')
                    ->options(fn () => ApproverCategory::active()->pluck('nama_kategori', 'id')),
                Tables\Filters\SelectFilter::make('is_active')
                    ->label('Status')
                    ->options([
                        '1' => 'Aktif',
                        '0' => 'Tidak Aktif',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->closeModalByClickingAway(false),
                Tables\Actions\EditAction::make()->closeModalByClickingAway(false),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('lihatBawahan')
                    ->label('Lihat Bawahan')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->modalHeading(fn (Approver $record) => "Daftar Bawahan: {$record->pegawai?->nama}")
                    ->modalContent(fn (Approver $record) => view(
                        'filament.resources.approver-resource.bawahan-list',
                        ['bawahan' => $record->pegawai?->bawahan ?? collect()]
                    ))
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Tutup'),
                Tables\Actions\Action::make('kelolaBawahan')
                    ->label('Kelola Bawahan')
                    ->icon('heroicon-o-user-group')
                    ->color('warning')
                    ->slideOver()
                    ->fillForm(function (Approver $record) {
                        return [
                            'bawahan_ids' => $record->pegawai?->bawahan?->pluck('id')->toArray() ?? [],
                        ];
                    })
                    ->form([
                        Forms\Components\Section::make('Informasi')
                            ->description('Pilih pegawai yang akan menjadi bawahan dari approver ini.')
                            ->schema([
                                Forms\Components\Select::make('bawahan_ids')
                                    ->label('Pilih Bawahan')
                                    ->multiple()
                                    ->options(function (Approver $record) {
                                        return Pegawai::query()
                                            ->where('id', '!=', $record->id_pegawai)
                                            ->pluck('nama', 'id');
                                    })
                                    ->searchable()
                                    ->preload()
                                    ->helperText('Pegawai yang dipilih akan diatur sebagai bawahan dari approver ini.'),
                            ]),
                    ])
                    ->action(function (array $data, Approver $record) {
                        $idPegawaiApprover = $record->id_pegawai;
                        $selectedIds = $data['bawahan_ids'] ?? [];

                        DB::transaction(function () use ($idPegawaiApprover, $selectedIds) {
                            // Reset bawahan yang tidak dipilih lagi
                            Pegawai::where('id_atasan', $idPegawaiApprover)
                                ->whereNotIn('id', $selectedIds)
                                ->update(['id_atasan' => null]);

                            // Update bawahan yang dipilih
                            if (! empty($selectedIds)) {
                                Pegawai::whereIn('id', $selectedIds)
                                    ->update(['id_atasan' => $idPegawaiApprover]);
                            }
                        });

                        Notification::make()
                            ->title('Berhasil mengupdate bawahan')
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
            'index' => Pages\ManageApprovers::route('/'),
        ];
    }
}
