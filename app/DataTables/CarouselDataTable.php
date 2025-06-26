<?php

namespace App\DataTables;

use App\Models\Carousel;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class CarouselDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->editColumn('foto', function ($row) {
                return '<img src="'.asset('storage/'.$row->foto).'" class="w-20 h-12 object-cover rounded" />';
            })
            ->editColumn('is_published', function ($row) {
                return $row->is_published ? 'Ya' : 'Tidak';
            })
            ->addColumn('action', function ($row) {
                return view('pages.admin.carousel.action', compact('row'))->render();
            })
            ->rawColumns(['foto', 'action']);
    }

    public function query(Carousel $model): QueryBuilder
    {
        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('carousel-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->buttons([
                Button::make('create'),
                Button::make('export'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    protected function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->orderable(false)->searchable(false),
            Column::make('name')->title('Nama'),
            Column::make('foto')->title('Foto'),
            Column::make('link')->title('Link'),
            Column::make('is_published')->title('Tayang'),
            Column::computed('action')->title('Aksi')->exportable(false)->printable(false)->addClass('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'Carousel_' . date('YmdHis');
    }
}
