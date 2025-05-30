<?php

namespace App\Http\Controllers;

use App\Models\Pemasok;
use Illuminate\Http\Request;

class pemasokController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->cari;
        $data = Pemasok::where('nama_pemasok', 'like', "%$keyword%")->paginate(10);
        return view('pemasok.index', compact('data', 'keyword'));
    }

    public function create()
    {
        return view('pemasok.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pemasok' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        Pemasok::create($validated);
        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        return view('pemasok.edit', compact('pemasok'));
    }

    public function update(Request $request, $id)
    {
        $pemasok = Pemasok::findOrFail($id);
        $validated = $request->validate([
            'nama_pemasok' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
        ]);

        $pemasok->update($validated);
        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pemasok = Pemasok::findOrFail($id);
        $pemasok->delete();
        return redirect()->route('pemasok.index')->with('success', 'Pemasok berhasil dihapus!');
    }
}
