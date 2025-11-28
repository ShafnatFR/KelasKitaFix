@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Tambah Isi Materi untuk {{ $materi->judul_materi }}</h3>

    <form action="{{ route('mentor.isi-materi.store', $materi->id) }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Judul Isi</label>
            <input type="text" name="judul_isi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipe</label>
            <select name="tipe" class="form-control">
                <option value="text">Text</option>
                <option value="video">Video</option>
                <option value="file">File</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Konten</label>
            <textarea name="konten" class="form-control" rows="5" required></textarea>
        </div>

        <div class="mb-3">
            <label>File Path (jika tipe video/file)</label>
            <input type="text" name="file_path" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('mentor.isi-materi.index', $materi->id) }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
