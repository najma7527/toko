@extends('template')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Penjualan</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Penjualan #PJL-{{ str_pad($penjualan->id, 5, '0', STR_PAD_LEFT) }}</h6>
            <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Tanggal:</strong> {{ $penjualan->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <p><strong>Kasir:</strong> {{ $penjualan->user->name }}</p>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga Jual</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualan->detailPenjualan as $key => $detail)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $detail->barang->nama_barang }}</td>
                            <td>Rp {{ number_format($detail->harga_jual, 0, ',', '.') }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Total</th>
                            <th>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection