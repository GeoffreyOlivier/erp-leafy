<?php

namespace App\Filament\Resources\ColorResource\Pages;

use App\Filament\Resources\ColorResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateColor extends CreateRecord
{
    protected static string $resource = ColorResource::class;

    public $color_preview; // Stockage de la couleur capturée


    public function getTitle(): string
    {
        return 'Création d\'une couleur';
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $this->color_preview = $data['color_preview'] ?? null;
        return $data;
    }
}
