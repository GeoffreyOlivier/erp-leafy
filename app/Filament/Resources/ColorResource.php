<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ColorResource\Pages;
use App\Filament\Resources\ColorResource\RelationManagers;
use App\Models\Color;
use App\Models\Layer;
use Filament\Forms;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ColorResource extends Resource
{
    protected static ?string $model = Color::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';
    protected static ?string $pluralModelLabel = 'Couleurs';

    public $color = '#ff0000';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                    ->required()
                    ->label('Codes'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->label('Nom'),
                Forms\Components\Select::make('supplier')
                    ->label('Marque')
                    ->placeholder('Sélectionne une marque')
                    ->options([
                        'Canson' => 'Canson',
                        'Clairefontaine' => 'Clairefontaine',
                        'Florence' => 'Florence',
                        'Créalia' => 'Créalia',
                        'Amazon' => 'Amazon',
                        'Autre' => 'Autre',
                    ])
                    ->preload(),
                Forms\Components\Select::make('shop')
                    ->label('Magasin')
                    ->placeholder('Sélectionne un magasin')
                    ->options([
                        'Rougier & plé' => 'Rougier & plé',
                        'Vaessen créative' => 'Vaessen créative',
                        'Amazon' => 'Amazon',
                        'Site en ligne' => 'Site en ligne',
                        'Autre' => 'Autre',
                    ])
                    ->preload(),
                ViewField::make('color')
                    ->required()
                    ->label('Choisir une couleur')
                    ->view('filament.forms.components.color-picker')
                    ->reactive(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nom')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('code')
                    ->label('Code')
                    ->sortable()
                    ->searchable(),
                ViewColumn::make('color')
                    ->label('Couleur')
                    ->view('components.list-color-circle'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListColors::route('/'),
            'create' => Pages\CreateColor::route('/create'),
            'edit' => Pages\EditColor::route('/{record}/edit'),
        ];
    }

    public function updateColor($color)
    {
        $this->color_preview = $color;
        $this->color = $color;
    }




}
