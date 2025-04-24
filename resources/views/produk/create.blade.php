@extends('layouts.app')

@section('content')
    <style>
        body {
            background-color: #f5f5f5;
        }

        .card-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .form-label {
            font-weight: 600;
            color: #212529;
        }

        .form-control, .form-control-file {
            border-radius: 8px;
        }

        .btn-primary {
            background-color: #03ac0e;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #02940d;
        }

        .alert-danger {
            border-radius: 8px;
        }

        .heading {
            font-size: 24px;
            font-weight: bold;
            color: #212529;
            margin-bottom: 20px;
            border-bottom: 2px solid #03ac0e;
            display: inline-block;
        }
    </style>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card-form">
                    <div class="heading">🛒 Tambah Produk</div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_produk" class="form-label">Kode Produk</label>
                            <input type="text" name="kode_produk" class="form-control" required>
                        </div>
                        <div>
                            <label for="kategori_id">Kategori</label>
                            <select name="kategori_id" class="form-control">
                                <option value="">- Pilih Kategori -</option>
                                @foreach ($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ (old('kategori_id') ?? ($produk->kategori_id ?? '')) == $kategori->id ? 'selected' : '' }}>
                                        {{ $kategori->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="text" name="harga" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label for="foto" class="form-label">Foto Produk</label>
                            <input type="file" name="foto" class="form-control-file" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
