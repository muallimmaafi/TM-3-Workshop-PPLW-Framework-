@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="card-title">Daftar Barang</h4>

            <a href="{{ route('barang.create') }}" class="btn btn-sm btn-primary mb-3">
                + Tambah Barang
            </a>
        </div>

        <form action="{{ route('barang.cetak') }}" method="POST" target="_blank">
        
            @csrf

        <input type="hidden" name="selected_barang" id="selected_barang">

            <div class="row mb-3">

                <div class="col-md-2">
                    <label>Posisi X</label>
                    <input type="number" name="start_x" class="form-control" min="1" max="5" required>
                </div>

                <div class="col-md-2">
                    <label>Posisi Y</label>
                    <input type="number" name="start_y" class="form-control" min="1" max="8" required>
                </div>

                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" onclick="submitCetak()" class="btn btn-success">
                        Cetak Label
                    </button>
                </div>

            </div>

            <table id="tableBarang" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Pilih</th>
                        <th>ID Barang</th>
                        <th>Nama Barang</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
            </table>

    </div>
</div>

@endsection

@push('js-page')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {

        $('#tableBarang').DataTable({
            ajax: "{{ route('barang.data') }}",
            columns: [{
                    data: 'id_barang',
                    render: function(data) {
                        return `<input type="checkbox" name="barang[]" value="${data}">`;
                    }
                },
                {
                    data: 'id_barang'
                },
                {
                    data: 'nama_barang'
                },
                {
                    data: 'harga',
                    render: function(data) {
                        return 'Rp ' + Number(data).toLocaleString();
                    }
                },
                {
                    data: 'id_barang',
                    render: function(data) {
                        return `
                    <a href="/barang/edit/${data}" class="btn btn-warning btn-sm">Edit</a>
                    <button onclick="hapus('${data}')" class="btn btn-danger btn-sm">Hapus</button>
                `;
                    }
                }
            ]
        });

    });

    function hapus(id) {
        if (confirm('Yakin hapus?')) {
            $.ajax({
                url: '/barang/delete/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function() {
                    $('#tableBarang').DataTable().ajax.reload();
                }
            });
        }
    }

    function submitCetak() {

        let selected = [];

        $('input[name="barang[]"]:checked').each(function() {
            selected.push($(this).val());
        });

        if (selected.length == 0) {
            alert('Pilih barang dulu!');
            return;
        }

        $('#selected_barang').val(selected.join(','));
        $('form').submit();
    }
</script>

@endpush