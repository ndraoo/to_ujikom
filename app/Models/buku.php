<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class buku extends Model
{
    use HasFactory;
    protected $table = 'bukus';
    protected $fillable = [
        'judul',
        'foto',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'deskripsi',
    ];
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
    public function kategoribuku()
    {
        return $this->belongsToMany(kategoribuku::class, 'kategoribuku_relasis', 'id_buku', 'id_kategori');
        return $this->belongsToMany(kategoribuku::class)->detach();
    }
}
