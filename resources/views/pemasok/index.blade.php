@extends('template')

@section('content')
<div class="container">
    <h2>Data Pemasok</h2>

    <div class="d-flex justify-content-between my-3">
        <form action="{{ route('pemasok.index') }}" method="GET" class="form-inline">
            <input type="text" name="cari" class="form-control" placeholder="Cari nama pemasok..." value="{{ request('cari') }}">
        </form>
        <a href="{{ route('pemasok.create') }}" class="btn btn-success">+ Tambah Pemasok</a>
    </div>

    
   

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Nama Pemasok</th>
                <th>No Telp</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $pemasok)
                <tr>
                    <td>{{ $pemasok->nama_pemasok }}</td>
                    <td>{{ $pemasok->no_telp }}</td>
                    <td>{{ $pemasok->alamat }}</td>
                    <td>
                        <a href="{{ route('pemasok.edit', $pemasok->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pemasok.destroy', $pemasok->id) }}" method="POST" style="display:inline-block;">
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
