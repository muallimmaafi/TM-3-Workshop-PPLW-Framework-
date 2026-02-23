@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title">Daftar Buku</h4>

            <a href="{{ route('buku.create') }}" class="btn btn-sm btn-primary mb-3">
                + Tambah Buku
            </a>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Judul</th>
                    <th>Pengarang</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr>
                    <td>{{ $item->kode }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->pengarang }}</td>
                    <td>{{ $item->kategori->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $item->id) }}"
                            class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('kategori.destroy', $item->id) }}"
                            method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin hapus?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection