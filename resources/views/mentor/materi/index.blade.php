@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Materi - {{ $kelas->nama_kelas }}</h3>

    <a href="{{ route('mentor.materi.create', $kelas->id) }}" class="btn btn-primary mb-3">+ Tambah Materi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Urutan</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materi as $m)
                <tr>
                    <td>{{ $m->urutan }}</td>
                    <td>{{ $m->judul_materi }}</td>
                    <td>{{ $m->deskripsi_materi }}</td>
                    <td>
                        <a href="{{ route('mentor.isi-materi.index', $m->id) }}" class="btn btn-sm btn-info">Isi Materi</a>
                        <a href="{{ route('mentor.materi.edit', $m->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('mentor.materi.destroy', $m->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus materi?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4" class="text-center">Belum ada materi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
