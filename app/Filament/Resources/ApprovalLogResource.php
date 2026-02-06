<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApprovalLogResource\Pages;
use App\Models\ApprovalLog;
use App\Models\Approver;
use App\Models\ApproverCategory;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ApprovalLogResource extends Resource
{
    protected static ?string $model = ApprovalLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationGroup = 'Approval';
    protected static ?int $navigationSort = 3;

    public static function canViewAny(): bool
    {
        return auth()->user() && auth()->user()->is_admin;
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable(),
                Tables\Columns\TextColumn::make('jenis_pengajuan')
                    ->label('Jenis')
                    ->sortable()
                    ->formatStateUsing(fn($state) => match($state) {
                        'kegiatan' => 'Kegiatan',
                        'nomor_surat' => 'Nomor Surat',
                        'pengajuan_kendaraan_dinas' => 'Kendaraan Dinas',
                        'pengajuan_rapat_konsumsi' => 'Rapat Konsumsi',
                        'pengajuan_sppd' => 'SPPD',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('pengajuan_id')->label('Pengajuan ID')->sortable(),
                Tables\Columns\TextColumn::make('approver.pegawai.nama')->label('Approver')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('approver.category.nama_kategori')->label('Kategori')->sortable(),
                Tables\Columns\TextColumn::make('pegawai.nama')->label('Pengaju')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'approved',
                        'danger' => 'rejected',
                        'warning' => 'pending',
                    ])
                    ->formatStateUsing(fn($state) => match($state) {
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default => 'Menunggu',
                    }),
                Tables\Columns\TextColumn::make('catatan')->label('Catatan')->limit(50),
                Tables\Columns\TextColumn::make('ip_address')->label('IP')->limit(20),
                Tables\Columns\TextColumn::make('created_at')->label('Waktu')->dateTime()->sortable(),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['approver.pegawai', 'approver.category', 'pegawai']))
            ->filters([
                SelectFilter::make('jenis_pengajuan')
                    ->label('Jenis Pengajuan')
                    ->options([
                        'kegiatan' => 'Kegiatan',
                        'nomor_surat' => 'Nomor Surat',
                        'pengajuan_kendaraan_dinas' => 'Kendaraan Dinas',
                        'pengajuan_rapat_konsumsi' => 'Rapat Konsumsi',
                        'pengajuan_sppd' => 'SPPD',
                    ]),
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ]),
                SelectFilter::make('id_approver')
                    ->label('Approver')
                    ->options(fn() => Approver::with('pegawai')->get()->pluck('nama_lengkap', 'id')),
                Filter::make('created_at')
                    ->label('Tanggal')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')->label('Dari'),
                        Forms\Components\DatePicker::make('created_until')->label('Sampai'),
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
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->closeModalByClickingAway(false),
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
            'index' => Pages\ManageApprovalLogs::route('/'),
        ];
    }
}
