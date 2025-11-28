<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    // Tampilkan semua materi dalam satu kelas
    public function index(Kelas $kelas)
    {
        // opsional: pastikan kelas ini milik mentor yang login
        // if ($kelas->mentor_id != auth()->id()) abort(403);

        $materi = $kelas->materi()->orderBy('urutan')->get();

        return view('Mentor.Materi.index', compact('kelas', 'materi'));
    }

    public function create(Kelas $kelas)
    {
        return view('Mentor.Materi.create', compact('kelas'));
    }

    public function store(Request $request, Kelas $kelas)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi_materi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:1',
        ]);

        Materi::create([
            'kelas_id' => $kelas->id,
            'judul_materi' => $request->judul_materi,
            'deskripsi_materi' => $request->deskripsi_materi,
            'urutan' => $request->urutan ?? 1,
            'status' => 'draft', // default
        ]);

        return redirect()
            ->route('mentor.materi.index', $kelas->id)
            ->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Materi $materi)
    {
        $kelas = $materi->kelas;
        return view('Mentor.Materi.edit', compact('materi', 'kelas'));
    }

    public function update(Request $request, Materi $materi)
    {
        $request->validate([
            'judul_materi' => 'required|string|max:255',
            'deskripsi_materi' => 'nullable|string',
            'urutan' => 'nullable|integer|min:1',
        ]);

        $materi->update([
            'judul_materi' => $request->judul_materi,
            'deskripsi_materi' => $request->deskripsi_materi,
            'urutan' => $request->urutan ?? $materi->urutan,
            // status biar diatur admin / proses berikutnya
        ]);

        return redirect()
            ->route('mentor.materi.index', $materi->kelas_id)
            ->with('success', 'Materi berhasil diupdate.');
    }

    public function destroy(Materi $materi)
    {
        $kelas_id = $materi->kelas_id;
        $materi->delete();

        return redirect()
            ->route('mentor.materi.index', $kelas_id)
            ->with('success', 'Materi berhasil dihapus.');
    }
}
