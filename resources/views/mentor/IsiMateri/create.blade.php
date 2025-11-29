@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Tambah Isi Materi</h2>

    <form action="{{ route('isi-materi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Pilih Materi</label>
            <select name="materi_id" class="form-control" required>
                <option value="">-- pilih materi --</option>
                @foreach($materi as $m)
                    <option value="{{ $m->id }}">{{ $m->judul_materi }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul Isi</label>
            <input type="text" name="judul_isi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipe</label>
            <select name="tipe" class="form-control" required>
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
            <label>File Path (optional)</label>
            <input type="text" name="file_path" class="form-control">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('isi-materi.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
