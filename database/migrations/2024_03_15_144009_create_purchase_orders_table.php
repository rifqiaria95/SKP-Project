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
            $table->string('status');
            $table->string('ppn');
            $table->string('grand_total');
            $table->string('sub_total');
            $table->string('pic_1')->length(100);
            $table->string('pic_2')->length(100)->nullable();
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
