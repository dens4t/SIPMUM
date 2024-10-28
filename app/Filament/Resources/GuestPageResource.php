<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GuestPageResource\Pages;
use App\Filament\Resources\GuestPageResource\RelationManagers;
use App\Models\GuestPage;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentSortOrder\Actions\DownStepAction;
use IbrahimBougaoua\FilamentSortOrder\Actions\UpStepAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;


class GuestPageResource extends Resource
{
    protected static ?string $model = GuestPage::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?string $navigationGroup = 'Tamu';
    protected static ?string $pluralModelLabel  = 'Berita';
    protected static ?int $navigationSort = 0;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Fieldset::make('')
                    ->schema([
                        Forms\Components\Select::make('Menu')->label('Menu')->options([
                            'profil' => 'Profil',
                            'unit_pembangkit' => 'Unit',
                            'media' => 'Media',
                        ]),
                        Forms\Components\TextInput::make('order')->default(0)->numeric()->label('Urutan Post Pada Menu')->nullable(),
                        Forms\Components\TextInput::make('slug')
                            ->reactive()
                            ->required(),
                    ])
                    ->columns(3),
                Forms\Components\TextInput::make('title')->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    })->columnSpan('full'),

                Forms\Components\MarkdownEditor::make('content')->required()->columnSpan('full'),
                Forms\Components\FileUpload::make('thumbnail')
                    ->directory('berita')->storeFileNamesIn('thumbnail')
                    ->maxSize(10240) // Limit file size to 10MB
                    ->image()->openable()->previewable(false)->nullable()->columnSpan('full'),
                Forms\Components\Toggle::make('active')->columnSpan('full'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('menu')->default('-')->sortable(),
                Tables\Columns\TextColumn::make('title')->sortable(),
                Tables\Columns\ToggleColumn::make('active')->sortable()->disabled(),
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
            'index' => Pages\ManageGuestPages::route('/'),
        ];
    }
}
