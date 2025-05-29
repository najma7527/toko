<?php

namespace App\Http\Controllers;

use App\Models\barang;
use App\Models\Pemasok;
use App\Models\penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function allData1 (){
        Return View('Dashboard_Admin' , [
            'total_barang' => barang::count(),
            'total_pemasok' => pemasok::count(),
            'total_transaksi' => penjualan::count(),
            'pendapatan_bulan_ini' => penjualan::whereMonth('created_at', now()->month)->sum('total_harga'),
            'penjualan' => penjualan::with('kasir')->latest()->take(5)->get()
        ]);
    }

    public function allData2()
    {
        return view('Dashboard_Kasir', [
            'transaksi_hari_ini' => penjualan::whereDate('created_at', today())
                                ->where('user_id', Auth::id())
                                ->count(),
            'total_penjualan_hari_ini' => penjualan::whereDate('created_at', today())
                                        ->where('user_id', Auth::id())
                                        ->sum('total_harga'),
            'recent_transactions' => penjualan::where('user_id', Auth::id())
                                    ->latest()
                                    ->take(5)
                                    ->get()
        ]);
    }
}
