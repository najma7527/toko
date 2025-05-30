@extends('template')

@section('content')
<div class="container">
    <h2>Edit Pemasok</h2>

    <form action="{{ route('pemasok.update', $pemasok->id) }}" method="POST">
        @csrf
        @method('PUT')
        @include('pemasok.form', ['pemasok' => $pemasok])
    </form>
</div>
@endsection
