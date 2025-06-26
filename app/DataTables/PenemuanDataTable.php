<?php

namespace App\DataTables;

use App\Models\Pengumuman;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PenemuanDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('foto_barang', fn($row) => $row->foto_barang
                ? '<img src="' . asset('storage/' . $row->foto_barang) . '" class="w-16 h-10 object-cover rounded" />'
                : '-')
            ->editColumn('waktu', fn($row) => optional($row->waktu)->format('d M Y H:i'))
            ->addColumn('tipe_barang', fn($row) => optional($row->tipeBarang)->nama ?? '-')
            ->addColumn('user', fn($row) => optional($row->user)->name ?? '-')
            ->addColumn('action', function ($row) {
                $edit = route('admin.penemuan.edit', $row->id);
                $hapus = route('admin.penemuan.destroy', $row->id);

                return '
                    <a href="' . $edit . '" class="text-blue-500 underline">Edit</a> |
                    <form action="' . $hapus . '" method="POST" class="inline-block" onsubmit="return confirm(\'Yakin?\')">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="text-red-500 underline">Hapus</button>
                    </form>';
            })
            ->editColumn('status', function ($row) {
                $selectedPublish = $row->status === 'publish' ? 'selected' : '';
                $selectedTakedown = $row->status === 'takedown' ? 'selected' : '';
                return <<<HTML
        <select class="status-select border px-1 py-0.5 rounded text-sm" data-id="{$row->id}">
            <option value="publish" {$selectedPublish}>Publish</option>
            <option value="takedown" {$selectedTakedown}>Takedown</option>
        </select>
    HTML;
            })
            ->rawColumns(['foto_barang', 'action', 'status']); // ✅ tambahkan 'status'

    }

    public function query(Pengumuman $model): QueryBuilder
    {
        return $model->penemuan()->with(['user', 'tipeBarang'])->latest();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('penemuan-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false),
            Column::make('judul')->title('Judul'),
            Column::make('foto_barang')->title('Foto'),
            Column::make('waktu')->title('Waktu'),
            Column::make('tempat')->title('Tempat'),
            Column::make('deskripsi')->title('Deskripsi'),
            Column::make('status')->title('Status'),
            Column::make('kontak')->title('Kontak'),
            Column::make('tipe_barang')->title('Tipe Barang'),
            Column::make('user')->title('Pelapor'),
            Column::computed('action')->title('Aksi')->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Penemuan_' . date('YmdHis');
    }
}
