<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Pemasok;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->cari;
        $data = Barang::where('nama_barang', 'like', "%$keyword%")->paginate(10);
        return view('barang.index', compact('data', 'keyword'));
    }

    public function create()
    {
        $pemasok = Pemasok::all();
        return view('barang.create', compact('pemasok'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'pemasok_id' => 'required',
            'gambar' => 'nullable|image|mimes:png|max:2048',
            'keterangan' => 'nullable'
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('barang', 'public');
            $validated['gambar'] = $gambar;
        }

        Barang::create($validated);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $pemasok = Pemasok::all();
        return view('barang.edit', compact('barang', 'pemasok'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        $validated = $request->validate([
            'nama_barang' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
            'pemasok_id' => 'required',
            'gambar' => 'nullable|image|mimes:png|max:2048',
            'keterangan' => 'nullable'
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('barang', 'public');
            $validated['gambar'] = $gambar;
        }

        $barang->update($validated);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $barang = barang::findOrFail($id);
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Barang berhasil dihapus!');
    }
}
