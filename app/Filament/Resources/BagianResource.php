<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BagianResource\Pages;
use App\Filament\Resources\BagianResource\RelationManagers;
use App\Models\Bagian;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class BagianResource extends Resource
{
    protected static ?string $model = Bagian::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';
    protected static ?string $navigationGroup = 'Instansi';
    protected static ?string $pluralModelLabel  = 'Bagian';
    protected static ?int $navigationSort = 2;

    public static function canViewAny(): bool
    {
        return auth()->user()->is_admin;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\Select::make('jenis')->options([
                    'bagian'=>'Bagian',
                    'seksi'=>'Seksi',
                ])->default('bagian'),
                Forms\Components\TextInput::make('nama')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama')->state(function (Model $record): string {
                    return Str::ucfirst($record->jenis) . " " .$record->nama;
                })->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->closeModalByClickingAway(false),
                Tables\Actions\DeleteAction::make()->closeModalByClickingAway(false),
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
            'index' => Pages\ManageBagians::route('/'),
        ];
    }
}
