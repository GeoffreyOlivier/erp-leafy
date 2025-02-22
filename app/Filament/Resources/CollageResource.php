<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollageResource\Pages;
use App\Filament\Resources\CollageResource\RelationManagers;
use App\Models\Collage;
use App\Models\Color;
use App\Models\Layer;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Log;

class CollageResource extends Resource
{
    protected static ?string $model = Collage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Tableaux';

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
                                    ->default("blabla")
                                    ->label('Nom du tableau'),
                                Forms\Components\TextInput::make('ref')
                                    ->required()
                                    ->default("blabla")
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
                Forms\Components\Section::make('Couches')
                    ->schema([
                        Forms\Components\Repeater::make('layers')
                            ->relationship()
                            ->label('Couches')
                            ->schema([
                                Forms\Components\Grid::make(2)
                                    ->schema([
                                        Forms\Components\TextInput::make('order')
                                            ->numeric()
                                            ->default(1)
                                            ->required()
                                            ->label('Ordre'),
                                    ]),
                                Forms\Components\Grid::make(1)
                                    ->schema([
                                        Forms\Components\Select::make('color_id')
                                            ->required()
                                            ->label('Couleur (BD)')
                                            ->options(function () {
                                                return Color::all()->pluck('name', 'id');
                                            }),
                                    ]),
                            ]),
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
            'view' => Pages\ViewCollage::route('/{record}'),
            'create' => Pages\CreateCollage::route('/create'),
            'edit' => Pages\EditCollage::route('/{record}/edit'),
        ];
    }



}
