@extends('template')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Pembelian</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Data Pembelian</h6>
            <a href="{{ route('pembelian.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Pembelian
            </a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Pemasok</th>
                            <th>Total Harga</th>
                            <th>Tanggal</th>
                            <th>Kasir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pembelians as $key => $pembelian)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>PBL-{{ str_pad($pembelian->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $pembelian->pemasok->name_pemasok }}</td>
                            <td>Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}</td>
                            <td>{{ $pembelian->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ $pembelian->user->name }}</td>
                            <td>
                                <a href="{{ route('pembelian.show', $pembelian->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('pembelian.destroy', $pembelian->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hapus data pembelian ini?')">
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