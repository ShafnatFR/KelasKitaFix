@extends('layouts.app')

@section('content')
<div class="container">

    <h2>Daftar Kelas Saya</h2>
    <a href="{{ route('kelas.create') }}" class="btn btn-primary mb-3">+ Tambah Kelas</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Kelas</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Status Publikasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            @forelse($kelas as $k)
                <tr>
                    <td>{{ $k->nama_kelas }}</td>
                    <td>{{ $k->kategori }}</td>
                    <td>Rp {{ number_format($k->harga, 0, ',', '.') }}</td>
                    <td>{{ $k->status_publikasi }}</td>
                    <td>
                        <a href="{{ route('kelas.edit', $k->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('kelas.destroy', $k->id) }}" method="POST" style="display: inline-block;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Hapus kelas?')" class="btn btn-danger btn-sm">
                                Hapus
                            </button>
                        </form>
                        
                        <a href="{{ route('materi.index', ['kelas_id' => $k->id]) }}" 
                           class="btn btn-info btn-sm">
                            Materi
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Belum ada kelas.</td>
                </tr>
            @endforelse

        </tbody>
    </table>

</div>
@endsection
