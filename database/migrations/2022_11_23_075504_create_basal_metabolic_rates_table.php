<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('basal_metabolic_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('user_name');
            $table->string('gender');
            $table->integer('age');
            $table->integer('weight');
            $table->integer('stature');
            $table->decimal('activity_rate_factor');
            $table->integer('basal_metabolic_rate');
            $table->decimal('daily_protein');
            $table->decimal('daily_carbohydrate');
            $table->decimal('daily_fat');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('basal_metabolic_rates');
    }
};