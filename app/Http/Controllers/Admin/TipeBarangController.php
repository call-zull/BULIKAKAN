<?php

namespace App\Http\Controllers\Admin;

use App\Models\TipeBarang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\TipeBarangDataTable;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\TipeBarangExport;
use Maatwebsite\Excel\Facades\Excel;

class TipeBarangController extends Controller
{
    public function index(TipeBarangDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.tipe-barang.index');
    }

    public function destroy($id)
    {
        $tipe = TipeBarang::findOrFail($id);
        $tipe->delete();

        return redirect()->route('admin.tipe-barang.index')->with('success', 'Tipe Barang berhasil dihapus.');
    }
    public function create()
{
    return view('pages.admin.tipe-barang.create');
}

public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:100',
    ]);

    TipeBarang::create(['nama' => $request->nama]);

    return redirect()->route('admin.tipe-barang.index')->with('success', 'Tipe Barang berhasil ditambahkan.');
}

public function edit($id)
{
    $tipe = TipeBarang::findOrFail($id);
    return view('pages.admin.tipe-barang.edit', compact('tipe'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:100',
    ]);

    $tipe = TipeBarang::findOrFail($id);
    $tipe->update(['nama' => $request->nama]);

    return redirect()->route('admin.tipe-barang.index')->with('success', 'Tipe Barang berhasil diperbarui.');
}
    public function exportPdf()
{
    $data = TipeBarang::latest()->get();

    $pdf = Pdf::loadView('exports.tipe-barang-pdf', compact('data'))->setPaper('a4', 'portrait');

    return $pdf->download('jenis-barang-' . now()->format('Ymd_His') . '.pdf');
}
public function exportExcel()
{
    return Excel::download(new TipeBarangExport, 'tipe-barang.xlsx');
}
}
