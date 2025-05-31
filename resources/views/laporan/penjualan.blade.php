@extends('layouts.print')

@section('content')
<div class="header">
    <h2 class="text-center">LAPORAN PENJUALAN</h2>
    <p class="text-center mb-0">Periode: {{ $startDate->format('d/m/Y') }} s/d {{ $endDate->format('d/m/Y') }}</p>
    <p class="text-center">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
</div>

<h4 class="mt-4">Data Penjualan</h4>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>No. Penjualan</th>
            <th>Tanggal</th>
            <th>Kasir</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($penjualans as $penjualan)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>PJ-{{ str_pad($penjualan->id, 5, '0', STR_PAD_LEFT) }}</td>
            <td>{{ $penjualan->created_at->format('d/m/Y') }}</td>
            <td>{{ $penjualan->user->name }}</td>
            <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th colspan="4" class="text-end">Total</th>
            <th>Rp {{ number_format($penjualans->sum('total_harga'), 0, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>

<h4 class="mt-4">Detail Penjualan</h4>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>No. Penjualan</th>
            <th>Barang</th>
            <th>Harga Jual</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($detailPenjualans as $detail)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>PJ-{{ str_pad($detail->penjualan_id, 5, '0', STR_PAD_LEFT) }}</td>
            <td>{{ $detail->barang->name_barang }}</td>
            <td>Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
            <td>{{ $detail->jumlah }}</td>
            <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer mt-4">
    <div class="d-flex justify-content-between">
        <div class="text-start" style="width: 45%;">
            <p>Mengetahui,</p>
            <br><br><br>
            <p>_________________________</p>
            <p>Manager</p>
        </div>
        <div class="text-end" style="width: 45%;">
            <p>{{ date('d F Y') }}</p>
            <br><br><br>
            <p>_________________________</p>
            <p>Admin</p>
        </div>
    </div>
</div>

@endsection
