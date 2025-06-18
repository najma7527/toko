<?php

namespace App\Http\Controllers;

use App\Models\detail_pembelian;
use App\Models\detail_penjualan;
use App\Models\pembelian;
use App\Models\penjualan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function pembelian(Request $request)
{
    // Validasi input tanggal
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date'
    ]);

    // Konversi tanggal ke format awal dan akhir hari
    $startDate = Carbon::parse($request->start_date)->startOfDay();
    $endDate = Carbon::parse($request->end_date)->endOfDay();

    $pembelians = pembelian::with(['pemasok', 'user'])
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

    $detailPembelians = detail_pembelian::with(['barang', 'pembelian'])
        ->whereHas('pembelian', function($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->get();

    $totalBarang = $detailPembelians->sum('jumlah');
    $totalPembelian = $detailPembelians->sum('sub_total');

    return view('laporan.pembelian', compact(
        'pembelians',
        'detailPembelians',
        'startDate',
        'endDate',
        'totalBarang',
        'totalPembelian'
    ));
}

    public function penjualan(Request $request)
{
    $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date'
    ]);

    $startDate = Carbon::parse($request->start_date)->startOfDay();
    $endDate = Carbon::parse($request->end_date)->endOfDay();

    $penjualans = penjualan::with(['user'])
        ->whereBetween('created_at', [$startDate, $endDate])
        ->get();

    $detailPenjualans = detail_penjualan::with(['barang', 'penjualan'])
        ->whereHas('penjualan', function($query) use ($startDate, $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        })
        ->get();

    return view('laporan.penjualan', compact(
        'penjualans',
        'detailPenjualans',
        'startDate',
        'endDate'
    ));
}

}
