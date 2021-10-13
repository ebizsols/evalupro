<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use App\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Entities\ValuationGovernorate;
use Modules\Valuation\Entities\ValuationCity;
use Modules\Valuation\Entities\ValuationPropertyWeightageCategory;

class WeightageCategoryController extends ValuationAdminBaseController
{
    const viewFolderPath = 'valuation::Admin.Settings.WeightageCategory.';
    const saveUpdateDataRoute = 'valuation.admin.settings.weightageCategory.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.weightageCategory.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Settings.WeightageCategory.';

    private $listingPageRoute = 'valuation.admin.settings.weightageCategory';
    private $dataRoute = 'valuation.admin.settings.weightageCategory.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.weightageCategory.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.weightageCategory.addEditView';
    private $destroyRoute = 'valuation.admin.settings.weightageCategory.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.weightageCategory.title';

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

        $weightageCategories = new ValuationPropertyWeightageCategory();

        $this->weightageCategoriesCount = $weightageCategories->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $this->headingTitle = 'valuation::valuation.weightageCategory.createWeightageCategory';
        $this->id = $id;

        if ($id > 0) {
            $weightageCategoryObj = new ValuationPropertyWeightageCategory();
            $weightageCategory = $weightageCategoryObj->find($id);
        }

        $this->title = isset($weightageCategory->title) ? $weightageCategory->title : '';
        $this->status = isset($weightageCategory->status) ? $weightageCategory->status : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationPropertyWeightageCategory::find($request->id)) {
            $weightageCategory = ValuationPropertyWeightageCategory::find($request->id);
        } else {
            $weightageCategory = new ValuationPropertyWeightageCategory;
        }

        $weightageCategory->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $weightageCategory->title = isset($request->title) ? $request->title : 0;
        $weightageCategory->status = isset($request->status) ? $request->status : "Active";
        $weightageCategory->save();

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

        $weightageCategory = ValuationPropertyWeightageCategory::find($id);

        if (empty($weightageCategory)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationPropertyWeightageCategory::destroy($id);

        return Reply::redirect(route($this->listingPageRoute), __('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $cityObj = new ValuationPropertyWeightageCategory();

        $cities = $cityObj->getAllAjaxForCompany();

        echo json_encode($cities);
    }

    public function data()
    {
        $weightageCategoryObj = new ValuationPropertyWeightageCategory();

        $weightageCategories = $weightageCategoryObj->getAllForCompany();

        return DataTables::of($weightageCategories)
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
                'title',
                function ($row) {
                    return ucfirst($row->title);
                }
            )
            ->addIndexColumn()
            ->rawColumns(array('title', 'action'))
            ->make(true);
    }

}
