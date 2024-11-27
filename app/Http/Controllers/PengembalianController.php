<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
   public function create($peminjaman_id)
   {
        $peminjamans = Peminjaman::with('buku')->findOrFail($peminjaman_id);
        return view('admin.pengembalian.create', compact('peminjamans'));
   }

   public function store(Request $request, $peminjaman_id)
   {
        $peminjaman = Peminjaman::findOrFail($peminjaman_id);

        $tanggal_pengembalian = now()->toDateString();

        $denda = $this->hitungdenda($peminjaman, $tanggal_pengembalian);

        if ($peminjaman->pengembalian) {
            return response()->json(['message' => 'Buku sudah dikembalikan.'], 400);
        }

        $buku = Buku::findOrFail($peminjaman->buku_id);

        $buku->increment('stok');
        

        $pengembalian = Pengembalian::create([
            'peminjaman_id' => $peminjaman_id,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'denda' => $denda,
            'status' => 'Menunggu Persetujuan',
        ]);

        $pengembalian->prosesPengembalian();

        return redirect()->back()->with('success','Pengembalian buku berhasil');
   }

   public function hitungdenda(Peminjaman $peminjaman, $tanggal_pengembalian)
   {
        $tanggal_pengembalian = Carbon::parse($tanggal_pengembalian);
        $tanggal_tempo = $peminjaman->tanggal_tempo();

        if($tanggal_pengembalian->gt($tanggal_tempo)){
            $selisih_hari = $tanggal_pengembalian->diffInDays($tanggal_tempo);
            return $selisih_hari * 1000;
        }

        return 0;
   }

   public function approve($id)
   {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->update([
            'status' => 'Dikembalikan',
        ]);

        return redirect()->route('pengembalian.index')->with('success','Buku berhasil di kembalikan');
   }

   public function pengembalian()
   {
        $pengembalian = Pengembalian::where('status','Menunggu Persetujuan')->get();
        return view('admin.pengembalian.index',compact('pengembalian'));
   }

   public function allpengembalian()
   {
     $pengembalian = Pengembalian::with('peminjaman')->get();
     return view('admin.pengembalian.datapengembalian',compact('pengembalian'));
   }
}
