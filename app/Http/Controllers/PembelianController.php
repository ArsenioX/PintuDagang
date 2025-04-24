<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\User;
use App\Models\Cart;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use PDF;

class PembelianController extends Controller
{
    // Tampil semua produk & cart
    public function index()
    {
        $tikets = Produk::all();
        $users = User::all();
        $carts = Cart::all();
        return view('transaksi.transaksi', compact('tikets', 'users', 'carts'));
    }

    // Tampil cart milik user aktif
    public function transaksiCart()
    {
        $user = Auth::user();
        $carts = Cart::where('user_id', $user->id)->get();
        return view('transaksi.cart', compact('carts'));
    }

    // Tambahkan produk ke cart
    public function beli(Request $request)
    {
        $produk = Produk::findOrFail($request->produk_id);

        Cart::create([
            'user_id' => Auth::id(),
            'nama_user' => Auth::user()->name,
            'kode_produk' => $produk->kode_produk,
            'nama' => $produk->nama,
            'harga' => $produk->harga,
            'status' => 'belum_dibayar'
        ]);

        return redirect()->route('transaksi.cart')->with('success', 'Produk berhasil dimasukkan ke keranjang!');
    }

    // Hapus item dari cart
    public function clearCart($id)
    {
        // Temukan item dalam keranjang berdasarkan ID
        $cartItem = Cart::find($id);

        if ($cartItem) {
            // Hapus produk dari keranjang
            $cartItem->delete();

            // Redirect kembali ke halaman keranjang dengan pesan sukses
            return redirect()->route('transaksi.cart')->with('success', 'Produk berhasil dihapus dari keranjang.');
        }

        // Jika item tidak ditemukan
        return redirect()->route('transaksi.cart')->with('error', 'Item tidak ditemukan di keranjang.');
    }

    // Tampilkan transaksi user
    public function transaksiIndex()
    {
        $user = Auth::user();
        $transaksis = Transaksi::where('user_id', $user->id)->get();
        return view('transaksi.transaksi', compact('transaksis'));
    }

    // Tampilkan semua transaksi (untuk Manager/Admin)
    public function transaksiIndexManager()
    {
        $transaksis = Transaksi::all();
        return view('transaksi.transaksiManager', compact('transaksis'));
    }

    // Proses bayar cart -> pindah ke transaksi
    public function bayar(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
        ]);

        $user = Auth::user();
        $cart = Cart::findOrFail($request->cart_id);

        $transaksi = new Transaksi();
        $transaksi->user_id = $user->id;
        $transaksi->kode_produk = $cart->kode_produk;
        $transaksi->nama_user = $user->name;
        $transaksi->harga = $cart->harga;
        $transaksi->status = 'Pending';
        $transaksi->save();

        $cart->delete();

        return redirect()->route('transaksi.transaksi')
            ->with('success', 'Produk berhasil dibayar dan masuk ke transaksi!');
    }

    // Hapus transaksi (Manager)
    public function hapus($id)
    {
        $transaksi = Transaksi::find($id);
        if ($transaksi) {
            $transaksi->delete();
            return redirect()->route('transaksi.transaksiManager')
                ->with('success', 'Transaksi berhasil dihapus');
        }
        return redirect()->route('transaksi.transaksiManager')
            ->with('error', 'Transaksi tidak ditemukan.');
    }

    // Hapus transaksi (User)
    public function clear($id)
    {
        $transaksi = Transaksi::find($id);
        if ($transaksi) {
            // Menghapus transaksi jika ditemukan
            $transaksi->delete();
            return redirect()->route('transaksi.transaksi')
                ->with('success', 'Transaksi berhasil dibatalkan');
        }
        return redirect()->route('transaksi.transaksi')
            ->with('error', 'Transaksi tidak ditemukan.');
    }

    // Konfirmasi status transaksi jadi 'Selesai' (Manager)
    public function konfirmasiStatus($id)
    {
        $transaksi = Transaksi::find($id);
        if ($transaksi) {
            $transaksi->status = 'Selesai';
            $transaksi->save();
            return redirect()->route('transaksi.transaksiManager')
                ->with('success', 'Transaksi berhasil dikonfirmasi.');
        }
        return redirect()->route('transaksi.transaksiManager')
            ->with('error', 'Transaksi tidak ditemukan.');
    }

    // Generate PDF transaksi
    public function generatePdf($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi tidak ditemukan.');
        }

        $pdf = PDF::loadView('transaksi.pdf', compact('transaksi'));
        return $pdf->download('transaksi-' . $transaksi->kode_produk . '.pdf');
    }
}
