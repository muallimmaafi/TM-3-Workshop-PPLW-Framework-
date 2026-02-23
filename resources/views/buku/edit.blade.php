@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Buku</h4>

        <form action="{{ route('buku.update', $buku->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label>Kode</label>
                <input type="text" name="kode" 
                       class="form-control"
                       value="{{ $buku->kode }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Judul</label>
                <input type="text" name="judul" 
                       class="form-control"
                       value="{{ $buku->judul }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Pengarang</label>
                <input type="text" name="pengarang" 
                       class="form-control"
                       value="{{ $buku->pengarang }}" required>
            </div>

            <div class="form-group mb-3">
                <label>Kategori</label>
                <select name="kategori_id" class="form-control">
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}"
                            {{ $buku->kategori_id == $item->id ? 'selected' : '' }}>
                            {{ $item->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">Update</button>
            <a href="{{ route('buku') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

@endsection