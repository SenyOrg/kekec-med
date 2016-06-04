<?php

namespace App\DataTables;

use App\Patient;
use App\User;
use Yajra\Datatables\Services\DataTable;

/**
 * Class PatientTable
 * -----------------------------
 * 
 * -----------------------------
 * @package App\DataTables
 * @author Selcuk Kekec <senycorp@googlemail.com>
 */
class PatientTable extends DataTable
{
    // protected $printPreview  = 'path.to.print.preview.view';

    /**
     * Display ajax response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            /**
             * <tr id={}>
             */
            ->setRowId(function($model) {return $model->id;})
            /**
             * <tr arrayKey=arrayValue
             */
            ->setRowAttr(['data-id' => ''])
            /*->setRowClass(function($model) {
                if ($model->id == 1) return 'bg-blue';

                return 'bg-yellow';
            })*/
            ->with('index','test')
            ->addColumn('action', function ($model) {
                return '<a href="'.route('patient.show', ['id' => $model->id]).'">Show</a>';
            })
            ->addColumn('image', function($model) {
                return '<img src="'.$model->getImageUrl().'" width="50" height="width"/>';
            })
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $patients = Patient::query();

        return $this->applyScopes($patients);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->addColumn([
                        'defaultContent' => 'No',
                        'data'           => 'image',
                        'name'           => 'Image',
                        'title'          => '',
                        'render'         => null,
                        'orderable'      => false,
                        'searchable'     => false,
                        'exportable'     => false,
                        'printable'      => true,
                        'footer'         => '',
                        'style'          => ''
                    ])
                    ->columns($this->getColumns())
                    ->ajax('')
                    ->addAction(['width' => '80px'])
                    ->parameters($this->getBuilderParameters());
    }
    
    public function getBuilderParameters()
    {
        return array_merge(parent::getBuilderParameters(), [
            'order'   => [[1, 'asc']],
            'responsive' => true,
            'dom' => "<'box'<'box-header with-border'<'box-title'l><'box-tools'fr>><'box-body no-padding't><'box-footer clearfix'p>>'",
            'language' => [
                'paginate' => [
                    'next' => '&raquo;',
                    'previous' => '&laquo;'
                ]
            ]
        ]); // TODO: Change the autogenerated stub
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'id',
            'firstname',
            'lastname',
            'street',
            'phone',
            'mobile',
            'email',
            'created_at',
            'updated_at',
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'patients';
    }
}
