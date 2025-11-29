@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Edit Isi Materi</h2>

    <form action="{{ route('isi-materi.update', $isiMateri->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Pilih Materi</label>
            <select name="materi_id" class="form-control" required>
                @foreach($materi as $m)
                    <option value="{{ $m->id }}" {{ $isiMateri->materi_id == $m->id ? 'selected' : '' }}>
                        {{ $m->judul_materi }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul Isi</label>
            <input type="text" name="judul_isi" class="form-control" value="{{ $isiMateri->judul_isi }}" required>
        </div>

        <div class="mb-3">
            <label>Tipe</label>
            <select name="tipe" class="form-control" required>
                <option value="text" {{ $isiMateri->tipe == 'text' ? 'selected' : '' }}>Text</option>
                <option value="video" {{ $isiMateri->tipe == 'video' ? 'selected' : '' }}>Video</option>
                <option value="file" {{ $isiMateri->tipe == 'file' ? 'selected' : '' }}>File</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Konten</label>
            <textarea name="konten" class="form-control" rows="5" required>{{ $isiMateri->konten }}</textarea>
        </div>

        <div class="mb-3">
            <label>File Path (optional)</label>
            <input type="text" name="file_path" class="form-control" value="{{ $isiMateri->file_path }}">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('isi-materi.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
