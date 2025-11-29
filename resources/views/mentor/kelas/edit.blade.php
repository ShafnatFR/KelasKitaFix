@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Edit Kelas</h2>

    <form action="{{ route('kelas.update', $kela->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" value="{{ $kela->nama_kelas }}" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" value="{{ $kela->kategori }}" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="{{ $kela->harga }}" required>
        </div>

        <div class="mb-3">
            <label>Profil Kelas</label>
            <input type="text" name="profil_kelas" class="form-control" value="{{ $kela->profil_kelas }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi Kelas</label>
            <textarea name="deskripsi_kelas" class="form-control" required>{{ $kela->deskripsi_kelas }}</textarea>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
