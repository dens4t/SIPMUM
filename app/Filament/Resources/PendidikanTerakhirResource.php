<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PendidikanTerakhirResource\Pages;
use App\Filament\Resources\PendidikanTerakhirResource\RelationManagers;
use App\Models\PendidikanTerakhir;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PendidikanTerakhirResource extends Resource
{
    protected static ?string $model = PendidikanTerakhir::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Lainnya';
    protected static ?string $pluralModelLabel  = 'Pendidikan Terakhir';
    protected static ?int $navigationSort = 0;

    public static function canViewAny(): bool
    {
        return auth()->user()->is_admin;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('urutan')->numeric()->required(),
                Forms\Components\TextInput::make('jenjang')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('urutan')->label('Urutan')->sortable(),
                Tables\Columns\TextColumn::make('jenjang')->label('Jenjang Pendidikan')->sortable()
            ])
            ->filters([
                //
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
            'index' => Pages\ManagePendidikanTerakhirs::route('/'),
        ];
    }
}
