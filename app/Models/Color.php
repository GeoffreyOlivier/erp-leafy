<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color extends Model
{
    use HasFactory;

    protected $table = 'color';

    protected $fillable = ['code', 'name', 'color', 'supplier','shop'];

    /**
     * Relation avec les couches (Layer).
     * Une couleur peut être utilisée dans plusieurs couches (relation 1:N).
     */
    public function layers()
    {
        return $this->hasMany(Layer::class);
    }

    /**
     * Relation avec les tableaux (Collage) via les couches.
     * Une couleur peut être associée à plusieurs tableaux en passant par les couches.
     */
    public function collages()
    {
        return $this->hasManyThrough(Collage::class, Layer::class, 'color_id', 'id', 'id', 'collage_id');
    }

}
