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
            $table->string('description');
            $table->string('suggestion');
            $table->string('recommend');
            $table->string('arrival');
            $table->string('service');
            $table->string('room');
            $table->string('fb');
            $table->string('facilities');
            $table->string('cleanliness');
            $table->string('atmosphere');
            $table->string('checkout');
            $table->string('wifi');
            $table->string('value');
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
