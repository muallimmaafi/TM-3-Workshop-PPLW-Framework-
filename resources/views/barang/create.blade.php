@extends('layouts.master')

@section('content')

<form action="{{ route('barang.store') }}" method="POST">
@csrf

<div class="card">
<div class="card-body">

<label>Nama Barang</label>
<input type="text" name="nama_barang" class="form-control">

<br>

<label>Harga</label>
<input type="number" name="harga" class="form-control">

<br>
<button class="btn btn-success">Simpan</button>

</div>
</div>

</form>

@endsection