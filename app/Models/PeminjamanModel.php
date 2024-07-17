<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanModel extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';

    protected $fillable = [
        'tanggal_kembali',
        'tanggal_pinjam',
        'id_buku',
        'id_mahasiswa',
    ];

    public function buku()
    {
        return $this->belongsTo(BukuModel::class, 'id_buku');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(MahasiswaModel::class, 'id_mahasiswa');
    }
}
