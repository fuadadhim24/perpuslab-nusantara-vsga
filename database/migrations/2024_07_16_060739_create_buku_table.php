<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul_buku');
            $table->date('tanggal_terbit');
            $table->string('pengarang');
            $table->string('penerbit');
            $table->string('foto');
            $table->timestamps();
        });

        DB::table('buku')->insert([
            'judul_buku' => 'Harry Potter',
            'tanggal_terbit' => '2024-07-16',
            'pengarang' => 'Dani Sucipto',
            'penerbit' => 'Cendekia GenZ',
            'foto' => 'si kancil.jpg',
            'created_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};
