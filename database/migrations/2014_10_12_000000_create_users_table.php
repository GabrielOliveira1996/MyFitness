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
            $table->string('nickname')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('google_id')->nullable();
            $table->string('password');
            $table->boolean('confirm_terms');
            $table->string('profile_image')->nullable();
            $table->string('bio')->nullable();
            $table->integer('gender');
            $table->integer('age');
            $table->integer('weight');
            $table->integer('stature');
            $table->decimal('activity_rate_factor');
            $table->integer('objective');
            $table->integer('type_of_diet');
            $table->decimal('imc');
            $table->integer('water');
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
