<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DataUnitPembangkitResource\Pages;
use App\Filament\Resources\DataUnitPembangkitResource\RelationManagers;
use App\Models\DataUnitPembangkit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DataUnitPembangkitResource extends Resource
{
    protected static ?string $model = DataUnitPembangkit::class;

    protected static ?string $navigationIcon = 'heroicon-o-bolt';
    protected static ?string $navigationGroup = 'Instansi';
    protected static ?string $pluralModelLabel  = 'Unit Pembangkit';
    protected static ?int $navigationSort = 4;

    public static function canViewAny(): bool
    {
        return auth()->user()->is_admin;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nomor_urut')->numeric()->label('Nomor Urut'),
                Forms\Components\TextInput::make('mesin')->label('Mesin'),
                Forms\Components\TextInput::make('tipe')->label('Tipe'),
                Forms\Components\TextInput::make('nomor_seri')->label('Nomor Seri'),
                Forms\Components\TextInput::make('daya_terpasang')->numeric()->label('Daya Terpasang'),
                Forms\Components\TextInput::make('daya_mampu')->numeric()->label('Daya Mampu'),
                Forms\Components\TextInput::make('lokasi_unit')->label('Lokasi Unit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nomor_urut')->label('Nomor Urut')->sortable(),
                Tables\Columns\TextColumn::make('mesin')->label('Mesin')->sortable(),
                Tables\Columns\TextColumn::make('tipe')->label('Tipe')->sortable(),
                Tables\Columns\TextColumn::make('daya_terpasang')->label('Daya Terpasang')->sortable(),
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
            'index' => Pages\ManageDataUnitPembangkits::route('/'),
        ];
    }
}
