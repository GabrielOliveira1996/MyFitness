<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_name');
            $table->string('name');
            $table->decimal('quantity_grams');
            $table->decimal('calories');
            $table->decimal('carbohydrate');
            $table->decimal('protein');
            $table->decimal('total_fat');
            $table->decimal('saturated_fat');
            $table->decimal('trans_fat');
            $table->string('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('goals');
    }
};
