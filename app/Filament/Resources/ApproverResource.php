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
use Illuminate\Support\Facades\Validator;

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
                    ->options(fn() => Pegawai::query()->pluck('nama', 'id'))
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
                    ->options(fn() => ApproverCategory::active()->ordered()->pluck('nama_kategori', 'id'))
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('id_atasan')
                    ->label('Atasan Langsung')
                    ->options(fn() => Pegawai::query()->pluck('nama', 'id'))
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
                    ->formatStateUsing(fn($state) => $state ? 'Aktif' : 'Tidak Aktif'),
                Tables\Columns\TextColumn::make('tanggal_mulai')->label('Mulai')->date()->sortable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')->label('Selesai')->date()->sortable(),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->with(['pegawai.bawahan', 'category', 'atasan']))
            ->filters([
                Tables\Filters\SelectFilter::make('id_approver_category')
                    ->label('Kategori')
                    ->options(fn() => ApproverCategory::active()->pluck('nama_kategori', 'id')),
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
