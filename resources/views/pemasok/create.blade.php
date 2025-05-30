@extends('template')

@section('content')
<div class="container">
    <h2>Tambah Pemasok</h2>

    <form action="{{ route('pemasok.store') }}" method="POST">
        @csrf
        @include('pemasok.form')
    </form>
</div>
@endsection
