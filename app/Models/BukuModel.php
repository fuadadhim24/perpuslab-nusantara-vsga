<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BukuModel extends Model
{
    use HasFactory;

    protected $table = 'buku';

    protected $fillable = [
        'judul_buku',
        'tanggal_terbit',
        'penerbit',
        'foto',
        'pengarang'
    ];
}
