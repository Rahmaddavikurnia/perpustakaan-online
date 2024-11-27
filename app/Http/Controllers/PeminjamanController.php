<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // Fungsi untuk mengajukan permintaan peminjaman buku
    public function peminjaman(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        $buku->decrement('stok');

        Peminjaman::create([
            'user_id' => Auth::id(),
            'buku_id' => $id,
            'status' => 'menunggu',
        ]);

        return redirect()->back()->with('success', 'Permintaan peminjaman berhasil dikirim.');
    }

    public function formpinjaman()
    {
        $bukus = Buku::all();
        $users = User::all();
        return view('admin.peminjaman.formpinjaman', compact('bukus', 'users'));
    }

    public function manualpeminjaman(Request $request)
    {

        // if (auth()->user()->role != 'user') {
        //     return back()->with('error', 'Hanya siswa yang dapat melakukan peminjaman.');
        // }

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'buku_id' => 'required|exists:bukus,id',
            'tanggal_pinjam' => 'date|after_or_equal:today',
            'tanggal_kembali' => 'date|after_or_equal:tanggal_pinjam|before_or_equal:tanggal_kembali',
        ],[
            'tanggal_pinjam.after_or_equal' => 'Tanggal pinjam harus lebih besar dari tanggal sekarang.',
            'tanggal_kembali.after_or_equal' => 'Tanggal kembali harus lebih besar dari tanggal pinjam.',
            'tanggal_kembali.before_or_equal' => 'Tanggal kembali harus lebih kecil dari tanggal kembali.',

        ]);

        $existingPinjam = Peminjaman::where('user_id', $request->user_id)
                            ->where('buku_id', $request->buku_id)
                            ->where('status', 'dipinjam')
                            ->exists();

        if ($existingPinjam) {
            return back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        $bukus = Buku::findOrFail($request->buku_id);
         if($bukus->stok <= 0){
             return back()->with('error', 'Stok buku tidak mencukupi.');
         }

         $bukus->decrement('stok');

        Peminjaman::create([
            'user_id' => $request->user_id,
            'buku_id' => $request->buku_id,
            'status' => 'dipinjam',
            'tanggal_pinjam' => $request-> tanggal_pinjam,
            'tanggal_kembali' => $request-> tanggal_kembali,
        ]);

        return redirect()->route('allpeminjaman');
    }

    public function permintaan()
    {
        $permintaans = Peminjaman::with('buku', 'user')
            ->where('status', 'menunggu')
            ->get();

        return view('admin.peminjaman.permintaan', compact('permintaans'));
    }

    public function terima($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

            $peminjaman->update([
                'status' => 'dipinjam',
                'tanggal_pinjam' => now(),
                'tanggal_kembali' => now()->addDays(7),
            ]);

            return redirect()->back()->with('success', 'Peminjaman berhasil diterima.');
    }

    // Fungsi untuk menolak permintaan peminjaman
    public function tolak($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update([
            'status' => 'ditolak',
        ]);

        return redirect()->back()->with('success', 'Permintaan peminjaman ditolak.');
    }

    public function allpeminjaman()
    {
        $peminjamans = Peminjaman::with('buku', 'user')
            ->get();

        return view('admin.peminjaman.allpeminjaman', compact('peminjamans'));
    }
}
