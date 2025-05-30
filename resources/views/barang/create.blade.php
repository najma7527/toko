@extends('template')

@section('content')
<div class="container">
    <h2>Tambah Barang</h2>

    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @include('barang.form', ['barang' => null])
    </form>
</div>
@endsection
