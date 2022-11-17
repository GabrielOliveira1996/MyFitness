<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('calories');
            $table->integer('protein');
            $table->integer('carbohydrate');
            $table->integer('saturated_fat');
            $table->integer('monounsaturated_fat');
            $table->integer('polyunsaturated_fat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('food');
    }
};
