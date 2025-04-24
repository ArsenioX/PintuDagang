<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::all();
        return view('adminHome', ['produks' => $produks]);
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_produk' => 'required|unique:produks',
            'nama' => 'required',
            'harga' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048' // Validasi foto
        ]);

        $path = null;
        if ($request->hasFile('foto')) {
            $path = $request->file('foto')->store('produk', 'public'); // Simpan di storage/app/public/produk
        }

        Produk::create([
            'kode_produk' => $request->kode_produk,
            'kategori_id' => $request->input('kategori_id'),
            'nama' => $request->nama,
            'harga' => $request->harga,
            'foto' => $path ? 'storage/' . $path : null, // Simpan path yang bisa diakses
        ]);

        return redirect()->route('adminHome')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit($id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = Kategori::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kode_produk' => 'required',
            'nama' => 'required',
            'kategori_id' => 'nullable|exists:kategoris,id',
            'harga' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048' // Validasi foto
        ]);

        $produk = Produk::findOrFail($id);
        $path = $produk->foto; // Simpan path lama jika tidak ada update foto

        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($produk->foto && Storage::disk('public')->exists(str_replace('storage/', '', $produk->foto))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $produk->foto));
            }
            $path = 'storage/' . $request->file('foto')->store('produk', 'public'); // Simpan gambar baru
        }

        $produk->update([
            'kode_produk' => $request->kode_produk,
            'kategori_id' => $request->input('kategori_id'),
            'nama' => $request->nama,
            'harga' => $request->harga,
            'foto' => $path,
        ]);

        return redirect()->route('adminHome')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto && Storage::disk('public')->exists(str_replace('storage/', '', $produk->foto))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $produk->foto));
        }

        $produk->delete();
        return redirect()->route('adminHome')->with('success', 'Produk berhasil dihapus');
    }

    public function bayar($id)
{
    $produk = Produk::findOrFail($id);
    $produk->sudah_dibayar = true; // Menandai bahwa produk sudah dibayar
    $produk->save();

    return redirect()->back()->with('success', 'Pembayaran berhasil!');
}
}
