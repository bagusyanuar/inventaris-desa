<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';

    protected $fillable = [
        'no_peminjaman',
        'tanggal_pinjam',
        'tanggal_kembali',
        'nama',
        'keterangan',
        'status',
    ];
}
