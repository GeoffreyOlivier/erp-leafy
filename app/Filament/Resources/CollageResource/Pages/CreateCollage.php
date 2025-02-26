<?php

namespace App\Filament\Resources\CollageResource\Pages;

use App\Filament\Resources\CollageResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateCollage extends CreateRecord
{
    protected static string $resource = CollageResource::class;

    public $color_preview; // Stocke la couleur sélectionnée

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $this->color_preview = $data['color_preview'] ?? null;
        return $data;
    }

    protected function getListeners(): array
    {
        return [
            'updateColor' => 'setColorPreview',
        ];
    }

    public function setColorPreview($color)
    {
        $this->color_preview = $color;
    }
    public function getTitle(): string
    {
        return 'Création d\'un tableau';
    }


    protected function mutateFormDataBeforeCreate(array $data): array
    {
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
