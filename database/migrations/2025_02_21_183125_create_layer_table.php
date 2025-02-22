<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayerTable extends Migration
{
        public function up()
    {
        Schema::create('layer', function (Blueprint $table) {
            $table->id(); // Identifiant unique de la couche
            $table->unsignedBigInteger('collage_id');
            $table->unsignedBigInteger('color_id'); // Référence à la couleur
            $table->integer('order');// Ordre de la couche dans le tableau
            $table->timestamps(); // Colonnes created_at et updated_at pour le suivi des changements

            // Définir les clés étrangères
            $table->foreign('collage_id')
                ->references('id')
                ->on('collage')
                ->onDelete('cascade'); // Si le collage est supprimé, supprimer aussi ses couches

            $table->foreign('color_id')
                ->references('id')
                ->on('color')
                ->onDelete('cascade'); // Si la couleur est supprimée, supprimer les couches associées
        });
    }

    public function down()
    {
        Schema::dropIfExists('layer');
    }
}

