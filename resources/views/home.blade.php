@extends('layouts.app')

@section('content')

    <!-- Link Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.08);
            border: 1px solid #e0e0e0;
        }

        .card-header {
            background-color: #03ac0e;
            color: #fff;
            font-size: 18px;
            font-weight: bold;
            padding: 12px 20px;
            border-top-left-radius: 12px;
            border-top-right-radius: 12px;
        }

        .table thead {
            background-color: #1a1a1a;
            color: #fff;
        }

        .table th, .table td {
            text-align: center;
            padding: 10px;
        }

        .table img {
            width: 70px;
            height: auto;
            border-radius: 5px;
        }

        .btn-success {
            background-color: #03ac0e;
            border-color: #03ac0e;
            color: white;
        }

        .btn-success:hover {
            background-color: #02940d;
            border-color: #02940d;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:disabled {
            background-color: #ccc;
            border-color: #ccc;
        }
    </style>

    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Dashboard Produk') }}</span>
                        <a href="{{ route('transaksi.cart') }}" class="btn btn-outline-success btn-sm">
                            <i class="fa fa-shopping-cart"></i> Lihat Keranjang
                        </a>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Kode Produk</th>
                                    <th>Kategori</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produks as $produk)
                                    <tr>
                                        <td>{{ $produk->kode_produk }}</td>
                                    <td>{{ $produk->kategori->nama ?? '-' }}</td>
                                        <td>{{ $produk->nama }}</td>
                                        <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($produk->foto)
                                                <img src="{{ asset($produk->foto) }}" alt="Foto Produk">
                                            @else
                                                Tidak ada gambar
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('transaksi.beli') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                                <button type="submit" class="btn btn-success btn-sm">
                                                    <i class="fa fa-cart-plus"></i> 
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

