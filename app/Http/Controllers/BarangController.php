<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    public function index()
    {
        return view('barang.index');
    }

    public function data()
    {
        $barang = Barang::all();

        return response()->json([
            'data' => $barang
        ]);
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        Barang::create([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga
        ]);

        return redirect()->route('barang.index');
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $barang->update([
            'nama_barang' => $request->nama_barang,
            'harga' => $request->harga
        ]);

        return redirect()->route('barang.index');
    }

    public function destroy($id)
    {
        Barang::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    public function cetak(Request $request)
    {        
        $selected = explode(',', $request->selected_barang);
        
        if (!$selected) {
            return back()->with('error', 'Pilih minimal 1 barang');
        }

        $barang = Barang::whereIn('id_barang', $selected)->get();

        $startX = $request->start_x;
        $startY = $request->start_y;

        // Hitung posisi mulai
        $startIndex = (($startY - 1) * 5) + $startX;

        // Grid kosong 40 slot
        $grid = array_fill(0, 40, null);

        $i = $startIndex - 1;

        foreach ($barang as $b) {
            if ($i < 40) {
                $grid[$i] = $b;
                $i++;
            }
        }
        
        $pdf = Pdf::loadView('barang.pdf', compact('grid'));

        return $pdf->stream('label.pdf');
    }
}
