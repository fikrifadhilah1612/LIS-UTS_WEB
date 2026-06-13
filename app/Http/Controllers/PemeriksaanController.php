<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Pasien;
use Illuminate\Http\Request;

class PemeriksaanController extends Controller
{
    public function index()
    {
        // Mengambil data pemeriksaan beserta relasi pasiennya
        $pemeriksaans = Pemeriksaan::with('pasien')->get();
        // Mengambil seluruh pasien untuk opsi dropdown di modal tambah/edit
        $pasiens = Pasien::all();

        return view('pemeriksaan.index', compact('pemeriksaans', 'pasiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'nama_tes' => 'required',
            'hasil' => 'required',
            'tanggal' => 'required|date'
        ]);

        Pemeriksaan::create($request->all());
        return redirect()->route('pemeriksaan.index')->with('success', 'Data Pemeriksaan berhasil ditambahkan!');
    }

    public function update(Request $request, Pemeriksaan $pemeriksaan)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'nama_tes' => 'required',
            'hasil' => 'required',
            'tanggal' => 'required|date'
        ]);

        $pemeriksaan->update($request->all());
        return redirect()->route('pemeriksaan.index')->with('success', 'Data Pemeriksaan berhasil diperbarui!');
    }

    public function destroy(Pemeriksaan $pemeriksaan)
    {
        $pemeriksaan->delete();
        return redirect()->route('pemeriksaan.index')->with('success', 'Data Pemeriksaan berhasil dihapus!');
    }
}