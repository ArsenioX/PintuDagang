@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f2f2f2;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        .card-header {
            background-color: #03ac0e;
            color: #fff;
            font-size: 1.4rem;
            font-weight: 600;
            padding: 16px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table thead {
            background-color: #1e1e1e;
            color: white;
        }

        .btn {
            border-radius: 8px;
            font-weight: 500;
        }

        .btn-primary {
            background-color: #03ac0e;
            border: none;
        }

        .btn-primary:hover {
            background-color: #02940d;
        }

        .btn-warning {
            background-color: #ffc107;
            border: none;
            color: #000;
        }

        .btn-danger {
            background-color: #dc3545;
            border: none;
        }

        .btn-info {
            background-color: #17a2b8;
            border: none;
            color: #fff;
        }

        .product-img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 5px;
            background-color: #ffffff;
        }

        .title {
            font-weight: 600;
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .table tbody tr:hover {
            background-color: #e9f7ef;
        }
    </style>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-11">
                <div class="card">
                    <div class="card-header">
                        <span>🛍️ PINTU DAGANG</span>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="title">📦 Daftar Produk</div>
                            <button class="btn btn-info btn-sm" onclick="confirmManager()">Konfirmasi Transaksi</button>
                        </div>

                        <table class="table table-bordered table-hover">
                            <thead class="text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Kategori</th>
                                    <th>Harga (Rp)</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($produks as $produk)
                                    <tr class="text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $produk->nama }}</td>
                                        <td>{{ $produk->kategori->nama ?? '-' }}</td>
                                        <td>{{ number_format($produk->harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if($produk->foto)
                                                <img src="{{ asset($produk->foto) }}" class="product-img">
                                            @else
                                                <span class="text-muted">Tidak ada gambar</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning btn-sm"
                                                onclick="event.preventDefault(); confirmEdit({{ $produk->id }})">Edit</a>

                                            <form id="delete-form-{{ $produk->id }}"
                                                action="{{ route('produk.destroy', $produk->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $produk->id }})">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <a href="{{ route('produk.create') }}" class="btn btn-primary mt-3"
                            onclick="event.preventDefault(); confirmAdd()">+ Tambah Produk</a>
                        <a href="{{ route('kategori.create') }}" class="btn btn-success mt-3">+ Tambah Kategori</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

        function confirmLogout() {
            Swal.fire({
                title: 'Logout?',
                text: "Anda yakin ingin keluar?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#03ac0e',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('logout') }}';
                }
            });
        }

        function confirmAdd() {
            Swal.fire({
                title: 'Tambah Produk?',
                text: "Akan diarahkan ke halaman tambah.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#03ac0e',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('produk.create') }}';
                }
            });
        }

        function confirmEdit(id) {
            Swal.fire({
                title: 'Edit Produk?',
                text: "Akan diarahkan ke halaman edit.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#ffc107',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/produk/' + id + '/edit';
                }
            });
        }

        function confirmManager() {
            Swal.fire({
                title: 'Ke Halaman Konfirmasi Transaksi?',
                text: "Akan diarahkan ke daftar transaksi yang perlu dikonfirmasi.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#03ac0e',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Lanjut',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '{{ route('transaksi.transaksiManager') }}';
                }
            });
        }
    </script>
@endsection