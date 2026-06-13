<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::all();
        return view('pasien.index', compact('pasiens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'usia' => 'required|numeric',
            'alamat' => 'required'
        ]);

        Pasien::create($request->all());
        return redirect()->route('pasien.index')->with('success', 'Data Pasien berhasil ditambahkan!');
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'usia' => 'required|numeric',
            'alamat' => 'required'
        ]);

        $pasien->update($request->all());
        return redirect()->route('pasien.index')->with('success', 'Data Pasien berhasil diperbarui!');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Data Pasien berhasil dihapus!');
    }
}