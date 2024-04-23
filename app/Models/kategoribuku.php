<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoribuku extends Model
{
    use HasFactory;
    protected $table = 'kategoribukus';
    protected $fillable  = ['nama_kategori'];

    public function buku()
    {
        return $this->belongsToMany(buku::class, 'kategoribuku_relasis', 'id_buku','id_kategori');
    }
}
