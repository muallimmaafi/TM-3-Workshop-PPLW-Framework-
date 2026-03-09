@extends('layouts.master')

@section('content')

<form id="formBarang" action="{{ route('barang.store') }}" method="POST">
@csrf

<div class="card">
<div class="card-body">

<label>Nama Barang</label>
<input type="text" name="nama_barang" class="form-control" required>

<br>

<label>Harga</label>
<input type="number" name="harga" class="form-control" required>

<br>

<button type="button" id="btnSubmit" class="btn btn-success">
Simpan
</button>

</div>
</div>

</form>

@endsection


@push('js-page')

<script>

$(document).ready(function(){

$('#btnSubmit').click(function(){

let form = document.getElementById('formBarang');

if(!form.checkValidity()){
form.reportValidity();
return;
}

let btn = $(this);

btn.html('Menyimpan...');
btn.prop('disabled', true);

setTimeout(function(){

$('#formBarang').submit();

},500);

});

});

</script>

@endpush