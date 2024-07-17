<?php

namespace App\Http\Controllers;

use App\Models\BukuModel;
use App\Models\MahasiswaModel;
use App\Models\PeminjamanModel;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(){
        $peminjaman = PeminjamanModel::all();
        $mahasiswas = MahasiswaModel::all();
        $bukus = BukuModel::all();
        return view('admin.peminjaman.index', compact('peminjaman', 'mahasiswas', 'bukus'));
    }
    public function destroy($id)
    {
        $peminjaman = PeminjamanModel::find($id);

        if (!$peminjaman) {
            return redirect()->route('peminjaman')->with('error', 'Peminjaman not found.');
        }

        $peminjaman->delete();

        return redirect()->route('peminjaman')->with('success', 'Peminjaman berhasil dihapus.');
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'mahasiswa_id' => 'required|exists:mahasiswa,id',
            'buku_id' => 'required|exists:buku,id',
        ]);

        PeminjamanModel::create([
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'id_mahasiswa' => $request->mahasiswa_id,
            'id_buku' => $request->buku_id,
        ]);

        return redirect()->route('peminjaman')->with('success', 'Peminjaman berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
    {
        // dd($request);
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date',
            'id_mahasiswa' => 'required',
            'id_buku' => 'required',
        ]);

        $peminjaman = PeminjamanModel::findOrFail($id);

        $peminjaman->tanggal_pinjam = $request->tanggal_pinjam;
        $peminjaman->tanggal_kembali = $request->tanggal_kembali;
        $peminjaman->id_mahasiswa = $request->id_mahasiswa;
        $peminjaman->id_buku = $request->id_buku;
        $peminjaman->save();

        return redirect()->route('peminjaman')->with('success', 'Peminjaman berhasil diperbarui.');
    }

}
