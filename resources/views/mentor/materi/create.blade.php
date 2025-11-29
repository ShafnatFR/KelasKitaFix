@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Tambah Materi Baru</h2>

    <form action="{{ route('materi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Pilih Kelas</label>
            <select name="kelas_id" class="form-control" required>
                <option value="">-- pilih kelas --</option>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul Materi</label>
            <input type="text" name="judul_materi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi Materi</label>
            <textarea name="deskripsi_materi" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" value="1" min="1">
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('materi.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
