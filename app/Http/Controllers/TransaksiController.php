<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use App\Models\Kategori;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    public function index()
    {
        // Mendapatkan semua transaksi
        $kamars = Kamar::with('kategori')->get();
        $transaksis = Transaksi::all();
        $kategoris = Kategori::all();

        // Mengembalikan view index.blade.php dengan data transaksis
        return view('admin.transaksi.index', ['transaksis' => $transaksis,'kamars' => $kamars, 'kategoris' => $kategoris]);
    }

    public function store(Request $request)
    {
        // Mendapatkan ID user yang sedang login
        $userId = Auth::id();
    
        // Validasi data yang diterima dari form
        $request->validate([
            'kamar_id' => 'required',
            'nama_pengunjung' => 'required',
            'nik' => 'required',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date',
        ]);
    
        // Mendapatkan kamar terkait
        $kamar = Kamar::findOrFail($request->kamar_id);
    
        // Mendapatkan kategori kamar terkait
        $kategori = $kamar->kategori;
        // dd($kategori);

    
        // Menghitung durasi menginap
        $tanggalCheckin = new \DateTime($request->tanggal_checkin);
        $tanggalCheckout = new \DateTime($request->tanggal_checkout);
        $durasi = $tanggalCheckin->diff($tanggalCheckout)->days;
    
        // Mendapatkan tarif harian kamar dari kategori kamar terkait
        $tarifHarian = $kategori->harga;
    
        // Menghitung biaya total transaksi
        $biaya = $durasi * $tarifHarian;
        // Membuat transaksi baru dengan data yang diterima dari form dan user_id yang sedang login
        $transaksi = Transaksi::create([
            'user_id' => $userId,
            'kamar_id' => $request->kamar_id,
            'nama_pengunjung' => $request->nama_pengunjung,
            'nik' => $request->nik,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
            'biaya' => $biaya, // Menyimpan biaya transaksi
        ]);
    
        // Perbarui status kamar menjadi 'dipesan'
        if ($kamar) {
            $kamar->status = 'dipesan';
            $kamar->save();
        }
    
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan');
    }
    

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'kamar_id' => 'required',
            'nama_pengunjung' => 'required',
            'nik' => 'required',
            'tanggal_checkin' => 'required|date',
            'tanggal_checkout' => 'required|date',
        ]);

        // Mengambil transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($id);

        // Update data transaksi dengan data yang diterima dari form
        $transaksi->update([
            'kamar_id' => $request->kamar_id,
            'nama_pengunjung' => $request->nama_pengunjung,
            'nik' => $request->nik,
            'tanggal_checkin' => $request->tanggal_checkin,
            'tanggal_checkout' => $request->tanggal_checkout,
        ]);
            // Perbarui status kamar menjadi 'dipesan' saat transaksi baru dibuat
        $kamar = $transaksi->kamar;
        if ($kamar) {
            $kamar->status = 'dipesan';
            $kamar->save();
        }
        
        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diupdate');
    }
    public function destroy(transaksi $transaksi)
    {
        $transaksi->delete();

        return redirect()->route('transaksi.index')
            ->with('success', 'Kategori deleted successfully');
    }
    public function getKamars(Kategori $kategori)
    {
        // Ambil daftar kamar berdasarkan kategori yang dipilih
        $kamars = $kategori->kamars()->get(['id', 'nomor_kamar']);

        return response()->json($kamars);
    }

    public function tempatkan($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'ditempati';
        $transaksi->save();
    
        // Update status kamar menjadi 'ditempati'
        $kamar = $transaksi->kamar; // Mengambil kamar terkait dengan transaksi
        $kamar->status = 'ditempati';
        $kamar->save();
    
        return redirect()->back()->with('success', 'Transaksi berhasil ditempatkan di kamar.');
    }
    
    public function checkout($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = 'selesai';
        $transaksi->save();
    
        // Update status kamar menjadi 'tersedia'
        $kamar = $transaksi->kamar; // Mengambil kamar terkait dengan transaksi
        $kamar->status = 'tersedia';
        $kamar->save();
    
        return redirect()->back()->with('success', 'Transaksi berhasil check-out dari kamar.');
    }
}
