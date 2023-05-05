<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('gender');
            $table->integer('age');
            $table->decimal('weight');
            $table->decimal('stature');
            $table->decimal('activity_rate_factor');
            $table->string('objective');
            $table->string('type_of_diet');
            $table->decimal('imc');
            $table->integer('water');
            $table->integer('basal_metabolic_rate');
            $table->integer('daily_calories');
            $table->decimal('daily_protein');
            $table->decimal('daily_carbohydrate');
            $table->decimal('daily_fat');
            $table->decimal('daily_protein_kcal');
            $table->decimal('daily_carbohydrate_kcal');
            $table->decimal('daily_fat_kcal');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
