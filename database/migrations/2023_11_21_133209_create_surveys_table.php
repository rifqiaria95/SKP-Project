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
        Schema::create('survey', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email');
            $table->string('experience_score');
            $table->string('description')->nullable();
            $table->string('suggestion')->nullable();
            $table->string('recommend')->nullable();
            $table->string('arrival')->nullable();
            $table->string('service')->nullable();
            $table->string('room')->nullable();
            $table->string('fb')->nullable();
            $table->string('facilities')->nullable();
            $table->string('cleanliness')->nullable();
            $table->string('atmosphere')->nullable();
            $table->string('checkout')->nullable();
            $table->string('wifi')->nullable();
            $table->string('value')->nullable();
            $table->string('room_number')->nullable();
            $table->string('type')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survey');
    }
};
