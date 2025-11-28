<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\IsiMateri;
use App\Models\Materi;
use Illuminate\Http\Request;

class IsiMateriController extends Controller
{
    public function index(Materi $materi)
    {
        $isi = $materi->isiMateri()->get();

        return view('Mentor.IsiMateri.index', compact('materi', 'isi'));
    }

    public function create(Materi $materi)
    {
        return view('Mentor.IsiMateri.create', compact('materi'));
    }

    public function store(Request $request, Materi $materi)
    {
        $request->validate([
            'judul_isi' => 'required|string|max:255',
            'konten' => 'required|string',
            'tipe' => 'required|in:text,video,file',
            'file_path' => 'nullable|string',
        ]);

        IsiMateri::create([
            'materi_id' => $materi->id,
            'judul_isi' => $request->judul_isi,
            'konten' => $request->konten,
            'tipe' => $request->tipe,
            'file_path' => $request->file_path,
        ]);

        return redirect()
            ->route('mentor.isi-materi.index', $materi->id)
            ->with('success', 'Isi materi berhasil ditambahkan.');
    }

    public function edit(IsiMateri $isiMateri)
    {
        $materi = $isiMateri->materi;
        return view('Mentor.IsiMateri.edit', compact('isiMateri', 'materi'));
    }

    public function update(Request $request, IsiMateri $isiMateri)
    {
        $request->validate([
            'judul_isi' => 'required|string|max:255',
            'konten' => 'required|string',
            'tipe' => 'required|in:text,video,file',
            'file_path' => 'nullable|string',
        ]);

        $isiMateri->update([
            'judul_isi' => $request->judul_isi,
            'konten' => $request->konten,
            'tipe' => $request->tipe,
            'file_path' => $request->file_path,
        ]);

        return redirect()
            ->route('mentor.isi-materi.index', $isiMateri->materi_id)
            ->with('success', 'Isi materi berhasil diupdate.');
    }

    public function destroy(IsiMateri $isiMateri)
    {
        $materi_id = $isiMateri->materi_id;
        $isiMateri->delete();

        return redirect()
            ->route('mentor.isi-materi.index', $materi_id)
            ->with('success', 'Isi materi berhasil dihapus.');
    }
}
