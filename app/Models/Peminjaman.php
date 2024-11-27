<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_pinjam', 'tanggal_kembali', 'status','user_id', 'buku_id',
    ];

    public function sudahDikembalikan()
    {
        return $this->status === 'Di Kembalikan';
    }

    public function ubahStatusKeDikembalikan()
    {
        $this->update([
            'status' => 'Di Kembalikan',
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    public function pengembalian()
    {
        return $this->hasOne(Pengembalian::class);
    }

    public function tanggal_tempo()
    {
        return Carbon::parse($this->tanggal_pinjam)->addDays(1);
    }
}
