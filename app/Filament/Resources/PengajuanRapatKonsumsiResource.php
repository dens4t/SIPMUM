<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanRapatKonsumsiResource\Pages;
use App\Models\Approver;
use App\Models\Pegawai;
use App\Models\PengajuanRapatKonsumsi;
use App\Services\ApproverService;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PengajuanRapatKonsumsiResource extends Resource
{
    protected static ?string $model = PengajuanRapatKonsumsi::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Permohonan';

    protected static ?int $navigationSort = 5;

    protected static ?string $pluralModelLabel = 'Rapat Konsumsi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                (! auth()->user()->is_admin ? Forms\Components\Hidden::make('id_pegawai')->default(auth()->user()->pegawai->id) : Forms\Components\Select::make('id_pegawai')->relationship('pegawai', 'nama')->label('Pegawai')->searchable()->preload()->required()),
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
            Tables\Columns\TextColumn::make('rowIndex')
                ->label('#')
                ->rowIndex(),
            Tables\Columns\TextColumn::make('judul_rapat')->label('Judul Rapat')->sortable(),
            Tables\Columns\TextColumn::make('tanggal_waktu_mulai')->label('Tanggal dan Waktu Mulai')->sortable(),
            Tables\Columns\TextColumn::make('ruang')->label('Lokasi Rapat')->sortable(),
            Tables\Columns\TextColumn::make('metode')->label('Metode Rapat')->sortable(),
            Tables\Columns\TextColumn::make('approval.status')
                ->label('Status Approval')
                ->badge()
                ->formatStateUsing(fn (?string $state): string => static::formatApprovalStatus($state))
                ->color(fn (?string $state): string => static::approvalColor($state)),
            Tables\Columns\TextColumn::make('approver_info')
                ->label('Approver')
                ->getStateUsing(function (PengajuanRapatKonsumsi $record): ?string {
                    if (! $record->approval || ! $record->approval->approver) {
                        return 'Belum di-assign';
                    }

                    $approver = $record->approval->approver;
                    $nama = $approver->pegawai?->nama ?? 'Unknown';
                    $kategori = $approver->category?->nama_kategori ?? '';

                    return $kategori ? "$nama ($kategori)" : $nama;
                })
                ->placeholder('Belum di-assign')
                ->sortable()
                ->searchable()
                ->toggleable(),
        ];

        if (static::userCanSeeOthersData()) {
            // Insert Pemohon column after # (at index 1)
            array_splice($columns, 1, 0, [
                Tables\Columns\TextColumn::make('pegawai.nama_unit')
                    ->label('Pemohon')
                    ->sortable()
                    ->searchable(),
            ]);
        }

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
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '=', $date),
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
                Tables\Actions\Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn (PengajuanRapatKonsumsi $record): bool => static::canProcessApproval($record))
                    ->action(function (PengajuanRapatKonsumsi $record): void {
                        $approver = static::getCurrentApprover();

                        if (! $approver) {
                            Notification::make()->title('Akun Anda bukan approver aktif.')->danger()->send();

                            return;
                        }

                        app(ApproverService::class)->approvePengajuan(static::getJenisPengajuan(), $record->id, $approver);

                        Notification::make()->title('Pengajuan berhasil disetujui.')->success()->send();
                    }),
                Tables\Actions\Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->form([
                        Forms\Components\Textarea::make('catatan')
                            ->label('Catatan Penolakan')
                            ->required()
                            ->maxLength(1000),
                    ])
                    ->visible(fn (PengajuanRapatKonsumsi $record): bool => static::canProcessApproval($record))
                    ->action(function (PengajuanRapatKonsumsi $record, array $data): void {
                        $approver = static::getCurrentApprover();

                        if (! $approver) {
                            Notification::make()->title('Akun Anda bukan approver aktif.')->danger()->send();

                            return;
                        }

                        app(ApproverService::class)->rejectPengajuan(static::getJenisPengajuan(), $record->id, $approver, $data['catatan']);

                        Notification::make()->title('Pengajuan berhasil ditolak.')->success()->send();
                    }),
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make()
                    ->visible(fn (PengajuanRapatKonsumsi $record): bool => static::canModifyRecord($record)),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (PengajuanRapatKonsumsi $record): bool => static::canModifyRecord($record)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn (): bool => (bool) auth()->user()?->is_admin),
                ]),
            ])
            ->modifyQueryUsing(function (Builder $query): Builder {
                $query->with([
                    'pegawai.unit',
                    'approval.approver.pegawai',
                    'approval.approver.category',
                ]);

                return static::applyDataVisibilityScope($query);
            });
    }

    protected static function applyDataVisibilityScope(Builder $query): Builder
    {
        $user = auth()->user();

        if (! $user) {
            return $query->whereRaw('1 = 0');
        }

        if ($user->is_admin) {
            return $query;
        }

        $idPegawai = $user->id_pegawai;

        if (! $idPegawai) {
            return $query->whereRaw('1 = 0');
        }

        $activeCategoryNames = static::getActiveApproverCategoryNames((int) $idPegawai);

        if (in_array('Manager', $activeCategoryNames, true)) {
            return $query;
        }

        if (static::hasTeamLeaderScope($activeCategoryNames)) {
            $subordinateIds = Pegawai::query()
                ->where('id_atasan', $idPegawai)
                ->pluck('id');

            if ($subordinateIds->isEmpty()) {
                return $query->whereRaw('1 = 0');
            }

            return $query->whereIn('id_pegawai', $subordinateIds);
        }

        return $query->where('id_pegawai', $idPegawai);
    }

    protected static function getActiveApproverCategoryNames(int $idPegawai): array
    {
        return Approver::query()
            ->where('id_pegawai', $idPegawai)
            ->activeNow()
            ->with('category:id,nama_kategori')
            ->get()
            ->pluck('category.nama_kategori')
            ->filter()
            ->values()
            ->all();
    }

    protected static function hasTeamLeaderScope(array $activeCategoryNames): bool
    {
        foreach ($activeCategoryNames as $categoryName) {
            if ($categoryName === 'Manager') {
                continue;
            }

            if (str_starts_with($categoryName, 'Manager ')
                || str_starts_with($categoryName, 'Team Leader')
                || str_starts_with($categoryName, 'TL ')) {
                return true;
            }
        }

        return false;
    }

    protected static function userCanSeeOthersData(): bool
    {
        $user = auth()->user();

        if (! $user) {
            return false;
        }

        if ($user->is_admin) {
            return true;
        }

        $idPegawai = $user->id_pegawai;

        if (! $idPegawai) {
            return false;
        }

        $activeCategoryNames = static::getActiveApproverCategoryNames((int) $idPegawai);

        // Manager can see all, Team Leaders can see subordinates
        return in_array('Manager', $activeCategoryNames, true)
            || static::hasTeamLeaderScope($activeCategoryNames);
    }

    protected static function getJenisPengajuan(): string
    {
        return 'pengajuan_rapat_konsumsi';
    }

    protected static function getCurrentApprover(): ?Approver
    {
        $idPegawai = auth()->user()?->id_pegawai;

        if (! $idPegawai) {
            return null;
        }

        return Approver::where('id_pegawai', $idPegawai)->activeNow()->first();
    }

    protected static function canProcessApproval(PengajuanRapatKonsumsi $record): bool
    {
        $approver = static::getCurrentApprover();

        return $approver
            && $record->approval
            && $record->approval->status === 'pending'
            && $record->approval->id_approver === $approver->id;
    }

    protected static function canModifyRecord(PengajuanRapatKonsumsi $record): bool
    {
        if (auth()->user()?->is_admin) {
            return true;
        }

        return ! $record->approval || $record->approval->status === 'pending';
    }

    protected static function formatApprovalStatus(?string $status): string
    {
        return match ($status) {
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'pending' => 'Menunggu',
            default => 'Belum Di-assign',
        };
    }

    protected static function approvalColor(?string $status): string
    {
        return match ($status) {
            'approved' => 'success',
            'rejected' => 'danger',
            'pending' => 'warning',
            default => 'gray',
        };
    }

    public static function canViewAny(): bool
    {
        return auth()->check();
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManagePengajuanRapatKonsumsis::route('/'),
        ];
    }
}
