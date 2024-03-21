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
        Schema::create('karyawan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_depan')->length(30);
            $table->string('nama_belakang')->nullable();
            $table->string('tempat_lahir')->length(30);
            $table->string('tanggal_lahir')->length(30);
            $table->string('jenis_kelamin')->length(20);
            $table->string('status')->length(20);
            $table->string('job_title')->length(20);
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('perusahaan_id');
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan');
    }
};
