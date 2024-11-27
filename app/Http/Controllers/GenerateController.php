<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenerateController extends Controller
{
    public function pengembalianPdf()
    {
        $pengembalians = Pengembalian::all();
        $pengembaliancount = Pengembalian::count();
        $data = [
            'title' => 'Pengembalian report PDF',
            'date' => date('Y-m-d'),
            'pengembalians' => $pengembalians,
            'pengembaliancount' => $pengembaliancount,
        ];

        $date = date('Y-m-d');
        $pdf = PDF::loadView('frontend.pdf.pengembalian', $data);
        return $pdf->stream('pengembalian-report-' . $date . '.pdf');
    }

    public function peminjamanPdf()
    {
        $peminjamans = Peminjaman::all();
        $peminjamancount = Peminjaman::count();
        $data = [
            'title' => 'Peminjaman report PDF',
            'date' => date('Y-m-d'),
            'peminjamans' => $peminjamans,
            'author' => Auth::user()->name,
            'peminjamancount' => $peminjamancount,
        ];

        $date = date('Y-m-d');
        $pdf = PDF::loadView('frontend.pdf.peminjaman', $data);
        return $pdf->stream('peminjaman-repor' . $date .'t.pdf');
    }

    public function bukuPdf()
    {
        $bukus = Buku::all();
        $bukucount = Buku::count();
        $data = [
            'title' => 'Buku report PDF',
            'date' => date('Y-m-d'),
            'bukus' => $bukus,
            'author' => Auth::user()->name,
            'bukucount' => $bukucount,
        ];

        $date = date('Y-m-d');
        $pdf = PDF::loadView('frontend.pdf.buku', $data);
        return $pdf->stream('buku-report-' . $date . '.pdf');
    }
}
