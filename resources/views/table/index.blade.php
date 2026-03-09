@extends('layouts.master')

@section('content')

<div class="card">
    <div class="card-body">

        <h4>Input Barang</h4>

        <form id="formBarang">
            <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" id="nama_barang" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Harga Barang</label>
                <input type="number" id="harga_barang" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary mt-2">Tambah</button>
        </form>

        <hr>

        <table id="tableBarang" class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Barang</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <!-- MODAL -->

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
<style>
    #tableBarang tbody tr {
        cursor: pointer;
    }
</style>
@endpush

@push('js-page')
<script>
    $(document).ready(function() {

        let idCounter = 1
        let selectedRow = null

        let modal = new bootstrap.Modal(document.getElementById('modalBarang'))


        // TAMBAH DATA
        $('#formBarang').submit(function(e) {

            e.preventDefault()

            let nama = $('#nama_barang').val()
            let harga = $('#harga_barang').val()

            let row = `
<tr>
<td>${idCounter++}</td>
<td>${nama}</td>
<td>${harga}</td>
</tr>
`

            $('table tbody').append(row)

            $('#nama_barang').val('')
            $('#harga_barang').val('')

        })


        // CLICK ROW
        $('table tbody').on('click', 'tr', function() {

            selectedRow = $(this)

            let id = $(this).find('td').eq(0).text()
            let nama = $(this).find('td').eq(1).text()
            let harga = $(this).find('td').eq(2).text()

            $('#edit_id').val(id)
            $('#edit_nama').val(nama)
            $('#edit_harga').val(harga)

            modal.show()

        })


        // UPDATE
        $('#btnUpdate').click(function() {

            let nama = $('#edit_nama').val()
            let harga = $('#edit_harga').val()

            if (nama == "" || harga == "") {
                alert("Nama dan harga wajib diisi")
                return
            }

            selectedRow.find('td').eq(1).text(nama)
            selectedRow.find('td').eq(2).text(harga)

            modal.hide()

        })


        // DELETE
        $('#btnHapus').click(function() {

            if (confirm("Yakin ingin menghapus?")) {

                selectedRow.remove()

                modal.hide()

            }

        })

    })
</script>
@endpush