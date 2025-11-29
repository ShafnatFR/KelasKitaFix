<?php

namespace App\Http\Controllers\Mentor;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::where('mentor_id', auth()->id())->get();
        return view('Mentor.Kelas.index', compact('kelas'));
    }

    public function create()
    {
        return view('Mentor.Kelas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'kategori' => 'required',
            'harga' => 'required|integer|min:0',
            'profil_kelas' => 'required|string',
            'deskripsi_kelas' => 'required',
        ]);

        Kelas::create([
            'mentor_id' => auth()->id(),
            'nama_kelas' => $request->nama_kelas,
            'kategori' => $request->kategori,
            'harga' => $request->harga,
            'profil_kelas' => $request->profil_kelas,
            'deskripsi_kelas' => $request->deskripsi_kelas,
            'status_publikasi' => 'draft'
        ]);

        return redirect()->route('kelas.index')->with('success','Kelas berhasil dibuat');
    }

    public function edit(Kelas $kela)
    {
        return view('Mentor.Kelas.edit', compact('kela'));
    }

    public function update(Request $request, Kelas $kela)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'kategori' => 'required',
            'harga' => 'required|integer|min:0',
            'profil_kelas' => 'required|string',
            'deskripsi_kelas' => 'required',
        ]);

        $kela->update($request->all());

        return redirect()->route('kelas.index')->with('success','Kelas berhasil diperbarui');
    }

    public function destroy(Kelas $kela)
    {
        $kela->delete();

        return redirect()->route('kelas.index')->with('success','Kelas berhasil dihapus');
    }
}
