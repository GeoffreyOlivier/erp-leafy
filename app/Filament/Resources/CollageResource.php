<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollageResource\Pages;
use App\Filament\Resources\CollageResource\RelationManagers;
use App\Models\Collage;
use App\Models\Color;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CollageResource extends Resource
{
    protected static ?string $model = Collage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $pluralModelLabel = 'Tableaux';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Tableau')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->label('Nom du tableau'),
                                Forms\Components\TextInput::make('ref')
                                    ->required()
                                    ->label('Référence du tableau'),
                                Forms\Components\TextInput::make('width')
                                    ->required()
                                    ->default(20)
                                    ->label('largeur'),
                                Forms\Components\TextInput::make('height')
                                    ->required()
                                    ->default(20)
                                    ->label('hauteur'),
                                Forms\Components\TextInput::make('stock')
                                    ->default(3)
                                    ->label('stock'),
                            ]),
                    ]),
                Forms\Components\Repeater::make('layers')
                    ->relationship()
                    ->label('Couches')
                    ->addActionLabel('Ajouter une couche')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('order')
                                    ->numeric()
                                    ->required()
                                    ->label('Ordre')
                                    ->live()
                                    ->afterStateHydrated(fn($set, $get) => $set('order', count($get('../../layers') ?? []))
                                    ),
                            ]),
                        Forms\Components\Select::make('color_id')
                            ->label('Couleur')
                            ->placeholder('Sélectionne une couleur')
                            ->searchable() // Active le champ de recherche intégré
                            ->options(fn() => Color::all()->pluck('code', 'id'))
                            ->live() // Met à jour dynamiquement d'autres champs si besoin
                            ->afterStateUpdated(function ($set, $state) {
                                $color = Color::find($state)?->code;
                                $set('color_preview', $color ?: null);
                            }),

                        Forms\Components\Placeholder::make('Couleur sélectionnée')
                            ->hidden(fn($get) => empty($get('color_preview')))
                            ->content(function ($get) {
                                if ($colorId = $get('color_id')) {
                                    $color = \App\Models\Color::find($colorId);
                                    if ($color) {
                                        return view('filament.components.color-preview', [
                                            'color' => $color->color,
                                        ]);
                                    }
                                }
                                return null;
                            }),
                    ]),
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCollages::route('/'),
            'create' => Pages\CreateCollage::route('/create'),
            'view' => Pages\ViewCollage::route('/{record}'),
            'edit' => Pages\EditCollage::route('/{record}/edit'),
        ];
    }
}
