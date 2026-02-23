@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Kategori</h4>

        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Nama Kategori</label>
                <input type="text" 
                       name="nama_kategori" 
                       class="form-control"
                       value="{{ $kategori->nama_kategori }}" 
                       required>
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('kategori') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@endsection