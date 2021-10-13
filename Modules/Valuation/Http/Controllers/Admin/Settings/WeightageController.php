<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Entities\ValuationPropertyWeightageCategory;
use Modules\Valuation\Entities\ValuationPropertyWeightage;

class WeightageController extends ValuationAdminBaseController
{
    const viewFolderPath = 'valuation::Admin.Settings.Weightage.';
    const saveUpdateDataRoute = 'valuation.admin.settings.weightage.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.block.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Settings.Weightage.';

    private $listingPageRoute = 'valuation.admin.settings.weightage';
    private $dataRoute = 'valuation.admin.settings.weightage.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.weightage.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.weightage.addEditView';
    private $destroyRoute = 'valuation.admin.settings.weightage.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.propertyWeightage.title';

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

        $weightage = new ValuationPropertyWeightage();

        $this->weightageCount = $weightage->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $this->headingTitle = 'valuation::valuation.propertyWeightage.createWeightage';
        $this->id = $id;
        $categoryObj = new ValuationPropertyWeightageCategory();
        $this->categories = $categoryObj->getAllForCompany();
        if ($id > 0) {
            $weightageObj = new ValuationPropertyWeightage;
            $weightage = $weightageObj->find($id);
            $this->id = $id;
        }

        $this->title = isset($weightage->title) ? $weightage->title : '';
        $this->value = isset($weightage->value) ? $weightage->value : '';
        $this->categoryId = isset($weightage->category_id) ? $weightage->category_id : '';
        $this->status = isset($weightage->stauts) ? $weightage->stauts : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationPropertyWeightage::find($request->id)) {
            $weightages = ValuationPropertyWeightage::find($request->id);
        } else {
            $weightages = new ValuationPropertyWeightage;
        }
        $weightages->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $weightages->title = isset($request->title) ? $request->title : '';
        $weightages->value = isset($request->value) ? $request->value : '';
        $weightages->category_id = isset($request->category) ? $request->category : '';
        $weightages->status =  isset($request->status) ? $request->status : "Active";

        $weightages->save();
        $weightageId = $weightages->id;
        if ($weightageId) {
            return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
        } else if ($request->id) {
            return Reply::redirect(route($this->listingPageRoute), __('Updated Success'));
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

        $weightage = ValuationPropertyWeightage::find($id);

        if (empty($weightage)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationPropertyWeightage::destroy($id);

        return Reply::redirect(route($this->listingPageRoute), __('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $weightageObj = new ValuationPropertyWeightage();

        $fetureList = $weightageObj->getAllAjaxForCompany();

        echo json_encode($fetureList);
    }

    public function data()
    {
        $weightageObj = new ValuationPropertyWeightage();
        $weightageList = $weightageObj->getAllForCompany();

        return DataTables::of($weightageList)
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
            ->editColumn(
                'category',
                function ($row) {
                    return ucfirst(isset($row->weightageCategory->title) ? $row->weightageCategory->title : 'Category not found');
                }
            )
            ->addIndexColumn()
            ->rawColumns(array('title', 'action'))
            ->make(true);
    }

}
