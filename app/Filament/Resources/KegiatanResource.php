<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KegiatanResource\Pages;
use App\Filament\Resources\KegiatanResource\RelationManagers;
use App\Models\Kegiatan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KegiatanResource extends Resource
{
    protected static ?string $model = Kegiatan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Permohonan';
    protected static ?string $pluralModelLabel  = 'Kegiatan';

    public static function canViewAny(): bool
    {
        return auth()->user()->is_admin;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')->required(),
                Forms\Components\DatePicker::make('tanggal_awal_kegiatan')->required(),
                Forms\Components\DatePicker::make('tanggal_akhir_kegiatan')->required(),
                Forms\Components\Textinput::make('tempat')->required(),
                Forms\Components\FileUpload::make('dokumentasi_kegiatan')->directory('kegiatan')->storeFileNamesIn('dokumentasi_kegiatan')
                    ->maxSize(10240) // Limit file size to 10MB
                    ->acceptedFileTypes(['image/*']) // Allow images and PDFs,
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama')->sortable(),
                Tables\Columns\TextColumn::make('tanggal')->label('Tanggal'),
            ])
            ->filters([
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
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ManageKegiatans::route('/'),
        ];
    }
}
