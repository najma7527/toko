@extends('template')

@section('content')
@include('laporan.filter', ['action' => route('laporan.penjualan')]) 
<div class="container">
    <h1 class="mb-4">Daftar Penjualan</h1>

    <!-- <a href="{{ route('laporan.penjualan', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}" 
   class="btn btn-info" target="_blank">
    <i class="fas fa-print"></i> Cetak Laporan
</a> -->
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Penjualan</h6>
            <a href="{{ route('penjualan.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Penjualan
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($penjualans as $key => $penjualan)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>PJL-{{ str_pad($penjualan->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $penjualan->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $penjualan->user->name }}</td>
                            <td>
                                <a href="{{ route('penjualan.show', $penjualan->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data penjualan ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection