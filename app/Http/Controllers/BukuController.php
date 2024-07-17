<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = BukuModel::all();
        // dd($buku);
        return view('admin.books.index', compact('buku'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'judul_buku' => 'required',
            'tanggal_terbit' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
        ]);

        if($request->hasFile('foto')){
            $fotoPath = $request->file('foto')->store('public/assets/img/buku');
            $namaFoto = basename($fotoPath);
        }else{
            $namaFoto = null;
        }
        // dd('berhasil');

        BukuModel::create([
            'judul_buku' => $request->judul_buku,
            'tanggal_terbit' => $request->tanggal_terbit,
            'pengarang' => $request->pengarang,
            'penerbit' => $request->penerbit,
            'foto' => $namaFoto,
        ]);
        return redirect()->route('buku');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_buku' => 'required',
            'tanggal_terbit' => 'required',
            'pengarang' => 'required',
            'penerbit' => 'required',
        ]);

        $buku = BukuModel::find($id);

        if (!$buku) {
            return response()->json(['message' => 'Buku not found.'], 404);
        }
        $buku->judul_buku = $request->judul_buku;
        $buku->tanggal_terbit = $request->tanggal_terbit;
        $buku->pengarang = $request->pengarang;
        $buku->penerbit = $request->penerbit;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/assets/img/buku');
            $namaFoto = basename($fotoPath);
            $buku->foto = $namaFoto;
        }

        $buku->save();

        return redirect()->route('buku')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = BukuModel::find($id);
        if (!$buku) {
            return response()->json(['message' => 'Buku not found.'], 404);
        }
        $buku->delete();

        return redirect()->route('buku')->with('success', 'Buku berhasil dihapus.');
    }
}
