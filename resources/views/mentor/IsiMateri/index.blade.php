@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Daftar Isi Materi</h2>
    <a href="{{ route('isi-materi.create') }}" class="btn btn-primary mb-3">+ Tambah Isi Materi</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Materi</th>
                <th>Judul Isi</th>
                <th>Tipe</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($isi as $i)
                <tr>
                    <td>{{ $i->materi->judul_materi }}</td>
                    <td>{{ $i->judul_isi }}</td>
                    <td>{{ $i->tipe }}</td>
                    <td>
                        <a href="{{ route('isi-materi.edit', $i->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('isi-materi.destroy', $i->id) }}" method="POST" style="display: inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus konten ini?')" 
                                class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr><td colspan="4" class="text-center">Belum ada isi materi.</td></tr>
            @endforelse
        </tbody>
    </table>

</div>
@endsection
