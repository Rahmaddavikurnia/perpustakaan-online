<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategoribuku;
use App\Models\Koleksipribadi;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        $bukus = Buku::latest()->take(6)->get();
        return view('frontend.home',compact('bukus'));
    }

    public function list_buku()
    {
        $kategoris = Kategoribuku::with('buku')->get();
        return view('frontend.list-buku',compact('kategoris'));
    }

    public function detail_buku($id)
    {
        $bukus = Buku::with('kategoribuku','peminjamans','ulasan')->find($id);
        return view('frontend.detail',compact('bukus'));
    }

    public function listpeminjaman()
    {
        $peminjamans = Peminjaman::with('buku', 'user')
            ->where('user_id', Auth::id())
            ->get();

        return view('admin.peminjaman.listpeminjaman', compact('peminjamans'));
    }

    public function ulasan(Request $request, $buku_id)
    {
        $validatedData = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'ulasan' => 'required|string|max:500',
        ]);

        Ulasan::create([
            'user_id' => auth()->id(),
            'buku_id' => $buku_id,
            'ulasan' => $validatedData['ulasan'],
            'rating' => $validatedData['rating'],
        ]);

        return back()->with('success', 'Review berhasil ditambahkan.');

        return redirect()->back()->with('success', 'Ulasan Berhasil Ditambahkan');
    }

    public function tambahkoleksi(Request $request, $buku_id)
    {
        $user_id = Auth::id();

        $exkoleksi = Koleksipribadi::where('buku_id', $buku_id)->where('user_id', $user_id)->first();

        if ($exkoleksi) {
            return back()->with('error', 'Buku sudah ada dalam koleksi pribadi Anda.');
        }

        Koleksipribadi::create([
            'user_id' => $user_id,
            'buku_id' => $buku_id,
        ]);

        return back()->with('success', 'Buku ditambahkan ke koleksi pribadi Anda.');
    }

    public function koleksisaya()
    {
        $koleksi = Koleksipribadi::with('buku')->where('user_id', Auth::id())->get();

        return view('frontend.koleksi', compact('koleksi'));   
    }

    public function hapuskoleksi(Koleksipribadi $koleksipribadis)
    {
        if(Auth::id() !== $koleksipribadis->user_id){
            return back()->with('error', 'Anda tidak memiliki izin untuk menghapus koleksi ini.');
        }

        $koleksipribadis->delete();

        return back()->with('success', 'Koleksi berhasil dihapus.');
    }

}
