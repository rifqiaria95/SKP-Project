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
        Schema::create('purchase_order', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_po')->length(100);
            $table->string('nama_po')->length(100);
            $table->string('tanggal')->length(100);
            $table->string('harga')->length(100);
            $table->string('total_harga')->length(100);
            $table->string('ppn')->length(100);
            $table->string('grand_total')->length(100);
            $table->string('quantity')->length(100);
            $table->integer('status');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vendor_id');
            $table->unsignedBigInteger('perusahaan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order');
    }
};
