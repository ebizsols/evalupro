<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Entities\ValuationPropertyFeatureCategory;

class FeatureCategoryController extends ValuationAdminBaseController
{
    const viewFolderPath = 'valuation::Admin.Settings.FeatureCategory.';
    const saveUpdateDataRoute = 'valuation.admin.settings.category.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.category.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Settings.FeatureCategory.';

    private $listingPageRoute = 'valuation.admin.settings.category';
    private $dataRoute = 'valuation.admin.settings.category.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.category.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.category.addEditView';
    private $destroyRoute = 'valuation.admin.settings.category.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.propertyFeatureCategory.Title';

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
        $data['companyId'] = isset(company()->id)?company()->id:0;

    }

    public function index()
    {
        $this->__customConstruct($this->data);

        $feactureCategory = new ValuationPropertyFeatureCategory();

        $this->feactureCategoryCount = $feactureCategory->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $governorate = null;
        $this->title = 'valuation::valuation.propertyFeatureCategory.createCategory';
        $this->id = $id;


        if ($id > 0) {
            $category = ValuationPropertyFeatureCategory::find($id);
        }

        $this->category_name = isset($category->category_name) ? $category->category_name : '';


        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationPropertyFeatureCategory::find($request->id)) {
            $category = ValuationPropertyFeatureCategory::find($request->id);
        } else {
            $category = new ValuationPropertyFeatureCategory;
        }
        $category->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $category->category_name = isset($request->feactureCategory) ? $request->feactureCategory : 0;
        $category->save();

        return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $feactureCategory = ValuationPropertyFeatureCategory::find($id);

        if (empty($feactureCategory)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationPropertyFeatureCategory::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $feactureCategory = new ValuationPropertyFeatureCategory();

        $category = $feactureCategory->getAllAjaxForCompany();

        echo  json_encode($category);
    }

    public function data()
    {
        $feactureCategory = new ValuationPropertyFeatureCategory();

        $categorList = $feactureCategory->getAllForCompany();

        return DataTables::of($categorList)
            ->addColumn('action', function ($row) {

                $action = '<div class="btn-group dropdown m-r-10">
                <button aria-expanded="false" data-toggle="dropdown" class="btn dropdown-toggle waves-effect waves-light" type="button"><i class="ti-more"></i></button>
                <ul role="menu" class="dropdown-menu pull-right">
                  <li><a href="' . route($this->addEditViewRoute, $row->id) . '"><i class="fa fa-pencil" aria-hidden="true"></i> ' . trans('valuation::app.edit') . '</a></li>
                  <li><a href="javascript:void(0)" id="'.$row->id.'" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> ' . trans('valuation::app.delete') . '</a></li>
                 ';

                $action .= '</ul> </div>';

                return $action;

            })
            
            ->editColumn(
                'name',
                function ($row) {
                    return ucfirst($row->category_name);
                }
            )
            ->addIndexColumn()
            ->rawColumns(array('name', 'action'))
            ->make(true);
    }

}
