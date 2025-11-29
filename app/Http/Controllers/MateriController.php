<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Materi;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    public function index()
    {
        $materi = Materi::whereHas('kelas', function($q){
            $q->where('mentor_id', auth()->id());
        })->get();

        return view('Mentor.Materi.index', compact('materi'));
    }

    public function create()
    {
        $kelas = Kelas::where('mentor_id', auth()->id())->get();
        return view('Mentor.Materi.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required',
            'judul_materi' => 'required',
            'deskripsi_materi' => 'required',
        ]);

        Materi::create([
            'kelas_id' => $request->kelas_id,
            'judul_materi' => $request->judul_materi,
            'deskripsi_materi' => $request->deskripsi_materi,
            'urutan' => $request->urutan ?? 1,
            'status' => 'draft'
        ]);

        return redirect()->route('materi.index')->with('success','Materi berhasil ditambahkan');
    }

    public function edit(Materi $materi)
    {
        $kelas = Kelas::where('mentor_id', auth()->id())->get();
        return view('Mentor.Materi.edit', compact('materi','kelas'));
    }

    public function update(Request $request, Materi $materi)
    {
        $materi->update($request->all());

        return redirect()->route('materi.index')->with('success','Materi berhasil diperbarui');
    }

    public function destroy(Materi $materi)
    {
        $materi->delete();
        return redirect()->route('materi.index')->with('success','Materi berhasil dihapus');
    }
}
