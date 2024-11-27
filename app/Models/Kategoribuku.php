<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategoribuku extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
    ];

    public function buku()
    {
        return $this->hasMany(Buku::class,'kategori_id');
    }
}