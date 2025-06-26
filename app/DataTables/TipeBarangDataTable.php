<?php

namespace App\DataTables;

use App\Models\TipeBarang;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TipeBarangDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $hapus = route('admin.tipe-barang.destroy', $row->id);
                return '
                    <form action="' . $hapus . '" method="POST" class="inline-block" onsubmit="return confirm(\'Yakin?\')">
                        ' . csrf_field() . method_field('DELETE') . '
                        <button type="submit" class="text-red-500 underline">Hapus</button>
                    </form>';
            })
            ->addColumn('action', function ($row) {
                $edit = route('admin.tipe-barang.edit', $row->id);
                $hapus = route('admin.tipe-barang.destroy', $row->id);
                return '
        <a href="' . $edit . '" class="text-blue-500 underline mr-2">Edit</a>
        <form action="' . $hapus . '" method="POST" class="inline-block" onsubmit="return confirm(\'Yakin?\')">
            ' . csrf_field() . method_field('DELETE') . '
            <button type="submit" class="text-red-500 underline">Hapus</button>
        </form>';
            })

            ->editColumn('created_at', fn($row) => $row->created_at->format('d M Y H:i'))
            ->rawColumns(['action']);
    }

    public function query(TipeBarang $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('tipe-barang-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1);
    }

    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false),
            Column::make('nama')->title('Nama Tipe'),
            Column::make('created_at')->title('Dibuat Pada'),
            Column::computed('action')->title('Aksi')->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'TipeBarang_' . date('YmdHis');
    }
}
