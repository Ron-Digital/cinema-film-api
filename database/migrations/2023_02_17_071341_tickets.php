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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('movie_id')->references('id')->on('movies')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('movie_center_id')->references('id')->on('movie_centers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('center_hall_id')->references('id')->on('center_halls')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('hall_seat_id')->references('id')->on('hall_seats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('hall_session_id')->references('id')->on('hall_sessions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('payment_id')->references('id')->on('payments')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
