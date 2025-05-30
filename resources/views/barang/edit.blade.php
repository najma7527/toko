@extends('template')

@section('content')
<div class="container">
    <h2>Edit Barang</h2>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('barang.form', ['barang' => $barang])
    </form>
</div>
@endsection
