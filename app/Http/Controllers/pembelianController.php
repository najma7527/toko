<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_pembelian;
use App\Models\Pemasok;
use App\Models\pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class pembelianController extends Controller
{
   public function index()
    {
        $pembelians = Pembelian::with(['pemasok', 'user'])->get();
        return view('pembelian.index', compact('pembelians'));
    }
    
    public function create()
    {
        $pemasoks = Pemasok::all();
        $barangs = Barang::all();
        return view('pembelian.create', compact('pemasoks', 'barangs'));
    }
    
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'pemasok_id' => 'required|exists:pemasoks,id',
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
            'harga_satuan' => 'required|array',
            'harga_satuan.*' => 'numeric|min:0',
        ]);
        
        // Hitung total harga
        $total = 0;
        foreach ($request->barang_id as $key => $barang_id) {
            $total += $request->jumlah[$key] * $request->harga_satuan[$key];
        }
        
        // Buat pembelian
        $pembelian = Pembelian::create([
            'pemasok_id' => $request->pemasok_id,
            'user_id' => Auth::id(),
            'total_harga' => $total,
        ]);
        
        // Buat detail pembelian
        foreach ($request->barang_id as $key => $barang_id) {
            detail_pembelian::create([
                'pembelian_id' => $pembelian->id,
                'barang_id' => $barang_id,
                'jumlah' => $request->jumlah[$key],
                'harga_satuan' => $request->harga_satuan[$key],
                'sub_total' => $request->jumlah[$key] * $request->harga_satuan[$key],
                'keterangan' => $request->keterangan[$key] ?? null,
            ]);
            
            // Update stok barang
            $barang = Barang::find($barang_id);
            $barang->stok += $request->jumlah[$key];
            $barang->save();
        }
        
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dibuat');
    }
    
    public function show($id)
    {
        $pembelian = Pembelian::with(['pemasok', 'user', 'detailPembelian.barang'])->findOrFail($id);
        return view('pembelian.show', compact('pembelian'));
    }
    
    public function destroy($id)
    {
        $pembelian = pembelian::findOrFail($id);
        
        // Kembalikan stok barang
        foreach ($pembelian->detailPembelian as $detail) {
            $barang = barang::find($detail->barang_id);
            $barang->stok -= $detail->jumlah;
            $barang->save();
        }
        
        $pembelian->delete();
        return redirect()->route('pembelian.index')->with('success', 'Pembelian berhasil dihapus');
    }
}
