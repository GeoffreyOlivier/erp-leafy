<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorTable extends Migration
{
    public function up()
    {
        Schema::create('color', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('name');
            $table->string('color');
            $table->string('supplier');
            $table->string('shop');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('color');
    }
}

