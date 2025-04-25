{{-- resources/views/produk/index.blade.php --}}
@extends('layouts.app')

    {{-- FontAwesome di-include sekali di layout, atau tambahkan di sini jika perlu --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between mb-3">
            <h2>Dashboard Produk</h2>
            <a href="{{ route('transaksi.cart') }}" class="btn btn-outline-success">
                <i class="fas fa-shopping-cart"></i> Keranjang
            </a>
        </div>

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('produk.index') }}" class="row g-2 mb-4">
            <div class="col-md-5">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control" placeholder="Cari nama produk…">
            </div>
            <div class="col-md-4">
                <select name="kategori" class="form-select">
                    <option value="">— Semua Kategori —</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 d-flex">
                <button type="submit" class="btn btn-primary me-2 flex-fill">
                    <i class="fas fa-search"></i> Cari
                </button>
                <a href="{{ route('produk.index') }}" class="btn btn-secondary flex-fill">
                    <i class="fas fa-sync-alt"></i> Reset
                </a>
            </div>
        </form>

        {{-- Produk Table --}}
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Foto</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($produks as $p)
                        <tr>
                            <td>{{ $p->kode_produk }}</td>
                            <td>{{ $p->kategori->nama ?? '–' }}</td>
                            <td>{{ $p->nama }}</td>
                            <td>Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td>
                                @if($p->foto)
                                    <img src="{{ asset($p->foto) }}" alt="Foto {{ $p->nama }}" class="img-thumbnail"
                                        style="width:60px">
                                @else
                                    <span class="text-muted">–</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <form action="{{ route('transaksi.beli') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="produk_id" value="{{ $p->id }}">
                                    <button class="btn btn-success btn-sm">
                                        <i class="fas fa-cart-plus"></i>  Add
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada produk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination Links --}}
        <div class="d-flex justify-content-center">
            {{ $produks->links() }}
        </div>
    </div>
@endsection