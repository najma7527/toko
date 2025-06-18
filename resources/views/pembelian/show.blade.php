@extends('template')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Pembelian</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Pembelian #PBL-{{ str_pad($pembelian->id, 5, '0', STR_PAD_LEFT) }}</h6>
            <a href="{{ route('pembelian.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-md-6">
                    <p><strong>Pemasok:</strong> {{ $pembelian->pemasok->name_pemasok }}</p>
                    <p><strong>Alamat:</strong> {{ $pembelian->pemasok->alamat }}</p>
                    <p><strong>Telepon:</strong> {{ $pembelian->pemasok->no_telp }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <p><strong>Tanggal:</strong> {{ $pembelian->created_at->format('d/m/Y H:i') }}</p>
                    <p><strong>Kasir:</strong> {{ $pembelian->user->name }}</p>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga Beli</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembelian->detailPembelian as $key => $detail)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $detail->barang->name_barang }}</td>
                            <td>Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}</td>
                            <td>{{ $detail->jumlah }}</td>
                            <td>Rp {{ number_format($detail->sub_total, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="text-right">Total</th>
                            <th>Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
           
        </div>
    </div>
</div>
@endsection