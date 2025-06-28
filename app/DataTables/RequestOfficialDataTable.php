<?php

namespace App\DataTables;

use App\Models\RequestOfficial;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class RequestOfficialDataTable extends DataTable
{
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('user', fn($row) => $row->user->username ?? '-')
            ->addColumn('dokumen_pendukung', fn($row) => '<a href="' . asset('storage/' . $row->dokumen_pendukung) . '" target="_blank" class="text-biruPrimary underline">Lihat</a>')
            ->addColumn('status_request', function ($row) {
                return <<<HTML
        <select class="status-select border rounded text-sm py-1 px-2" data-id="{$row->id}">
            <option value="diproses" {$this->selected($row, 'diproses')}>Diproses</option>
            <option value="diterima" {$this->selected($row, 'diterima')}>Disetujui</option>
            <option value="ditolak" {$this->selected($row, 'ditolak')}>Ditolak</option>
        </select>
    HTML;
            })

            ->addColumn('action', function ($row) {
                $route = route('admin.request-official.index'); // reload
                return <<<HTML
                    <form action="{$route}/{$row->id}" method="POST" onsubmit="return confirm('Yakin hapus?')" style="display:inline-block;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{$this->csrfToken()}">
                        <button type="submit" class="text-red-500 underline">Hapus</button>
                    </form>
                HTML;
            })
            ->rawColumns(['dokumen_pendukung', 'status_request', 'action']);
    }

    public function query(RequestOfficial $model)
    {
        return $model->with('user')->latest();
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->setTableId('requestofficial-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false),
            Column::make('user')->title('User'),
            Column::make('nama_instansi')->title('Instansi'),
            Column::make('alasan')->title('Alasan'),
            Column::make('dokumen_pendukung')->title('Dokumen'),
            Column::make('status_request')->title('Status'),
            Column::computed('action')->title('Aksi')->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'RequestOfficial_' . date('YmdHis');
    }

    private function selected($row, $value)
    {
        return $row->status_request === $value ? 'selected' : '';
    }

    private function csrfToken()
    {
        return csrf_token();
    }
}
