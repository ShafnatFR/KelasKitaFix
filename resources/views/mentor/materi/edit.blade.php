@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Edit Materi</h2>

    <form action="{{ route('materi.update', $materi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Pilih Kelas</label>
            <select name="kelas_id" class="form-control" required>
                @foreach($kelas as $k)
                    <option value="{{ $k->id }}" {{ $materi->kelas_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Judul Materi</label>
            <input type="text" name="judul_materi" class="form-control" value="{{ $materi->judul_materi }}" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi Materi</label>
            <textarea name="deskripsi_materi" class="form-control" required>{{ $materi->deskripsi_materi }}</textarea>
        </div>

        <div class="mb-3">
            <label>Urutan</label>
            <input type="number" name="urutan" class="form-control" value="{{ $materi->urutan }}" min="1">
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('materi.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
