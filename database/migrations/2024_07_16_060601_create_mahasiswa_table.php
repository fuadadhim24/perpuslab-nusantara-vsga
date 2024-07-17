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
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nim');
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('jurusan');
            $table->string('foto');
            $table->timestamps();
        });
        DB::table('mahasiswa')->insert([
            'nim' => 'E41222139',
            'nama' => 'Fuad Adhim Al Hasan',
            'tempat_lahir' => 'Bojonegoro',
            'tanggal_lahir' => '2004-04-05',
            'foto' => '',
            'jurusan' => 'Teknik Informatika'
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
