<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\IsiMateri;
use App\Models\Materi;
use Illuminate\Http\Request;

class IsiMateriController extends Controller
{
    public function index()
    {
        $isi = IsiMateri::with('materi')->get();
        return view('Mentor.IsiMateri.index', compact('isi'));
    }

    public function create()
    {
        $materi = Materi::whereHas('kelas', function($q){
            $q->where('mentor_id', auth()->id());
        })->get();

        return view('Mentor.IsiMateri.create', compact('materi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materi_id' => 'required',
            'judul_isi' => 'required',
            'konten' => 'required',
            'tipe' => 'required'
        ]);

        IsiMateri::create($request->all());

        return redirect()->route('isi-materi.index')->with('success','Isi materi ditambahkan');
    }

    public function edit(IsiMateri $isiMateri)
    {
        $materi = Materi::all();
        return view('Mentor.IsiMateri.edit', compact('isiMateri','materi'));
    }

    public function update(Request $request, IsiMateri $isiMateri)
    {
        $isiMateri->update($request->all());
        return redirect()->route('isi-materi.index')->with('success','Isi materi diperbarui');
    }

    public function destroy(IsiMateri $isiMateri)
    {
        $isiMateri->delete();
        return redirect()->route('isi-materi.index')->with('success','Isi materi dihapus');
    }
}
