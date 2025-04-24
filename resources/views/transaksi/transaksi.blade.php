@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-success"><strong>Data Produk</strong></h5>
            <div class="d-flex gap-2">
                <a href="{{ route('home') }}" class="btn btn-outline-dark btn-sm">Beranda</a>
                <a href="{{ route('transaksi.cart') }}" class="btn btn-success btn-sm">Cart</a>
            </div>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-dark text-white">
                        <tr>
                            <th>Kode Produk</th>
                            <th>Nama Pembeli</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Tanggal Transaksi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksis as $transaksi)
                            <tr>
                                <td>{{ $transaksi->kode_produk }}</td>
                                <td>{{ $transaksi->nama_user }}</td>
                                <td>Rp {{ number_format($transaksi->harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge {{ $transaksi->status == 'Selesai' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $transaksi->status }}
                                    </span>
                                </td>
                                <td>{{ $transaksi->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-center">
                                    @if($transaksi->status == 'Pending')
                                        <!-- Form batal tersembunyi -->
                                        <form id="cancelForm{{ $transaksi->id }}" action="{{ route('transaksi.clear', $transaksi->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="if(confirm('Apakah Anda yakin? Transaksi ini akan dibatalkan!')) { document.getElementById('cancelForm{{ $transaksi->id }}').submit(); }">
                                            Batal
                                        </button>
                                    @elseif($transaksi->status == 'Selesai')
                                        <a href="{{ route('transaksi.cetak', $transaksi->id) }}" target="_blank" class="btn btn-sm btn-success">Cetak</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @if($transaksis->isEmpty())
                            <tr>
                                <td colspan="6" class="text-center text-muted">Belum ada transaksi.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
