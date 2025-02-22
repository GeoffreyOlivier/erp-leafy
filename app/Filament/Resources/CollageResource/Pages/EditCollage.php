<?php

namespace App\Filament\Resources\CollageResource\Pages;

use App\Filament\Resources\CollageResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;

class EditCollage extends EditRecord
{
    protected static string $resource = CollageResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Les layers seront automatiquement chargés grâce à la relation
        Log::info('Loading data for edit', $data);

        // Si vous voulez voir les layers chargés
        Log::info('Layers', $this->record->layers->toArray());

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        Log::info('Saving edited data', $data);
        return $data;
    }

    // Si vous voulez faire quelque chose après la sauvegarde
    protected function afterSave(): void
    {
        Log::info('After save', ['collage' => $this->record->toArray()]);
    }
}
