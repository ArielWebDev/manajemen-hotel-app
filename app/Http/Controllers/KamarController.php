<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kamar;
use App\Models\Kategori;

class KamarController extends Controller
{
    public function index()
    {
        $kamars = Kamar::all();
        $kategoris = Kategori::all();
        return view('admin.kamar.index', compact('kamars', 'kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:kamar',
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        Kamar::create($request->all());
        
        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_kamar' => 'required|unique:kamar,nomor_kamar,'.$id,
            'kategori_id' => 'required|exists:kategori,id',
        ]);

        $kamar = Kamar::findOrFail($id);
        $kamar->update($request->all());

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kamar->delete();

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
