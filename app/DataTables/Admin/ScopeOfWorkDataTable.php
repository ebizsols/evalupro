<?php

namespace App\DataTables\Admin;

use App\ClientDetails;
use App\DataTables\BaseDataTable;
use App\Estimate;
use App\ScopeOfWork;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;

class ScopeOfWorkDataTable extends BaseDataTable
{
    protected $firstScopeOfWork;
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {

        $firstScopeOfWork = $this->firstScopeOfWork;
        return datatables()
            ->eloquent($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($firstScopeOfWork) {
                $action = '<div class="btn-group dropdown m-r-10">
                 <button aria-expanded="false" data-toggle="dropdown" class="btn btn-default dropdown-toggle waves-effect waves-light" type="button"><i class="fa fa-gears "></i></button>
                <ul role="menu" class="dropdown-menu">';
                if ($row->status != 'draft') {
                    $action .= '<li><a href="' . route("admin.scopeOfWork.download", $row->id) . '" ><i class="fa fa-download"></i> ' . __('app.download') . '</a></li>';
                }
                $action .= '<li><a href="' . route("front.scopeOfWork.show", md5($row->id)) . '" target="_blank"><i class="fa fa-eye"></i> ' . __('app.view') . '</a></li>';

                //$action .= '<li><a href="javascript:;" data-toggle="tooltip"  data-estimate-id="' . $row->id . '" class="sendButton"><i class="fa fa-send"></i> ' . __('app.send') . '</a></li>';

                if ($row->status == 'waiting' || $row->status == 'draft') {
                    //$action .= '<li><a href="' . route("admin.scopeOfWork.edit", $row->id) . '" ><i class="fa fa-pencil"></i> ' . __('app.edit') . '</a></li>';
                }
                 if ($firstScopeOfWork->id == $row->id) {
                    $action .= '<li><a class="sa-params-sow" href="javascript:;" data-estimate-id="' . $row->id . '"><i class="fa fa-times"></i> ' . __('app.delete') . '</a></li>';
                 }
                if ($row->status == 'waiting') {
//                    $action .= '<li><a href="' . route("admin.all-invoices.convert-estimate", $row->id) . '" ><i class="ti-receipt"></i> ' . __('app.create') . ' ' . __('app.invoice') . '</a></li>';

                    //$action .= '<li><a href="javascript:;" class="change-status" data-estimate-id="' . $row->id . '" ><i class="ti-times"></i> ' . __('app.cancelEstimate') . '</a></li>';
                }
                //$action .= '<li><a href="' . route("admin.scopeOfWork.duplicate-estimate", $row->id) . '" ><i class="ti-files"></i> ' . __('app.create') . ' ' . __('app.duplicate') . '</a></li>';

                $action .= '</ul>
              </div>
              ';
                return $action;
            })
            ->addColumn('original_estimate_number', function ($row) {
                return '<a href="' . route("front.scopeOfWork.show", md5($row->id)) . '" target="_blank">' . $row->original_estimate_number . '</a>';
            })

            ->editColumn('name', function ($row) {

                if ($row->client_id != '') {
                    $client = ClientDetails::where('user_id', $row->client_id)->first();

                    if ($client) {
                        return  ucwords($client->name);
                    }

                    return '--';
                }
                else if ( $row->client) {
                    return  ucwords($row->client->name);
                }

                return '--';
            })
            ->editColumn('status', function ($row) {
                $status = '';
                if ($row->status == 'waiting') {
                    $status .= '<label class="label label-warning">' . strtoupper($row->status) . '</label>';
                } else if ($row->status == 'draft') {
                    $status .= '<label class="label label-primary">' . strtoupper($row->status) . '</label>';
                }else if ($row->status == 'canceled') {
                    $status .= '<label class="label label-info">' . strtoupper($row->status) . '</label>';
                } else if ($row->status == 'declined') {
                    $status .= '<label class="label label-danger">' . strtoupper($row->status) . '</label>';
                } else {
                    $status .= '<label class="label label-success">' . strtoupper($row->status) . '</label>';
                }

                if (!$row->send_status && $row->status != 'draft' && $row->status != 'canceled') {
                    $status .= '<br><br><label class="label label-inverse">' . strtoupper(__('modules.invoices.notSent')) . '</label>';
                }
                return $status;
            })
            ->editColumn('total', function ($row) {
                return currency_position($row->total, $row->currency_symbol);
            })
            ->editColumn(
                'valid_till',
                function ($row) {
                    return Carbon::parse($row->valid_till)->format($this->global->date_format);
                }
            )
            ->rawColumns(['name', 'action', 'status', 'original_estimate_number'])
            ->removeColumn('currency_symbol')
            ->removeColumn('client_id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ScopeOfWork $model)
    {
        $request = $this->request();


        $this->firstScopeOfWork = ScopeOfWork::latest()->first();
     /*   $model = $model->join('client_details', 'scope_of_works.client_id', '=', 'client_details.user_id')
            ->join('currencies', 'currencies.id', '=', 'scope_of_works.currency_id')
            ->join('users', 'users.id', '=', 'scope_of_works.client_id')
//            ->leftJoin('client_details', 'client_details.user_id', '=', 'users.id')
            ->select('scope_of_works.id', 'scope_of_works.client_id', 'users.name', 'scope_of_works.total', 'currencies.currency_symbol', 'scope_of_works.status', 'scope_of_works.valid_till', 'scope_of_works.estimate_number', 'scope_of_works.send_status');*/

        $model = $model
            ->select('scope_of_works.id', 'scope_of_works.client_id', 'scope_of_works.total',  'scope_of_works.status', 'scope_of_works.valid_till', 'scope_of_works.estimate_number', 'scope_of_works.send_status')
            ->where('scope_of_works.project_id', '=', $this->projectId);


        //echo "<pre>"; print_r($model); die;
        //dd($model);
        if ($request->startDate !== null && $request->startDate != 'null' && $request->startDate != '') {
            $startDate = Carbon::createFromFormat($this->global->date_format, $request->startDate)->toDateString();
            $model = $model->where(DB::raw('DATE(scope_of_works.`valid_till`)'), '>=', $startDate);
        }

        if ($request->endDate !== null && $request->endDate != 'null' && $request->endDate != '') {
            $endDate = Carbon::createFromFormat($this->global->date_format, $request->endDate)->toDateString();
            $model = $model->where(DB::raw('DATE(scope_of_works.`valid_till`)'), '<=', $endDate);
        }

        if ($request->status != 'all' && !is_null($request->status)) {
            $model = $model->where('scope_of_works.status', '=', $request->status);
        }

        return $model->orderBy('scope_of_works.id', 'desc')->groupBy('scope_of_works.id');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('scope_of_works-table')
            ->columns($this->processTitle($this->getColumns()))
            ->minifiedAjax()
            ->dom("<'row'<'col-md-6'l><'col-md-6'Bf>><'row'<'col-sm-12'tr>><'row'<'col-sm-5'i><'col-sm-7'p>>")
            ->orderBy(0)
            ->destroy(true)
            ->responsive(true)
            ->serverSide(true)
            ->stateSave(true)
            ->processing(true)
            ->language(__("app.datatable"))
            ->buttons(
                Button::make(['extend' => 'export', 'buttons' => ['excel', 'csv'], 'text' => '<i class="fa fa-download"></i> ' . trans('app.exportExcel') . '&nbsp;<span class="caret"></span>'])
            )
            ->parameters([
                'initComplete' => 'function () {
                   window.LaravelDataTables["scope_of_works-table"].buttons().container()
                    .appendTo( ".bg-title .text-right")
                }',
                'fnDrawCallback' => 'function( oSettings ) {
                    $("body").tooltip({
                        selector: \'[data-toggle="tooltip"]\'
                    })
                }',
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            __('app.id') => ['data' => 'id', 'name' => 'id', 'visible' => false],
            '#' => ['data' => 'DT_RowIndex', 'orderable' => false, 'searchable' => false],
            __('app.scopeOfWork') . '#' => ['data' => 'original_estimate_number', 'name' => 'original_estimate_number'],
            __('Valid Till') => ['data' => 'valid_till', 'name' => 'valid_till'],
            __('app.status') => ['data' => 'status', 'name' => 'status'],
            Column::computed('action', __('app.action'))
                ->exportable(false)
                ->printable(false)
                ->orderable(false)
                ->searchable(false)
                ->width(150)
                ->addClass('text-center')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'scope_of_works_' . date('YmdHis');
    }

    public function pdf()
    {
        set_time_limit(0);
        if ('snappy' == config('datatables-buttons.pdf_generator', 'snappy')) {
            return $this->snappyPdf();
        }

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('datatables::print', ['data' => $this->getDataForPrint()]);

        return $pdf->download($this->getFilename() . '.pdf');
    }
}
