<?php

namespace App\Http\Controllers;

use App\Models\Kategoribuku;
use Illuminate\Http\Request;

class KategoribukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoribuku = Kategoribuku::all();
        return view('admin.kategori.index', compact('kategoribuku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $kategori = Kategoribuku::create([
            'nama_kategori' => $request->nama_kategori,
        ]);
        if ($kategori) {
            return redirect()->route('kategoribuku.index')->with('success', 'Kategori Berhasil Ditambahkan');
        } else {
            return redirect()->route('kategoribuku.create')->with('error', 'Kategori Gagal Ditambahkan');
        }
      
    }

    /**
     * Display the specified resource.
     */
    public function show(Kategoribuku $kategoribuku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategoribuku = Kategoribuku::find($id);
        return view('admin.kategori.edit', compact('kategoribuku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required',
        ]);

        $update = Kategoribuku::findOrFail($id);
        $update-> nama_kategori = $request->nama_kategori;
        $update->save();

        if ($update) {
            return redirect()->route('kategoribuku.index')->with('success', 'Kategori Berhasil Diubah');
        } else {
            return redirect()->route('kategoribuku.edit')->with('error', 'Kategori Gagal Diubah');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kategoribuku $kategoribukus)
    {
        $kategoribukus->delete(); 

        return redirect()->route('kategoribuku.index')->with('success', 'Kategori Berhasil Dihapus');
    }
}
