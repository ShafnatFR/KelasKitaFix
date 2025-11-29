@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Daftar Materi</h2>
    <a href="{{ route('materi.create') }}" class="btn btn-primary mb-3">+ Tambah Materi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kelas</th>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Urutan</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>

            @forelse($materi as $m)
                <tr>
                    <td>{{ $m->kelas->nama_kelas }}</td>
                    <td>{{ $m->judul_materi }}</td>
                    <td>{{ $m->deskripsi_materi }}</td>
                    <td>{{ $m->urutan }}</td>
                    <td>{{ $m->status }}</td>
                    <td>

                        <a href="{{ route('materi.edit', $m->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('materi.destroy', $m->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus Materi?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>

                        <a href="{{ route('isi-materi.index', ['materi_id' => $m->id]) }}" class="btn btn-info btn-sm">
                            Isi Materi
                        </a>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada materi.</td>
                </tr>
            @endforelse

        </tbody>
    </table>

</div>
@endsection
