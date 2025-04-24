@extends('layouts.app') {{-- atau sesuaikan dengan layout kamu --}}

@section('content')
    <div class="container">
        <h2>Tambah Kategori Baru</h2>

        <form method="POST" action="{{ route('kategori.store') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="nama">Nama Kategori</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
@endsection