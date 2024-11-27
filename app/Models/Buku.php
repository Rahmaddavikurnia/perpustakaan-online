<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'kategori_id',
        'gambar',
        'deskripsi',
        'stok'
    ];

    public function kategoribuku()
    {
        return $this->belongsTo(Kategoribuku::class, 'kategori_id');
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class, 'buku_id');
    }

    public function peminjamans()
    {
        return $this->hasOne(Peminjaman::class)->latest('created_at')->where('user_id', auth()->id());
    }

    public function koleksi()
    {
        return $this->hasMany(Koleksipribadi::class);
    }

    public function sudahDiKoleksi($user_id)
    {
        return $this->koleksi()->where('user_id', $user_id)->exists();
    }

}
