@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Tambah Kelas Baru</h2>

    <form action="{{ route('kelas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama Kelas</label>
            <input type="text" name="nama_kelas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <input type="text" name="kategori" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Profil Kelas (URL gambar / teks)</label>
            <input type="text" name="profil_kelas" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi Kelas</label>
            <textarea name="deskripsi_kelas" class="form-control" required></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('kelas.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
