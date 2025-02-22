<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Collage extends Model
{
    use HasFactory;

    protected $table = 'collage';

    // Ajoutez ici les colonnes qui peuvent être remplies automatiquement
    protected $fillable = ['ref', 'name', 'width', 'height', 'stock'];

    /**
     * Relation avec les couches (Layer).
     * Un tableau (Collage) peut avoir plusieurs couches (relation 1:N).
     */
    public function layers()
    {
        return $this->hasMany(Layer::class);
    }

    /**
     * Relation avec les couleurs via les couches.
     * Cette méthode permet de récupérer les couleurs (Color) associées au tableau via les couches.
     */
    public function colors()
    {
        return $this->hasManyThrough(Color::class, Layer::class, 'collage_id', 'id', 'id', 'color_id');
    }
}
