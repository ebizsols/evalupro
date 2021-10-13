<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use Modules\Valuation\Entities\ValuationApproache;
use Modules\Valuation\Entities\ValuationMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Modules\Valuation\Entities\ValuationBaseModel;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Yajra\DataTables\Facades\DataTables;

class ValuationMethodController extends ValuationAdminBaseController
{

    const viewFolderPath = 'valuation::Admin.Settings.Method.';
    const saveUpdateDataRoute = 'valuation.admin.settings.valuationMethod.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.valuationMethod.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Settings.Method.';

    private $listingPageRoute = 'valuation.admin.settings.valuationMethod';
    private $dataRoute = 'valuation.admin.settings.valuationMethod.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.valuationMethod.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.valuationMethod.addEditView';
    private $destroyRoute = 'valuation.admin.settings.valuationMethod.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.valuationMethod.Title';

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

        $feture = new ValuationMethod();

        $this->fetureCount = $feture->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $governorate = null;
        $this->title = 'valuation::valuation.valuationMethod.createFeature';
        $this->id = $id;
        $categoryObj = new ValuationApproache();
        $this->category = $categoryObj->getAllForCompany();
        if ($id > 0) {
            $featureObj = new ValuationMethod;
            $features = $featureObj->find($id);
            $this->id = $id;
        }

        $this->name = $features->name ?? '';
        $this->company_id = $features->company_id ?? '';
        $this->category_id = $features->category_id ?? '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationMethod::find($request->id)) {
            $features = ValuationMethod::find($request->id);
        } else {
            $features = new ValuationMethod;
        }
        $features->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $features->name = isset($request->featureName) ? $request->featureName : '';
        $features->category_id = isset($request->feactureCategory) ? $request->feactureCategory : '';
        $features->status = isset($request->status) ? $request->status : "Active";
        $features->save();
        $featureId = $features->id;
        if ($featureId) {
            return Reply::redirect(route($this->addEditViewRoute, $featureId), __('Save Success'));
        } else if ($request->id) {
            return Reply::redirect(route($this->addEditViewRoute, $request->id), __('Updated Success'));
        } else {
            return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $feature = ValuationMethod::find($id);

        if (empty($feature)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationMethod::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $featureObj = new ValuationMethod();

        $fetureList = $featureObj->getAllAjaxForCompany();

        echo json_encode($fetureList);
    }

    public function data()
    {
        $featureObj = new ValuationMethod();
        $featureList = $featureObj->getAllForCompany();

        return DataTables::of($featureList)
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
            ->editColumn(
                'name',
                function ($row) {
                    return ucfirst($row->name);
                }
            )
            ->editColumn(
                'category',
                function ($row) {
                    return ucfirst($row->featureCategory->name ?? 'Category not found');
                }
            )
            ->addIndexColumn()
            ->rawColumns(array('name', 'action'))
            ->make(true);
    }

}
