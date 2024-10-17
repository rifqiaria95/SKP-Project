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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('nama_asset')->length(100);
            $table->string('image')->nullable();
            $table->string('tag');
            $table->string('serial')->nullable();
            $table->integer('status');
            $table->string('category')->length(100);
            $table->decimal('purchase_cost', 20, 0);
            $table->string('location')->length(100);
            $table->unsignedBigInteger('karyawan_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
