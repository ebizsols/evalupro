<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Entities\ValuationBaseModel;
use Modules\Valuation\Entities\ValuationIntendedUser;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use App\Country;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Entities\ValuationGovernorate;
use Modules\Valuation\Entities\ValuationCity;
use Modules\Valuation\Entities\ValuationBlock;

class IntendedUserController extends ValuationAdminBaseController
{
    const viewFolderPath = 'valuation::Admin.Settings.IntendedUser.';
    const saveUpdateDataRoute = 'valuation.admin.settings.intendedUser.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.settings.intendedUser.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Settings.IntendedUser.';
    private $listingPageRoute = 'valuation.admin.settings.intendedUser';
    private $dataRoute = 'valuation.admin.settings.intendedUser.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.intendedUser.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.intendedUser.addEditView';
    private $destroyRoute = 'valuation.admin.settings.intendedUser.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.intendedUser.homeTitle';

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

        $blocks = new ValuationIntendedUser();

        $this->blocksCount = $blocks->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $this->title = 'valuation::valuation.intendedUser.createBlock';
        $this->id = $id;


        if ($id > 0) {
            $blockObj = new ValuationIntendedUser();
            $block = $blockObj->find($id);
        }

        $this->name = isset($block->title) ? $block->title : '';
        $this->status = isset($block->status) ? $block->status : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationIntendedUser::find($request->id)) {
            $block = ValuationIntendedUser::find($request->id);
        } else {
            $block = new ValuationIntendedUser;
        }

        $block->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $block->title = isset($request->title) ? $request->title : 0;
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

        $block = ValuationIntendedUser::find($id);

        if (empty($block)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationIntendedUser::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $cityObj = new ValuationIntendedUser();

        $cities = $cityObj->getAllAjaxForCompany();

        echo  json_encode($cities);
    }

    public function data()
    {
        $blockObj = new ValuationIntendedUser();

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
            ->editColumn(
                'name',
                function ($row) {
                    return ucfirst($row->title);
                }
            )
            ->addIndexColumn()
            ->rawColumns(array('name', 'action'))
            ->make(true);
    }

}
