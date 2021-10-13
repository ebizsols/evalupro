<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use App\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Entities\ValuationGovernorate;

class GovernorateController extends ValuationAdminBaseController
{

    private $viewFolderPath = 'valuation::Admin.Settings.Governorate.';

    private $listingPageRoute = 'valuation.admin.settings.governorate';
    private $dataRoute = 'valuation.admin.settings.governorate.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.governorate.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.governorate.addEditView';
    private $destroyRoute = 'valuation.admin.settings.governorate.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.governorate.title';

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
        $data['companyId'] = isset(company()->id)?company()->id:0;
    }

    public function index()
    {
        $this->__customConstruct($this->data);

        $governorate = new ValuationGovernorate();

        $this->governorateCount = $governorate->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $governorate = null;
        $this->title = 'valuation::valuation.governorate.createGovernorate';
        $this->id = $id;

        $countryObj = new Country();
        $this->countries = $countryObj->get();

        if ($id > 0) {
            $governorateObj = new ValuationGovernorate();
            $governorate = $governorateObj->find($id);
        }

        $this->name = isset($governorate->name) ? $governorate->name : '';
        $this->country_id = isset($governorate->country_id) ? $governorate->country_id : '';
        $this->status = isset($governorate->status) ? $governorate->status : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);


    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationGovernorate::find($request->id)) {
            $governorate = ValuationGovernorate::find($request->id);
        } else {
            $governorate = new ValuationGovernorate;
        }

        $governorate->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $governorate->name = isset($request->name) ? $request->name : 0;
        $governorate->country_id = isset($request->countryId) ? $request->countryId : 0;
        $governorate->status = isset($request->status) ? $request->status : "Active";
        $governorate->save();

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

        $governorate = ValuationGovernorate::find($id);

        if (empty($governorate)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationGovernorate::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function data()
    {
        $governoratesObj = new ValuationGovernorate();

        $governorates = $governoratesObj->getAllForCompany();

        return DataTables::of($governorates)
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
                    return ucfirst($row->name);
                }
            )
            ->addIndexColumn()
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

}
