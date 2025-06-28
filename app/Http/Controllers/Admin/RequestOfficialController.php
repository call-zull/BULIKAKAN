<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\RequestOfficialDataTable;
use App\Http\Controllers\Controller;
use App\Models\RequestOfficial;
use Illuminate\Http\Request;

class RequestOfficialController extends Controller
{
    public function index(RequestOfficialDataTable $dataTable)
    {
        return $dataTable->render('pages.admin.request-official.index');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status_request' => 'required|in:diproses,diterima,ditolak',
        ]);

        $requestOfficial = RequestOfficial::findOrFail($id);
        $requestOfficial->update(['status_request' => $request->status_request]);

        return response()->json(['message' => 'Status berhasil diperbarui.']);
    }

    public function destroy($id)
    {
        $item = RequestOfficial::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
