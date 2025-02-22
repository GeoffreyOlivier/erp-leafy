<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Layer extends Model
{
    use HasFactory;

    protected $table = 'layer';

    // Ajoutez ici les colonnes qui peuvent être remplies automatiquement
    protected $fillable = ['collage_id', 'color_id', 'order'];

    /**
     * Relation avec le tableau (Collage).
     * Une couche appartient à un seul tableau (relation N:1).
     */
    public function collage()
    {
        return $this->belongsTo(Collage::class);
    }

    /**
     * Relation avec la couleur (Color).
     * Une couche a une couleur spécifique (relation N:1).
     */
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
}
