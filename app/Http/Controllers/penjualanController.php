<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\detail_penjualan;
use App\Models\penjualan;
use App\Models\DetailPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class penjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with(['user'])->get();
        return view('penjualan.index', compact('penjualans'));
    }
    
    public function create()
    {
        $barangs = Barang::where('stok', '>', 0)->get();
        return view('penjualan.create', compact('barangs'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|array',
            'barang_id.*' => 'exists:barangs,id',
            'jumlah' => 'required|array',
            'jumlah.*' => 'integer|min:1',
        ]);
        
        // Hitung total harga
        $total = 0;
        foreach ($request->barang_id as $key => $barang_id) {
            $barang = Barang::find($barang_id);
            if ($barang->stok < $request->jumlah[$key]) {
                return back()->with('error', 'Stok barang ' . $barang->name_barang . ' tidak mencukupi');
            }
            $total += $request->jumlah[$key] * $barang->harga_jual;
        }
        
        // Buat penjualan
        $penjualan = Penjualan::create([
            'user_id' => Auth::id(),
            'total_harga' => $total,
        ]);
        
        // Buat detail penjualan
        foreach ($request->barang_id as $key => $barang_id) {
            $barang = Barang::find($barang_id);
            
            detail_penjualan::create([
                'penjualan_id' => $penjualan->id,
                'barang_id' => $barang_id,
                'jumlah' => $request->jumlah[$key],
                'harga_jual' => $barang->harga_jual,
                'sub_total' => $request->jumlah[$key] * $barang->harga_jual,
            ]);
            
            // Update stok barang
            $barang->stok -= $request->jumlah[$key];
            $barang->save();
        }
        
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dibuat');
    }
    
    public function show($id)
    {
        $penjualan = Penjualan::with(['user', 'detailPenjualan.barang'])->findOrFail($id);
        return view('penjualan.show', compact('penjualan'));
    }
    
    public function destroy($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        
        // Kembalikan stok barang
        foreach ($penjualan->detailPenjualan as $detail) {
            $barang = Barang::find($detail->barang_id);
            $barang->stok += $detail->jumlah;
            $barang->save();
        }
        
        $penjualan->delete();
        return redirect()->route('penjualan.index')->with('success', 'Penjualan berhasil dihapus');
    }

}
