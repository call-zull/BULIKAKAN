<?php

namespace App\DataTables;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<User> $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn() // ← untuk DT_RowIndex
            ->editColumn('created_at', function ($user) {
                return Carbon::parse($user->created_at)->format('d M Y H:i');
            })
            ->editColumn('updated_at', function ($user) {
                return Carbon::parse($user->updated_at)->format('d M Y H:i');
            })
            ->editColumn('profile_photo', function ($user) {
                return $user->profile_photo
                    ? '<img src="' . asset('storage/' . $user->profile_photo) . '" class="w-10 h-10 rounded-full object-cover" />'
                    : '-';
            })
            ->editColumn('status_user', function ($user) {
                $options = [
                    'umum'     => 'Umum',
                    'official' => 'Official',
                ];
                $html = '<select class="status-select px-2 py-1 border rounded" data-id="' . $user->id . '">';
                foreach ($options as $val => $label) {
                    $sel = $user->status_user === $val ? ' selected' : '';
                    $html .= "<option value=\"{$val}\"{$sel}>{$label}</option>";
                }
                $html .= '</select>';
                return $html;
            })
            ->addColumn('action', function ($user) {
                if (Auth::user()->hasRole('berwenang')) {
                    return '-'; // atau bisa dikosongkan saja ''
                }

            $editUrl = route('admin.users.edit', $user->id);
            $deleteUrl = route('admin.users.destroy', $user->id);
            $csrf = csrf_token();

            return <<<HTML
        <a href="{$editUrl}" class="text-blue-500 underline">Edit</a> |
        <form action="{$deleteUrl}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
            <input type="hidden" name="_token" value="{$csrf}">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="text-red-500 underline">Hapus</button>
        </form>
    HTML;
            })

            ->rawColumns(['profile_photo', 'status_user', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<User>
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('users-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')
                ->title('No')
                ->orderable(false)
                ->searchable(false)
                ->addClass('text-center'),

            Column::make('profile_photo')->title('Foto Profil'),
            Column::make('username'),
            Column::make('email'),
            Column::make('provider'),
            Column::make('status_user')->title('Status'),
            Column::make('created_at')
                ->title('Dibuat')
                ->addClass('whitespace-nowrap'),

            Column::make('updated_at')
                ->title('Diperbarui')
                ->addClass('whitespace-nowrap'),

            Column::computed('action')
                ->title('Aksi')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),

        ];
    }



    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
