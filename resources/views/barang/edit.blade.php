@extends('layouts.master')

@section('content')

<form action="{{ route('barang.update', $barang->id_barang) }}" method="POST">
@csrf

<div class="card">
<div class="card-body">

<label>Nama Barang</label>
<input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" class="form-control">

<br>

<label>Harga</label>
<input type="number" name="harga" value="{{ $barang->harga }}" class="form-control">

<br>
<button class="btn btn-success">Update</button>

</div>
</div>

</form>

@endsection