@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Isi Materi - {{ $materi->judul_materi }}</h3>

    <a href="{{ route('mentor.isi-materi.create', $materi->id) }}" class="btn btn-primary mb-3">+ Tambah Isi Materi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul Isi</th>
                <th>Tipe</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($isi as $i)
                <tr>
                    <td>{{ $i->judul_isi }}</td>
                    <td>{{ $i->tipe }}</td>
                    <td>
                        <a href="{{ route('mentor.isi-materi.edit', $i->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('mentor.isi-materi.destroy', $i->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Hapus isi materi?')" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Belum ada isi materi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
