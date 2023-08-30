<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('overall_quotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sport_id');
            $table->unsignedBigInteger('gender_id');
            $table->unsignedBigInteger('category_id');
            $table->integer('min_quota');
            $table->integer('max_quota');
            $table->integer('reserve_quota');
            $table->timestamps();

            $table->foreign('sport_id')->references('id')->on('sports');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overall_quotas');
    }
};
