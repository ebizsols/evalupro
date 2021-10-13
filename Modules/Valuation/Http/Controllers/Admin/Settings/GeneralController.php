<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Entities\ValuationGeneralSetting;
use Modules\Valuation\Entities\ValuationSowRule;

class GeneralController extends ValuationAdminBaseController
{
    const viewFolderPath = 'valuation::Admin.Settings.General.';
    const saveUpdateDataRoute = 'valuation.admin.settings.general.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.block.getAjaxData';
    const saveUpdateRuleRoute ='valuation.admin.settings.general.saveUpdateRuleData';
    const editDataRoute ='valuation.admin.settings.general.editData';
    private $viewFolderPath = 'valuation::Admin.Settings.General.';

    private $listingPageRoute = 'valuation.admin.settings.general';
    private $dataRoute = 'valuation.admin.settings.general.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.general.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.general.addEditView';
    private $destroyRoute = 'valuation.admin.settings.general.destroy';
    private $saveUpdateRuleRoute = 'valuation.admin.settings.general.saveUpdateRuleData';
    private $editDataRoute = 'valuation.admin.settings.general.editData';
    /**
     * @var mixed|string
     */
    private $mate_key;
    /**
     * @var mixed|string
     */
    private $countryId;
    /**
     * @var mixed|string
     */
    private $meta_value;

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.generalSetting.Title';

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
        $data['saveUpdateRuleRoute']=$this->saveUpdateRuleRoute;
        $data['editDataRoute']=$this->editDataRoute;
        $data['companyId'] = isset(company()->id)?company()->id:0;

    }

    public function index()
    {
        $this->__customConstruct($this->data);
        $this->title = 'valuation::valuation.generalSetting.createFeature';
        $feture = new ValuationGeneralSetting();
        $scope = $feture->getAllForCompany();
        $this->formData = array();
        $formData = array();
        foreach ($scope as $data){
            $formData[$data->meta_key]=$data->meta_value;
        }
        $this->formData =$formData;

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $governorate = null;
        $this->title = 'valuation::valuation.generalSetting.createFeature';
        $this->id = $id;
        if ($id > 0)
        {
            $featureObj = new ValuationGeneralSetting;
            $features = $featureObj->find($id);
            $this->id=$id;
        }

        $this->mate_key = $features->mate_key ?? '';
        $this->countryId = $features->company_id ?? '';
        $this->meta_value = $features->meta_value ?? '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        foreach($request->all() as $key =>$value)
        {
            if ( $key !== '_token' )
            {
                $features = ValuationGeneralSetting::firstOrNew(array('meta_key' => $key));
//                $features = ValuationGeneralSetting::where(array('mate_key' => $key))->get();

//                dd($features);
                $features->company_id = $data['companyId'] ?? 0;
                $features->meta_key = $key ?? '';
                $features->meta_value = $value ?? '';
                $features->save();
            }
        }

        return Reply::redirect(route($this->listingPageRoute), __('Updated Success'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $feature = ValuationGeneralSetting::find($id);

        if (empty($feature)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationGeneralSetting::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }
    public function destroyRule($id)
    {
        $rule = ValuationSowRule::find($id);
        if (empty($rule)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }
        ValuationSowRule::destroy($id);
        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $featureObj = new ValuationGeneralSetting();

        $fetureList = $featureObj->getAllAjaxForCompany();

        echo  json_encode($fetureList);
    }
    public function editData($id = 0)
    {
     
        $this->__customConstruct($this->data);
        if($id >0)
        {
            $ruleObj = ValuationSowRule::find($id);
            $array = array();
            $array['test'] = $ruleObj->toArray();
            return Reply::successWithData('success',$array);
        }
        else
        {
            
        }
    }

    public function saveUpdateRuleData(Request $request)
    {
//        $data = array();
        $this->__customConstruct($this->data);
        if(isset($request->id) && $request->id>0)
        {
            $ruleObj = ValuationSowRule::find($request->id);
        }
        else
        {
            $ruleObj=new ValuationSowRule();
        }
        $ruleObj->company_id=isset($this->data['companyId']) ? $this->data['companyId'] : 0;
        $ruleObj->rule_type=isset($request->ruleType) ? $request->ruleType : 'ValuatorsLimitations';
        $ruleObj->description=isset($request->ruleText) ? $request->ruleText : '';
        $ruleObj->save();
        
        return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
    }

    public function getData()
    {
        $ruleObj = new ValuationSowRule();
        $rules = $ruleObj->getAllForCompany();
        return DataTables::of($rules)
            ->addIndexColumn()
             ->editColumn(
                'type',
                function ($row) {
                   return $row->rule_type; 
                }
            )
            ->addColumn('action', function ($row) {
                $action = '<div class="btn-group dropdown m-r-10">
                <button aria-expanded="false" data-toggle="dropdown" class="btn dropdown-toggle waves-effect waves-light" type="button"><i class="ti-more"></i></button>
                <ul role="menu" class="dropdown-menu pull-right">
                  <li><a href="javascript:void(0)" onclick="loadEditData('.$row->id.')"><i class="fa fa-pencil" aria-hidden="true"></i> ' . trans('valuation::app.edit') . '</a></li>
                  <li><a href="javascript:void(0)" id="' . $row->id . '" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> ' . trans('valuation::app.delete') . '</a></li>
                     
                 ';
                $action .= '</ul> </div>';
                return $action;
            })
            ->rawColumns(array('type', 'action'))
            ->make(true);
    }



}
