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
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_kembali')->nullable();
            $table->date('tanggal_pinjam');
            $table->unsignedBigInteger('id_buku')->nullable();
            $table->foreign('id_buku')->references('id')->on('buku')->onDelete('cascade');
            $table->unsignedBigInteger('id_mahasiswa')->nullable();
            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
