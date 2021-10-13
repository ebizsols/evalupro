<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Entities\ValuationPropertyFeatureCategory;
use Modules\Valuation\Entities\ValuationPropertyFeature;
class FeatureController extends ValuationAdminBaseController
{
    const viewFolderPath = 'valuation::Admin.Settings.Feature.';
    const saveUpdateDataRoute = 'valuation.admin.settings.feature.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.block.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Settings.Feature.';

    private $listingPageRoute = 'valuation.admin.settings.feature';
    private $dataRoute = 'valuation.admin.settings.feature.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.feature.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.feature.addEditView';
    private $destroyRoute = 'valuation.admin.settings.block.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.propertyFeature.Title';

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

        $feture = new ValuationPropertyFeature();

        $this->fetureCount = $feture->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $governorate = null;
        $this->title = 'valuation::valuation.propertyFeature.createFeature';
        $this->id = $id;
        $categoryObj=new ValuationPropertyFeatureCategory();
        $this->category=$categoryObj->getAllForCompany();
        if ($id > 0)
        {
            $featureObj = new ValuationPropertyFeature;
            $features = $featureObj->find($id);
            $this->id=$id;
        }

        $this->feature_name = isset($features->feature_name) ? $features->feature_name : '';
        $this->countryId = isset($features->company_id) ? $features->company_id : '';
        $this->field_type = isset($features->field_type) ? $features->field_type : '';
        $this->category_id = isset($features->category_id) ? $features->category_id : '';
        $this->sub_fields = isset($features->sub_fields) ? json_decode($features->sub_fields) : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationPropertyFeature::find($request->id)) {
            $features = ValuationPropertyFeature::find($request->id);
        } else {
            $features = new ValuationPropertyFeature;
        }
        $features->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $features->feature_name = isset($request->featureName) ? $request->featureName : '';
        $features->category_id = isset($request->feactureCategory) ? $request->feactureCategory : '';
        $features->field_type = isset($request->fieldType) ? $request->fieldType : '';
        $subField=  isset($request->subField) ? $request->subField:array();
        $fieldsArray=array();
        if(!empty($subField))
        {
            foreach($subField as $key=>$field)
            {
                if(!empty($subField[$key]))
                {
                    $fieldsArray[]=array('name'=>$subField[$key]);
                }
            }
        }
        if(!empty($fieldsArray))
        {
            $features->sub_fields=json_encode($fieldsArray);
        }
        else
        {
            $features->sub_fields='';
        }
        $features->save();
        $featureId=$features->id;
        if($featureId)
        {
            return Reply::redirect(route($this->addEditViewRoute,$featureId), __('Save Success'));
        }
        else if($request->id)
        {
           return Reply::redirect(route($this->addEditViewRoute,$request->id), __('Updated Success')); 
        }
        else
        {
            return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $feature = ValuationPropertyFeature::find($id);

        if (empty($feature)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationPropertyFeature::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $featureObj = new ValuationPropertyFeature();

        $fetureList = $featureObj->getAllAjaxForCompany();

        echo  json_encode($fetureList);
    }

    public function data()
    {
        $featureObj = new ValuationPropertyFeature();
        $featureList = $featureObj->getAllForCompany();

        return DataTables::of($featureList)
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
                    return ucfirst($row->feature_name);
                }
            )
            ->editColumn(
                'category',
                function ($row) {
                    return ucfirst(isset($row->featureCategory->category_name)?$row->featureCategory->category_name:'Category not found');
                }
            )
            ->addIndexColumn()
            ->rawColumns(array('name', 'action'))
            ->make(true);
    }

}
