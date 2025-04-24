@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Kategori</h2>

        <form action="{{ route('kategori.update', $kategori) }}" method="POST">
            @csrf @method('PUT')
            <div class="form-group mb-3">
                <label>Nama Kategori</label>
                <input type="text" name="nama" value="{{ $kategori->nama }}" class="form-control" required>
            </div>
            <button class="btn btn-primary">Update</button>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
@endsection