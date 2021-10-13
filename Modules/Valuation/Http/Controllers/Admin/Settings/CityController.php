<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use App\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Entities\ValuationGovernorate;
use Modules\Valuation\Entities\ValuationCity;

class CityController extends ValuationAdminBaseController
{

    const viewFolderPath = 'valuation::Admin.Settings.City.';
    const saveUpdateDataRoute = 'valuation.admin.settings.city.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.city.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Settings.City.';
    private $listingPageRoute = 'valuation.admin.settings.city';
    private $dataRoute = 'valuation.admin.settings.city.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.city.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.city.addEditView';
    private $destroyRoute = 'valuation.admin.settings.city.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.city.title';

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

        $cities = new ValuationCity();

        $this->citiesCount = $cities->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $governorate = null;
        $this->title = 'valuation::valuation.city.createCity';
        $this->id = $id;

        $countryObj = new Country();
        $this->countries = $countryObj->get();

        $governorateObj = new ValuationGovernorate();
        $this->governorates= $governorateObj->getAllForCompany();

        if ($id > 0) {
            $cityObj = new ValuationCity();
            $city = $cityObj->find($id);
        }

        $this->name = isset($city->name) ? $city->name : '';
        $this->countryId = isset($city->country_id) ? $city->country_id : '';
        $this->governorateId = isset($city->governorate_id) ? $city->governorate_id : '';
        $this->status = isset($city->status) ? $city->status : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);


    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationCity::find($request->id)) {
            $city = ValuationCity::find($request->id);
        } else {
            $city = new ValuationCity;
        }

        $city->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $city->name = isset($request->name) ? $request->name : 0;
        $city->country_id = isset($request->countryId) ? $request->countryId : 0;
        $city->governorate_id = isset($request->governorateId) ? $request->governorateId : 0;
        $city->status = isset($request->status) ? $request->status : "Active";
        $city->save();

        return Reply::redirect(route($this->listingPageRoute), __('Save Success'), );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $city = ValuationCity::find($id);

        if (empty($city)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationCity::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $cityObj = new ValuationCity();

        $cities = $cityObj->getAllAjaxForCompany();

        echo  json_encode($cities);
    }

    public function data()
    {
        $cityObj = new ValuationCity();

        $cities = $cityObj->getAllForCompany();

        return DataTables::of($cities)
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
            ->addColumn('governorate', function ($row) {

                $governorateId = $row->governorate_id;
                $governorateName = '';
                if ($governorate = ValuationGovernorate::find($governorateId)) {
                    $governorateName = isset($governorate->name)?ucfirst($governorate->name):'';
                }
                return $governorateName;
            })
            ->editColumn(
                'name',
                function ($row) {
                    return ucfirst($row->name);
                }
            )
            ->addIndexColumn()
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

}
