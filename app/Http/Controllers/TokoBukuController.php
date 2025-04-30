<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Penerbit;
use Illuminate\Http\Request;

class TokoBukuController extends Controller
{
    // Halaman Home/Beranda 
    public function home(Request $request)
    {
        $search = $request->input('search');
        $query = Buku::with('dataPenerbitBuku');
        
        if ($search) {
            $query->where('nama_buku', 'like', "%$search%")
                  ->orWhere('kategori', 'like', "%$search%");
        }
        
        $bukus = $query->get();
        
        // Hitung total buku dan penerbit untuk ditampilkan di card
        $totalBuku = Buku::sum('stok');
        $totalPenerbit = Penerbit::count();
        $stokMenipis = Buku::where('stok', '<=', 10)->count();
        
        return view('home', compact('bukus', 'search', 'totalBuku', 'totalPenerbit', 'stokMenipis'));
    }
    
    // Halaman Admin 
    public function admin()
    {
        $bukus = Buku::with('dataPenerbitBuku')->get();
        $penerbits = Penerbit::all();
        return view('admin.index', compact('bukus', 'penerbits'));
    }
    
    // Form tambah buku
    public function createBuku()
    {
        $penerbits = Penerbit::all();
        return view('admin.formBuku', compact('penerbits'));
    }
    
    // Form edit buku
    public function editBuku($id)
    {
        $buku = Buku::findOrFail($id);
        $penerbits = Penerbit::all();
        return view('admin.formBuku', compact('buku', 'penerbits'));
    }
    
    // Simpan buku (tambah/update)
    public function storeBuku(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'nama_buku' => 'required|string|max:255',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'id_penerbit' => 'required|exists:penerbits,id',
        ]);
        
        $exists = Buku::where('id', $request->id)->exists();
        
        Buku::updateOrCreate(
            ['id' => $request->id],
            [
                'kategori' => $request->kategori,
                'nama_buku' => $request->nama_buku,
                'harga' => $request->harga,
                'stok' => $request->stok,
                'id_penerbit' => $request->id_penerbit,
            ]
        );
        
        $message = $exists ? 'Data buku berhasil diperbarui!' : 'Data buku berhasil ditambahkan!';
        return redirect()->route('admin.index')->with('success', $message);
    }
    
    // Hapus buku
    public function destroyBuku($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('admin.index')->with('success', 'Data buku berhasil dihapus!');
    }
    
    // Form tambah penerbit
    public function createPenerbit()
    {
        return view('admin.formPenerbit');
    }
    
    // Form edit penerbit
    public function editPenerbit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        return view('admin.formPenerbit', compact('penerbit'));
    }
    
    // Simpan penerbit (tambah/update)
    public function storePenerbit(Request $request)
    {
        $request->validate([
            'id' => 'required|string|max:255',
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kota' => 'required|string|max:255',
            'telepon' => 'required|string|max:255',
        ]);
        
        $exists = Penerbit::where('id', $request->id)->exists();
        
        Penerbit::updateOrCreate(
            ['id' => $request->id],
            [
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'telepon' => $request->telepon,
            ]
        );
        
        $message = $exists ? 'Data penerbit berhasil diperbarui!' : 'Data penerbit berhasil ditambahkan!';
        return redirect()->route('admin.index')->with('success', $message);
    }
    
    // Hapus penerbit
    public function destroyPenerbit($id)
    {
        $penerbit = Penerbit::findOrFail($id);
        try {
            $penerbit->delete();
            return redirect()->route('admin.index')->with('success', 'Data penerbit berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.index')->with('error', 'Gagal menghapus penerbit! Pastikan tidak ada buku yang terkait.');
        }
    }
    
    // Halaman Pengadaan - Menampilkan buku dengan stok minimum
    public function pengadaan()
    {
        $bukus = Buku::where('stok', '<', 15)->orderByDesc('stok')->get();
        
        return view('pengadaan', compact('bukus'));
    }
}