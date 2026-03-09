@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4 class="card-title mb-4">Input Barang (DataTables)</h4>

        <form id="formBarang">

            <div class="row">

                <div class="col-md-5">
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" id="nama_barang" class="form-control" placeholder="Masukkan nama barang" required>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <input type="number" id="harga_barang" class="form-control" placeholder="Masukkan harga barang" required>
                    </div>
                </div>

                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        Tambah
                    </button>
                </div>

            </div>

        </form>

        <hr>

        <table id="tableBarang" class="table table-bordered">
            <thead>
                <tr>
                    <th width="10%">ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <!-- Modal Edit / Delete -->
        <div class="modal fade" id="modalBarang" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Barang</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>ID Barang</label>
                            <input type="text" id="edit_id" class="form-control" readonly>
                        </div>

                        <div class="mb-3">
                            <label>Nama Barang</label>
                            <input type="text" id="edit_nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Harga Barang</label>
                            <input type="number" id="edit_harga" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button class="btn btn-danger" id="btnHapus">
                            Hapus
                        </button>

                        <button class="btn btn-primary" id="btnUpdate">
                            Ubah
                        </button>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection


@push('style-page')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<style>
    #tableBarang tbody tr {
        cursor: pointer;
    }
</style>

@endpush


@push('js-page')

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {

        let id = 1;
        let selectedRow;
        let modal = new bootstrap.Modal(document.getElementById('modalBarang'));

        let table = $('#tableBarang').DataTable();


        // TAMBAH DATA
        $('#formBarang').submit(function(e) {

            e.preventDefault();

            let nama = $('#nama_barang').val();
            let harga = $('#harga_barang').val();

            if (nama == "" || harga == "") {
                alert("Nama barang dan harga wajib diisi!");
                return;
            }

            table.row.add([
                id++,
                nama,
                harga
            ]).draw(false);

            $('#nama_barang').val('');
            $('#harga_barang').val('');

        });


        // KLIK ROW → BUKA MODAL
        $('#tableBarang tbody').on('click', 'tr', function() {

            selectedRow = table.row(this);

            let data = selectedRow.data();

            $('#edit_id').val(data[0]);
            $('#edit_nama').val(data[1]);
            $('#edit_harga').val(data[2]);

            let modal = new bootstrap.Modal(document.getElementById('modalBarang'));
            modal.show();

        });


        // UPDATE DATA
        $('#btnUpdate').click(function() {

            let id = $('#edit_id').val();
            let nama = $('#edit_nama').val();
            let harga = $('#edit_harga').val();

            if (nama == "" || harga == "") {
                alert("Nama dan harga harus diisi!");
                return;
            }

            selectedRow.data([
                id,
                nama,
                harga
            ]).draw();

            modal.hide();

        });


        // HAPUS DATA
        $('#btnHapus').click(function() {

            if (confirm("Yakin ingin menghapus data ini?")) {

                selectedRow.remove().draw();

                $('#modalBarang').modal('hide');

            }

        });

    });
</script>
@endpush