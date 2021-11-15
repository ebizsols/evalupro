<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Entities\ValuationGeneralSetting;
use Modules\Valuation\Entities\ValuationSowRule;

class ScopeOfWorkController extends ValuationAdminBaseController {
    const viewFolderPath = 'valuation::Admin.Settings.scopeOfWork.';
    const saveUpdateDataRoute = 'valuation.admin.settings.scopeOfWork.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.block.getAjaxData';
    const saveUpdateRuleRoute ='valuation.admin.settings.scopeOfWork.saveUpdateRuleData';
    const editDataRoute ='valuation.admin.settings.scopeOfWork.editData';
    private $viewFolderPath = 'valuation::Admin.Settings.SoW.';

    private $listingPageRoute = 'valuation.admin.settings.scopeOfWork';
    private $dataRoute = 'valuation.admin.settings.scopeOfWork.data';
    private $getdataRoute = 'valuation.admin.settings.scopeOfWork.getdata';
    private $saveUpdateDataRoute = 'valuation.admin.settings.scopeOfWork.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.scopeOfWork.addEditView';
    private $destroyRoute = 'valuation.admin.settings.scopeOfWork.destroy';
    private $saveUpdateRuleRoute = 'valuation.admin.settings.scopeOfWork.saveUpdateRuleData';
    private $editDataRoute = 'valuation.admin.settings.scopeOfWork.editData';
    private $editReportDataRoute = 'valuation.admin.settings.scopeOfWork.editreportData';
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

        $this->pageTitle = 'valuation::valuation.scopeOfWorkSettings.Title';

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
        $data['getdataRoute'] = $this->getdataRoute;
        $data['viewFolderPath'] = $this->viewFolderPath;
        $data['saveUpdateRuleRoute']=$this->saveUpdateRuleRoute;
        $data['editDataRoute']=$this->editDataRoute;
        $data['editReportDataRoute']=$this->editReportDataRoute;
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

        return view($this->viewFolderPath . 'Index', $this->data);
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
