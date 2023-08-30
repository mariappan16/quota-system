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
        Schema::create('state_quotas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('overall_quota_id');
            $table->unsignedBigInteger('state_id');
            $table->integer('min_quota');
            $table->integer('max_quota');
            $table->integer('reserve_quota');
            $table->timestamps();

            $table->foreign('overall_quota_id')->references('id')->on('overall_quotas');
            $table->foreign('state_id')->references('id')->on('states');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('state_quotas');
    }
};
