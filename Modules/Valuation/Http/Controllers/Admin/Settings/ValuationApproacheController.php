<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Valuation\Entities\ValuationApproache;
use Modules\Valuation\Entities\ValuationBaseModel;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Yajra\DataTables\Facades\DataTables;

class ValuationApproacheController extends ValuationAdminBaseController
{
    const viewFolderPath = 'valuation::Admin.Settings.Approach.';
    const saveUpdateDataRoute = 'valuation.admin.settings.valuationApproach.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.valuationApproach.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Settings.Approach.';

    private $listingPageRoute = 'valuation.admin.settings.valuationApproach';
    private $dataRoute = 'valuation.admin.settings.valuationApproach.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.valuationApproach.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.valuationApproach.addEditView';
    private $destroyRoute = 'valuation.admin.settings.valuationApproach.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.valuationApproach.Title';

        $this->pageIcon = 'icon-speedometer';
    }

    public function __customConstruct(&$data)
    {
        //assign routes for views
        $data['listingPageRoute'] = $this->listingPageRoute;
        $data['dataRoute'] = $this->dataRoute;
        $data['saveUpdateDataRoute'] = $this->saveUpdateDataRoute;
        $data['addEditViewRoute'] = $this->addEditViewRoute;
        $data['destroyRoute'] = $this->destroyRoute;
        $data['viewFolderPath'] = $this->viewFolderPath;
        $data['companyId'] = isset(company()->id) ? company()->id : 0;

    }

    public function index()
    {
        $this->__customConstruct($this->data);

        $feactureCategory = new ValuationApproache();

        $this->feactureCategoryCount = $feactureCategory->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $governorate = null;
        $this->title = 'valuation::valuation.valuationApproach.createCategory';
        $this->id = $id;


        if ($id > 0) {
            $category = ValuationApproache::find($id);
        }

        $this->name = $category->name ?? '';


        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationApproache::find($request->id)) {
            $category = ValuationApproache::find($request->id);
        } else {
            $category = new ValuationApproache;
        }
        $category->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $category->name = isset($request->feactureCategory) ? $request->feactureCategory : 0;
        $category->status = isset($request->status) ? $request->status : "Active";
        $category->save();

        return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $feactureCategory = ValuationApproache::find($id);

        if (empty($feactureCategory)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationApproache::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $feactureCategory = new ValuationApproache();

        $category = $feactureCategory->getAllAjaxForCompany();

        echo json_encode($category);
    }

    public function data()
    {
        $feactureCategory = new ValuationApproache();

        $categorList = $feactureCategory->getAllForCompany();

        return DataTables::of($categorList)
            ->addColumn('action', function ($row) {

                $action = '<div class="btn-group dropdown m-r-10">
                <button aria-expanded="false" data-toggle="dropdown" class="btn dropdown-toggle waves-effect waves-light" type="button"><i class="ti-more"></i></button>
                <ul role="menu" class="dropdown-menu pull-right">
                  <li><a href="' . route($this->addEditViewRoute, $row->id) . '"><i class="fa fa-pencil" aria-hidden="true"></i> ' . trans('valuation::app.edit') . '</a></li>
                  <li><a href="javascript:void(0)" id="' . $row->id . '" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> ' . trans('valuation::app.delete') . '</a></li>
                 ';

                $action .= '</ul> </div>';

                return $action;

            })
            ->addColumn('status', function ($row) {

                return $row->status;
            })
            ->editColumn(
                'name',
                function ($row) {
                    return ucfirst($row->name);
                }
            )
            ->addIndexColumn()
            ->rawColumns(array('name', 'action'))
            ->make(true);
    }

}
