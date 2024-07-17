<?php

namespace App\Http\Controllers;

use App\Models\MahasiswaModel;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index(){
        $mahasiswa = MahasiswaModel::all(); 
        // dd($mahasiswa);
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }
    public function destroy($id)
    {
        $mahasiswa = MahasiswaModel::find($id);
        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found.'], 404);
        }
        $mahasiswa->delete();

        return redirect()->route('mahasiswa')->with('success', 'Mahasiswa berhasil dihapus.');
    }
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'nim' => 'required',
            'nama' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jurusan' => 'required'
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/assets/img/mahasiswa');
            $namaFoto = basename($fotoPath);
        }

        MahasiswaModel::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jurusan' => $request->jurusan,
            'foto' => $namaFoto,
        ]);

        return redirect()->route('mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }
    public function update(Request $request, $id)
{
    $request->validate([
        'nim' => 'required',
        'nama' => 'required',
        'tempat_lahir' => 'required',
        'tanggal_lahir' => 'required',
        'jurusan' => 'required'
    ]);
    $namaFoto = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/assets/img/mahasiswa');
            $namaFoto = basename($fotoPath);
        }

    $mahasiswa = MahasiswaModel::findOrFail($id);

    $mahasiswa->nim = $request->nim;
    $mahasiswa->nama = $request->nama;
    $mahasiswa->tempat_lahir = $request->tempat_lahir;
    $mahasiswa->tanggal_lahir = $request->tanggal_lahir;
    $mahasiswa->foto = $namaFoto;
    $mahasiswa->jurusan = $request->jurusan;

    

    $mahasiswa->save();

    return redirect()->route('mahasiswa')->with('success', 'Mahasiswa berhasil diperbarui.');
}

}
