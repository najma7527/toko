@extends('layouts.print')

@section('content')
<div class="header">
    <h2 class="text-center">LAPORAN PEMBELIAN LENGKAP</h2>
    <p class="text-center mb-0">Periode: {{ $startDate->format('d/m/Y') }} s/d {{ $endDate->format('d/m/Y') }}</p>
    <p class="text-center">Dicetak pada: {{ now()->format('d/m/Y H:i') }}</p>
</div>

<div class="summary mb-4">
    <div class="row">
        <div class="col-md-4">
            <p><strong>Total Transaksi:</strong> {{ $pembelians->count() }}</p>
        </div>
        <div class="col-md-4">
            <p><strong>Total Barang Dibeli:</strong> {{ $totalBarang }}</p>
        </div>
        <div class="col-md-4">
            <p><strong>Total Pembelian:</strong> Rp {{ number_format($totalPembelian, 0, ',', '.') }}</p>
        </div>
    </div>
</div>

<h4>Daftar Pembelian</h4>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>No. Pembelian</th>
            <th>Tanggal</th>
            <th>Pemasok</th>
            <th>Kasir</th>
            <th>Total Harga</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pembelians as $pembelian)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>PB-{{ str_pad($pembelian->id, 5, '0', STR_PAD_LEFT) }}</td>
            <td>{{ $pembelian->created_at->format('d/m/Y H:i') }}</td>
            <td>{{ optional($pembelian->pemasok)->name_pemasok ?? '-' }}</td>
            <td>{{ optional($pembelian->user)->name ?? '-' }}</td>
            <td>Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada data pembelian</td>
        </tr>
        @endforelse
    </tbody>
</table>

<h4 class="mt-4">Detail Item Pembelian</h4>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>No. Pembelian</th>
            <th>Nama Barang</th>
            <th>Harga Beli</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @forelse($detailPembelians as $detail)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>PB-{{ str_pad($detail->pembelian_id, 5, '0', STR_PAD_LEFT) }}</td>
            <td>{{ optional($detail->barang)->name_barang ?? 'Barang Tidak Ditemukan' }}</td>
            <td>Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
            <td>{{ $detail->jumlah }}</td>
            <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada detail pembelian</td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th colspan="3">Total</th>
            <th>Rp {{ number_format($detailPembelians->sum('harga_beli'), 0, ',', '.') }}</th>
            <th>{{ $detailPembelians->sum('jumlah') }}</th>
            <th>Rp {{ number_format($detailPembelians->sum('sub_total'), 0, ',', '.') }}</th>
        </tr>
    </tfoot>
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