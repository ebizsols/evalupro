<?php
namespace Modules\Valuation\Http\Controllers\Admin\Settings;
use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Illuminate\Http\Request;
use Modules\Valuation\Entities\ValuationMeasurementUnit;
class MeasurementController extends ValuationAdminBaseController
{
   
    const saveUpdateDataRoute = 'valuation.admin.settings.Measurement.saveUpdateData';
    const addEditViewRoute = 'valuation.admin.settings.Measurement.addEditView';
     private $addEditViewRoute = 'valuation.admin.settings.Measurement.addEditView';
     private $saveUpdateDataRoute = 'valuation.admin.settings.Measurement.saveUpdateData';
     private $viewFolderPath = 'valuation::Admin.Property.Measurement.';
    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.measurement.measurementTitle';
        $this->pageIcon = 'icon-speedometer';
         

    }
    public function __customConstruct(&$data)
    {
        //assign routes for views
       
        $data['saveUpdateDataRoute'] = $this->saveUpdateDataRoute;
        $data['addEditViewRoute'] = $this->addEditViewRoute;
        $data['viewFolderPath'] = $this->viewFolderPath;
        $data['companyId'] = isset(company()->id)?company()->id:0;

    }
    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);
        $this->title = 'valuation::valuation.measurement.Title';
        $unitObj = new ValuationMeasurementUnit;
        $unit = null;
        if($id>0)
        {
            $this->id=$id;
            if (ValuationMeasurementUnit::find($id))
            {
                $unit = ValuationMeasurementUnit::find($id);
            }
        }
        else if($this->data['companyId'])
        {
            $unitObj = new ValuationMeasurementUnit;
           
            $units=  $unitObj->getCompanyUnitSetting($this->data['companyId']);
            $unit = (isset($units[0]))? $units[0]:null;
        }

        $this->measure_unit = isset($unit->measure_unit)?$unit->measure_unit:$unitObj->default;
        return view($this->viewFolderPath . 'Index', $this->data);
    }
    public function saveUpdateData(Request $request)
    {
        $data = array();
       
        $this->__customConstruct($data);
        if (ValuationMeasurementUnit::find($request->id))
        {
            $unit = ValuationMeasurementUnit::find($request->id);
        } else 
        {
            $unit = new ValuationMeasurementUnit;
        }
        $unit->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $unit->measure_unit = isset($request->land_measurement_unit) ? $request->land_measurement_unit : '';
        $unit->save();
         $unitId=$unit->id;
         if($request->id){
          return Reply::redirect(route($this->addEditViewRoute,$request->id), __('Updated Success'));
         }
         else
         {
            return Reply::redirect(route($this->addEditViewRoute,$unitId), __('Saved Success')); 
         }
    }
}
?>