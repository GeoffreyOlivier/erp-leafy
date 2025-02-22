<?php
// Dans app/Filament/Resources/CollageResource/Pages/ViewCollage.php

namespace App\Filament\Resources\CollageResource\Pages;

use App\Filament\Resources\CollageResource;
use App\Models\Layer;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Grid;

class ViewCollage extends ViewRecord
{
    protected static string $resource = CollageResource::class;

    public function infolist(Infolist $infolist): Infolist
    {

        return $infolist
            ->schema([
                Section::make('Tableau')
                    ->schema([
                        TextEntry::make('name')
                            ->label('Nom du tableau'),
                        TextEntry::make('ref')
                            ->label('Référence du tableau'),
                        TextEntry::make('width')
                            ->label('Largeur'),
                        TextEntry::make('height')
                            ->label('Hauteur'),
                        TextEntry::make('stock')
                            ->label('Stock'),
                    ]),

                Section::make('Couches')
                    ->schema([
                        RepeatableEntry::make('layers')
                            ->label('Couches')
                            ->schema([
                                Grid::make(3)
                                    ->schema([
                                        TextEntry::make('order')
                                            ->label('Ordre'),
                                        TextEntry::make('color.name')
                                            ->label('Couleur')
                                            ->prefix(function (Layer $record) {
                                                return view('components.color-circle', [
                                                    'color' => $record->color->color
                                                ]);
                                            })
                                            ->extraAttributes([
                                                'style' => 'vertical-align: middle;'
                                            ]),
                                        TextEntry::make('color.code')
                                            ->label('Code'),
                                        TextEntry::make('color.supplier')
                                            ->label('Fournisseur'),
                                    ])
                            ])
                    ])








            ]);
    }
}
