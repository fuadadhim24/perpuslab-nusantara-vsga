<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use App\Models\MahasiswaModel;
use App\Models\PeminjamanModel;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    public function index(){
        $pengembalian = PeminjamanModel::all();
        $mahasiswas = MahasiswaModel::all();
        $bukus = BukuModel::all();
        // dd($pengembalian);
        return view('admin.pengembalian.index', compact('pengembalian', 'mahasiswas', 'bukus'));
    }
    public function destroy($id)
    {
        $peminjaman = PeminjamanModel::find($id);

        if (!$peminjaman) {
            return redirect()->route('pengembalian')->with('error', 'Peminjaman not found.');
        }

        $peminjaman->delete();

        return redirect()->route('pengembalian')->with('success', 'Peminjaman berhasil dihapus.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'buku_id' => 'required|exists:buku,id',
        ]);

        PeminjamanModel::create([
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => null,
            'id_mahasiswa' => $request->mahasiswa_id,
            'id_buku' => $request->buku_id,
        ]);

        return redirect()->route('pengembalian')->with('success', 'Peminjaman berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'tanggal_kembali' => 'required|date',
        ]);

        $peminjaman = PeminjamanModel::findOrFail($id);

        
        $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        $peminjaman->save();

        return redirect()->route('pengembalian')->with('success', 'Peminjaman berhasil diperbarui.');
    }
}
