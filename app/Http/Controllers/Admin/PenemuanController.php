<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PenemuanDataTable;
use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use App\Exports\PenemuanExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PenemuanController extends Controller
{
     public function index(PenemuanDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.penemuan.index');
    }
  public function updateStatus(Request $request, $id)
{
     if (Auth::user()->hasRole('berwenang')) {
        return response()->json([
            'message' => 'Anda tidak memiliki izin untuk mengubah status.',
        ], 403);
    }

    $request->validate([
        'status' => ['required', 'in:publish,takedown'],
    ]);
    $pengumuman = Pengumuman::penemuan()->findOrFail($id);
    $pengumuman->update(['status' => $request->status]);

    return response()->json([
        'message' => 'Status berhasil diperbarui.',
        'status' => $pengumuman->status,
    ]);
}


public function destroy($id)
{
     if (Auth::user()->hasRole('berwenang')) {
        abort(403, 'Anda tidak memiliki izin untuk menghapus data.');
    }
    $pengumuman = Pengumuman::penemuan()->findOrFail($id);
    $pengumuman->delete();

    return back()->with('success', 'Data berhasil dihapus');
}
public function exportExcel()
{
    return Excel::download(new PenemuanExport, 'penemuan.xlsx');
}

public function exportPDF()
{
    $data = Pengumuman::penemuan()->with('tipeBarang', 'user')->latest()->get();
    $pdf = Pdf::loadView('exports.penemuan-pdf', compact('data'));
    return $pdf->download('penemuan.pdf');
}

}
