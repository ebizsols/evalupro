<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use App\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Entities\ValuationGovernorate;
use Modules\Valuation\Entities\ValuationCity;
use Modules\Valuation\Entities\ValuationBlock;

class BlockController extends ValuationAdminBaseController
{
    const viewFolderPath = 'valuation::Admin.Settings.Block.';
    const saveUpdateDataRoute = 'valuation.admin.settings.block.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.block.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Settings.Block.';

    private $listingPageRoute = 'valuation.admin.settings.block';
    private $dataRoute = 'valuation.admin.settings.block.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.block.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.block.addEditView';
    private $destroyRoute = 'valuation.admin.settings.block.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.block.title';

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

        $blocks = new ValuationBlock();

        $this->blocksCount = $blocks->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $governorate = null;
        $this->title = 'valuation::valuation.block.createBlock';
        $this->id = $id;

        $countryObj = new Country();
        $this->countries = $countryObj->get();

        $governorateObj = new ValuationGovernorate();
        $this->governorates= $governorateObj->getAllForCompany();

        $cityObj = new ValuationCity();
        $this->cities = $cityObj->getAllForCompany();

        if ($id > 0) {
            $blockObj = new ValuationBlock();
            $block = $blockObj->find($id);
        }

        $this->name = isset($block->name) ? $block->name : '';
        $this->countryId = isset($block->country_id) ? $block->country_id : '';
        $this->governorateId = isset($block->governorate_id) ? $block->governorate_id : '';
        $this->cityId = isset($block->city_id) ? $block->city_id : '';
        $this->status = isset($block->status) ? $block->status : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationBlock::find($request->id)) {
            $block = ValuationBlock::find($request->id);
        } else {
            $block = new ValuationBlock;
        }

        $block->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $block->name = isset($request->name) ? $request->name : 0;
        $block->country_id = isset($request->countryId) ? $request->countryId : 0;
        $block->governorate_id = isset($request->governorateId) ? $request->governorateId : 0;
        $block->city_id = isset($request->cityId) ? $request->cityId : 0;
        $block->status = isset($request->status) ? $request->status : "Active";
        $block->save();

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

        $block = ValuationBlock::find($id);

        if (empty($block)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationBlock::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $cityObj = new ValuationBlock();

        $cities = $cityObj->getAllAjaxForCompany();

        echo  json_encode($cities);
    }

    public function data()
    {
        $blockObj = new ValuationBlock();

        $blocks = $blockObj->getAllForCompany();

        return DataTables::of($blocks)
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
            ->addColumn('city', function ($row) {

                $cityId = $row->city_id;
                $cityName = '';
                if ($city = ValuationCity::find($cityId)) {
                    $cityName = isset($city->name)?ucfirst($city->name):'';
                }
                return $cityName;
            })
            ->editColumn(
                'name',
                function ($row) {
                    return ucfirst($row->name);
                }
            )
            ->addIndexColumn()
            ->rawColumns(array('name', 'action'))
            ->make(true);
    }

}
