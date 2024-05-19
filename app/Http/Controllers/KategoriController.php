<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function getKamars($id)
    {
        $kategori = Kategori::findOrFail($id);
        $kamars = $kategori->kamars()->get();

        return view('kategori.kamars', compact('kamars'));
    }
    
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategoris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric|min:0',
        ]);

        Kategori::create($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori created successfully.');
    }

    public function edit(Kategori $kategori)
    {
        return view('kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable',
            'harga' => 'required|numeric|min:0',
        ]);

        $kategori->update($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori updated successfully');
    }

    public function destroy(Kategori $kategori)
    {
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori deleted successfully');
    }
}
