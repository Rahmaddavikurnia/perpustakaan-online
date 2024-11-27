<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $fillable = [
        'peminjaman_id',
        'tanggal_pengembalian',
        'denda',
        'status',
    ];

    public function prosesPengembalian()
    {
        $this->peminjaman->ubahStatusKeDikembalikan();

      
        $this->update([
            'status' => 'Menunggu Persetujuan',
        ]);
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function hitungdenda()
    {
        $tanggal_tempo = $this->peminjaman->tanggal_tempo();
        $tanggal_pengembalian = Carbon::parse($this->tanggal_pengembalian);
        
        if($tanggal_pengembalian->gt($tanggal_tempo)){
            $selisih_hari = $tanggal_pengembalian->diffInDays($tanggal_tempo);
            return $selisih_hari * 1000;
        }

        return 0;
    }
}
