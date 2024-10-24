<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UnitResource\Pages;
use App\Filament\Resources\UnitResource\RelationManagers;
use App\Models\DataUnitPembangkit;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class UnitResource extends Resource
{
    protected static ?string $model = Unit::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';
    protected static ?string $navigationGroup = 'Instansi';
    protected static ?string $pluralModelLabel  = 'Unit';
    protected static ?int $navigationSort = 1;

    public static function canViewAny(): bool
    {
        return auth()->user()->is_admin;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('jenis')->options([
                    'upltg' => 'UPLTG',
                    'upltd' => 'UPLTD',
                    'updk' => 'UPDK',
                ])->required(),
                Forms\Components\TextInput::make('nama')->required(),
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')->label('Nama')->state(function (Model $record): string {
                    return Str::upper($record->jenis) . " " . $record->nama;
                })->sortable(),
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->closeModalByClickingAway(false),
                Tables\Actions\DeleteAction::make()->closeModalByClickingAway(false),
                Tables\Actions\Action::make('buatUnitPembangkit')->label('Unit Pembangkit')->slideOver()->icon('heroicon-o-bolt')
                    ->fillForm(function (Unit $record) {
                        $data = [];
                        if ($record->unit_pembangkit) {
                            $data['nomor_urut'] = $record->unit_pembangkit->nomor_urut;
                            $data['mesin'] = $record->unit_pembangkit->mesin;
                            $data['tipe'] = $record->unit_pembangkit->tipe;
                            $data['nomor_seri'] = $record->unit_pembangkit->nomor_seri;
                            $data['daya_terpasang'] = $record->unit_pembangkit->daya_terpasang;
                            $data['daya_mampu'] = $record->unit_pembangkit->daya_mampu;
                            $data['lokasi_unit'] = $record->unit_pembangkit->lokasi_unit;
                        }
                        return $data;
                    })
                    ->form([
                        Forms\Components\TextInput::make('nomor_urut')->numeric()->label('Nomor Urut'),
                        Forms\Components\TextInput::make('mesin')->label('Mesin'),
                        Forms\Components\TextInput::make('tipe')->label('Tipe'),
                        Forms\Components\TextInput::make('nomor_seri')->label('Nomor Seri'),
                        Forms\Components\TextInput::make('daya_terpasang')->numeric()->label('Daya Terpasang'),
                        Forms\Components\TextInput::make('daya_mampu')->numeric()->label('Daya Mampu'),
                        Forms\Components\TextInput::make('lokasi_unit')->label('Lokasi Unit'),
                    ])
                    ->action(function (array $data, Unit $record) {
                        $data['id_unit'] = $record['id'];
                        DataUnitPembangkit::updateOrCreate(['id_unit' => $record->id], $data);
                        Notification::make()
                            ->title('Berhasil menyimpan unit')
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
            'index' => Pages\ManageUnits::route('/'),
        ];
    }
}
