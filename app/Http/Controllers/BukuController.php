<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategoribuku;
use App\Models\Peminjaman;
use App\Models\Ulasan;
use App\Models\User;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::with('kategoribuku')->get();
        return view('admin.buku.index', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoribuku = Kategoribuku::all();
        return view('admin.buku.create', compact('kategoribuku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required|date',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg,jfif|max:2048',
        ]);

        $file = $request->file('gambar');
        $name = $file->getClientOriginalName();
        $path = 'storage/images/buku';
        $file->move($path, $name);
        $gambar = $name;

        $buku = Buku::create([
            'judul' => $request -> judul,
            'penulis' => $request -> penulis,
            'penerbit' => $request -> penerbit,
            'tahun_terbit' => $request -> tahun_terbit,
            'kategori_id' => $request -> kategori_id,
            'gambar' => $gambar,
            'deskripsi' => $request -> deskripsi,
            'stok' => $request -> stok,
        ]);

        if ($buku) {
            return redirect()->route('buku.index')->with('success', 'Buku Berhasil Ditambahkan');
        } else {
            return redirect()->route('buku.create')->with('error', 'Buku Gagal Ditambahkan');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku = Buku::find($id);
        $kategoribuku = Kategoribuku::all();
        return view('admin.buku.edit', compact('buku','kategoribuku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun_terbit' => 'required',
        ]);

        $update = Buku::findOrFail($id);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $name = $file->getClientOriginalName();
            $path = 'storage/images/buku';
            $file->move($path, $name);
            $gambar = $name;
            $update->gambar = $gambar;
        }

        $update->judul = $request->judul;
        $update->penulis = $request->penulis;
        $update->penerbit = $request->penerbit;
        $update->tahun_terbit = $request->tahun_terbit;
        $update->kategori_id = $request->kategori_id;
        $update->deskripsi = $request->deskripsi;
        $update->stok = $request->stok;
        $update->save();  

        if ($update) {
            return redirect()->route('buku.index')->with('success', 'Buku Berhasil Diubah');
        } else {
            return redirect()->route('buku.edit')->with('error', 'Buku Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $bukus)
    {
        $gambarPath = public_path('storage/images/buku/' . $bukus->gambar);
        unlink($gambarPath);
        $bukus->delete();

        return redirect()->route('buku.index')->with('success', 'Buku Berhasil Dihapus');
    }

    
}
