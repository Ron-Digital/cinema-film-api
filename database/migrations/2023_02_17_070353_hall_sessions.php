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
        Schema::create('hall_sessions', function (Blueprint $table) {
            $table->id();
            $table->timestamp('show_time');
            $table->foreignId('center_hall_id')->references('id')->on('center_halls')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('movie_id')->references('id')->on('movies')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hall_sessions');
    }
};
