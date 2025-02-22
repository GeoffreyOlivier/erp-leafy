<?php

namespace App\Filament\Resources\LayerResource\Pages;

use App\Filament\Resources\LayerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Collage;
use App\Models\Color;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
class EditLayer extends EditRecord
{
    protected static string $resource = LayerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Forms\Components\Section::make('Tableau')
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
                        ->label('stock'),
                ]),
            Forms\Components\Section::make('Couches')
                ->schema([
                    Forms\Components\Repeater::make('layers')
                        ->label('Couches')
                        ->schema([
                            Forms\Components\ColorPicker::make('color')
                                ->required()
                                ->label('Couleur'),
                            Forms\Components\TextInput::make('order')
                                ->numeric()
                                ->required()
                                ->label('Ordre'),
                        ]),
                ]),
        ];
    }
}
