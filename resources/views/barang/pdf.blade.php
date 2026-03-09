<style>
@page {
    size: A4;
    margin: 0;
}

body {
    margin: 0;
    padding: 0;
}

.container {
    position:  absolute;
    left: 5mm;
    top: 13mm;
    width: 200mm;
}

table {
    border-collapse: collapse;
}

td {
    width: 38.1mm;
    height: 21.2mm;
    text-align: center;
    vertical-align: middle;
    font-size: 10px;
    padding: 0;
}
</style>

<div class="container">
<table>
@for($row=0; $row<8; $row++)
<tr>
    @for($col=0; $col<5; $col++)
        @php
            $index = ($row * 5) + $col;
            $item = $grid[$index] ?? null;
        @endphp

        <td>
            @if($item)
                <b>{{ $item->nama_barang }}</b><br>
                Rp {{ number_format($item->harga) }}
            @endif
        </td>
    @endfor
</tr>
@endfor
</table>
</div>