@extends('template')

@section('content')
<div class="container">
    <h2>Data Barang</h2>

    <div class="d-flex justify-content-between my-3">
        <form action="{{ route('barang.index') }}" method="GET" class="form-inline">
            <input type="text" name="cari" class="form-control" placeholder="Cari nama barang..." value="{{ request('cari') }}">
        </form>
        <a href="{{ route('barang.create') }}" class="btn btn-success">+ Tambah Data</a>
    </div>

    <style>
        .table img {
            max-width: 60px;
            max-height: 60px;
            object-fit: cover;
            border-radius: 4px;
        }
    </style>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok</th>
                <th>Pemasok</th>
                <th>Gambar</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $barang)
                <tr>
                    <td>{{ $barang->nama_barang }}</td>
                    <td>Rp {{ number_format($barang->harga_beli, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($barang->harga_jual, 0, ',', '.') }}</td>
                    <td>{{ $barang->stok }}</td>
                    <td>{{ $barang->pemasok->nama_pemasok ?? '-' }}</td>
                    <td>
                        @if ($barang->gambar)
                            <img src="{{ asset('storage/' . $barang->gambar) }}" alt="{{ $barang->nama_barang }}" class="img-thumbnail">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>{{ $barang->keterangan }}</td>
                    <td>
                        <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
</div>
@endsection