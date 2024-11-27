<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function home_admin()
    {
        $jumlah_buku = Buku::count();
        $jumlah_peminjaman = Peminjaman::count();
        $jumlah_ulasan = Ulasan::count();
        $jumlah_user = User ::count();
        return view('admin.dashboard', compact('jumlah_buku', 'jumlah_peminjaman', 'jumlah_ulasan','jumlah_user'));
    }

    public function getStatistics()
    {
        $buku = Buku::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->groupBy('month')
        ->pluck('total', 'month');

        $peminjaman = Peminjaman::selectRaw('MONTH(tanggal_pinjam) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $pengembalian = Pengembalian::selectRaw('MONTH(tanggal_pengembalian) as month, COUNT(*) as total')
            ->groupBy('month')
            ->pluck('total', 'month');

        $data = [
            'buku' => array_values(array_replace(array_fill(1, 12, 0), $buku->toArray())),
            'peminjaman' => array_values(array_replace(array_fill(1, 12, 0), $peminjaman->toArray())),
            'pengembalian' => array_values(array_replace(array_fill(1, 12, 0), $pengembalian->toArray()))
        ];

        return response()->json($data);
    }
}
