<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peminjaman extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_buku',
        'tanggal_peminjaman',
        'tanggal_pengembalian',
        'status_peminjaman',
    ];
    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
    public function user()
    {
        return $this->belongsTo(user::class, 'id_user');
    }


}
