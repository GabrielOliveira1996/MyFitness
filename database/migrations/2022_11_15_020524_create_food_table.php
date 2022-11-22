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
            $table->decimal('quantity_grams');
            $table->decimal('calories');
            $table->decimal('carbohydrate');
            $table->decimal('protein');
            $table->decimal('total_fat');
            $table->decimal('saturated_fat');
            $table->decimal('trans_fat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('food');
    }
};
