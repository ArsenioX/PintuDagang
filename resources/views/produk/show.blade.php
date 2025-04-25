@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header text-center">
                <h3>Detail Produk</h3>
            </div>
            <div class="card-body">
                <!-- Informasi Produk -->
                <div class="row">
                    <div class="col-md-4 text-center">
                        @if($produk->foto)
                            <img src="{{ asset($produk->foto) }}" alt="{{ $produk->nama }}" class="img-fluid rounded">
                        @else
                            <img src="https://via.placeholder.com/150" alt="Foto Produk" class="img-fluid rounded">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <table class="table table-bordered">
                            <tr>
                                <th>Kode Produk</th>
                                <td>{{ $produk->kode_produk }}</td>
                            </tr>
                            <tr>
                                <th>Nama Produk</th>
                                <td>{{ $produk->nama }}</td>
                            </tr>
                            <tr>
                                <th>Kategori</th>
                                <td>{{ $produk->kategori->nama ?? 'Tidak Ada Kategori' }}</td>
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $produk->deskripsi ?? 'Tidak ada deskripsi' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="text-center mt-4">
                    <a href="{{ route('produk.index') }}" class="btn btn-secondary">Kembali</a>
                    <form action="{{ route('transaksi.beli') }}" method="POST" style="display: inline-block;">
                        @csrf
                        <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection