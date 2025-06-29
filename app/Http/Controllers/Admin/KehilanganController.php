<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\DataTables\KehilanganDataTable;
use App\Exports\KehilanganExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class KehilanganController extends Controller
{
  public function index(KehilanganDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.kehilangan.index');
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

    $item = Pengumuman::kehilangan()->findOrFail($id);
    $item->update(['status' => $request->status]);

    return response()->json([
        'message' => 'Status berhasil diperbarui.',
        'status' => $item->status,
    ]);
}


    public function destroy($id)
    {
          if (Auth::user()->hasRole('berwenang')) {
        abort(403, 'Anda tidak memiliki izin untuk menghapus data.');
    }
        $kehilangan = Pengumuman::kehilangan()->findOrFail($id);
        $kehilangan->delete();

        return redirect()->route('admin.kehilangan.index')->with('success', 'Data kehilangan berhasil dihapus.');
    }
    public function exportExcel()
{
    return Excel::download(new KehilanganExport, 'data-kehilangan.xlsx');
}

public function exportPDF()
{
    $data = Pengumuman::kehilangan()->with(['user', 'tipeBarang'])->get();
    $pdf = Pdf::loadView('exports.kehilangan-pdf', compact('data'))->setPaper('A4', 'landscape');
    return $pdf->download('data-kehilangan.pdf');
}
}
