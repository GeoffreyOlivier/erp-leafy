<?php

namespace App\Filament\Resources\CollageResource\Pages;

use App\Filament\Resources\CollageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateCollage extends CreateRecord
{
    protected static string $resource = CollageResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        Log::info("passs here");

        // Stocker les layers temporairement
        $layers = $data['layers'] ?? [];

        // Retirer les layers des données pour la création du collage
        unset($data['layers']);

        // On garde les données du collage dans une variable de classe pour les utiliser après
        $this->layers = $layers;

        return $data;
    }

    protected function afterCreate(): void
    {
        Log::info("afterCreate called");

        // Récupérer le collage qui vient d'être créé
        $collage = $this->record;

        // Créer les layers
        foreach ($this->layers as $layer) {
            $collage->layers()->create([
                'color_id' => $layer['color_id'],
                'order' => $layer['order']
            ]);
        }
    }



}
