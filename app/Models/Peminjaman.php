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
        'peminjam_id',
        'tanggal_pinjam',
        'tanggal_kembali',
        'nama',
        'keterangan',
        'status',
    ];

    public function detail()
    {
        return $this->hasMany(PeminjamanDetail::class, 'peminjaman_id');
    }

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'peminjam_id');
    }
}
