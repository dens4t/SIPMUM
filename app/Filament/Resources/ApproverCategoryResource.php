<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApproverCategoryResource\Pages;
use App\Models\ApproverCategory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ApproverCategoryResource extends Resource
{
    protected static ?string $model = ApproverCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';
    protected static ?string $navigationGroup = 'Approval';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return auth()->user() && auth()->user()->is_admin;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_kategori')
                    ->label('Nama Kategori')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('urutan')
                    ->label('Urutan')
                    ->numeric()
                    ->default(1)
                    ->required(),
                Forms\Components\Textarea::make('deskripsi')
                    ->label('Deskripsi')
                    ->nullable()
                    ->rows(3),
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
                Tables\Columns\TextColumn::make('nama_kategori')->label('Kategori')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('urutan')->label('Urutan')->sortable(),
                Tables\Columns\TextColumn::make('jumlah_approver')->label('Jumlah Approver'),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Status')
                    ->colors([
                        'success' => true,
                        'danger' => false,
                    ])
                    ->formatStateUsing(fn($state) => $state ? 'Aktif' : 'Tidak Aktif'),
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->withCount('approvers'))
            ->filters([
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
            'index' => Pages\ManageApproverCategories::route('/'),
        ];
    }
}
