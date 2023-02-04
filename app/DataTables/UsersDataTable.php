<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
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
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('edit', 'Admin.btns.edit')
            ->addColumn('checkbox', 'Admin.btns.checkbox')
            ->addColumn('delete', 'Admin.btns.delete')
            ->addColumn('status', 'Admin.btns.status')
            ->addColumn('FullName', function(User $user) {
                return $user->full_name;
            })
            ->rawColumns(['edit','delete','FullName','checkbox','status'])
            ->editcolumn('created_at',function(User $user){
                return $user->created_at->format('m/d/Y') ;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        // return $model->newQuery();
        return User::query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        'dom'          => 'Blfrtip',
                        "lengthMenu" =>  [[5, 10, 20, -1], [5, 10, 20, "Allrecord"]],
                        'buttons'      => [
                        ['extend' => 'export','className' => 'btn btn-success'],
                         ['extend' => 'print' , 'className' => "btn btn-primary" ],
                         ['extend' => 'reset' , 'className' => "btn btn-danger" ],
                         ['extend' => 'reload' , 'className' => "btn btn-info" ],
                         'colvis',
                         [
                             'text' => '<i class="bi bi-trash">deleteall</i>', 'className' => 'btn btn-danger delBtn'],
                             ['text' => '<i class="bi bi-plus">Add user</i>', 'className' => 'btn btn-info',
                             "action" => "function(){
                                window.location.href = 'user_create'
                             }"
                            ],
                        ],

                        'initComplete' => " function () {
                            this.api().columns([2,3,4,5,6]).every(function () {
                                var column = this;
                                var input = document.createElement(\"input\");
                                $(input).appendTo($(column.footer()).empty())
                                .on('keyup', function () {
                                    column.search($(this).val(), false, false, true).draw();
                                });
                            });
                        }",
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            [
                "name" =>"checkbox",
                "data" => "checkbox",
                "title" => '<input type="checkbox" class = "checkbox_all" onclick = "check_all()"> ',
                'exportable' => false,
				'printable'  => false,
				'orderable'  => false,
				'searchable' => false,
            ],
            Column::make('id'),
            Column::computed('FullName'),
            Column::make('email'),
            Column::make('age'),
            Column::make('country'),
            Column::make('gender'),
            Column::make('phone')->width(5),
            Column::make('created_at'),
            // Column::make('updated_at'),
            Column::computed('edit')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::computed('delete')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
            Column::computed('status')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
