@extends('layouts.app')

@section('content')
    <div class="container my-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Keranjang Belanja</h5>
                <a href="{{ route('home') }}" class="btn btn-outline-success btn-sm">Beranda</a>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @elseif (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if(count($carts) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cart->produk->nama }}</td>
                                        <td>Rp {{ number_format($cart->harga, 0, ',', '.') }}</td>
                                        <td class="d-flex gap-2">
                                            <!-- Form Hapus Cart -->
                                            <form id="deleteForm{{ $cart->id }}" action="{{ route('transaksi.clearcart', $cart->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="if(confirm('Yakin ingin menghapus item ini dari keranjang?')) { document.getElementById('deleteForm{{ $cart->id }}').submit(); }">
                                                Hapus
                                            </button>

                                            <!-- Form Bayar -->
                                            <form id="paymentForm{{ $cart->id }}" action="{{ route('transaksi.bayar') }}" method="POST" style="display: none;">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                                            </form>
                                            <button type="button" class="btn btn-success btn-sm"
                                                onclick="if(confirm('Yakin ingin membayar?')) { document.getElementById('paymentForm{{ $cart->id }}').submit(); }">
                                                Bayar
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center text-muted">Keranjang kosong.</div>
                @endif
            </div>
        </div>
    </div>
@endsection
