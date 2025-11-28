@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Materi untuk {{ $kelas->nama_kelas }}</h3>

    <form action="{{ route('mentor.materi.store', $kelas->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Judul Materi</label>
            <input type="text" name="judul_materi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi Materi</label>
            <textarea name="deskripsi_materi" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" value="1" min="1">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('mentor.materi.index', $kelas->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
