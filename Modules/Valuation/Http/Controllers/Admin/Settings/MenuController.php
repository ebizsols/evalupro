<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Entities\ValuationMenu;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class MenuController extends ValuationAdminBaseController
{

    private $viewFolderPath = 'valuation::Admin.Settings.Menu.';

    private $listingPageRoute = 'valuation.admin.settings.menu';
    private $dataRoute = 'valuation.admin.settings.menu.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.menu.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.menu.addEditView';
    private $destroyRoute = 'valuation.admin.settings.menu.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.menu.title';

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

        $menus = new ValuationMenu();

        $this->menusCount = $menus->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $governorate = null;
        $this->title = 'valuation::valuation.menu.createMenu';
        $this->id = $id;
        $this->isHide = false;

        $menus = ValuationMenu::get(['id', 'name']);

        $menu = array();
        if ($id > 0) {
            $menuObj = new ValuationMenu();
            $menu = $menuObj->find($id);

            if($menu->parent == 0 && $menu->id == 1){
                $this->isHide = true;
            }
        }

        $this->name = isset($menu->name) ? $menu->name : '';
        $this->validationName = isset($menu->validation_name) ? $menu->validation_name : '';
        $this->route = isset($menu->route) ? $menu->route : '';
        $this->parent = isset($menu->parent) ? $menu->parent : '';
        $this->status = isset($menu->status) ? $menu->status : '';
        $this->menus = !empty($menus) ? $menus: array();

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationMenu::find($request->id)) {
            $menu = ValuationMenu::find($request->id);
        } else {
            $menu = new ValuationMenu;
        }

        $menu->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $menu->name = isset($request->name) ? $request->name : 0;
        $menu->validation_name = isset($request->validation_name) ? $request->validation_name : '';
        $menu->route = isset($request->route) ? $request->route : '';
        $menu->parent = isset($request->parentMenuId) ? $request->parentMenuId : 1;
        if($request->id == 1){
            $menu->parent = 0;
        }
        $menu->status = isset($request->status) ? $request->status : "Active";
        $menu->save();

        return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $menu = ValuationMenu::find($id);

        if (empty($menu)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationMenu::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function data()
    {
        $menuObj = new ValuationMenu();

        $menus = $menuObj->getAllForCompany();

        return DataTables::of($menus)
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
            ->addColumn('parent', function ($row) {
                $parentId = $row->parent;
                $parentName = 'root';
                $menu = ValuationMenu::find($parentId);
                if (!empty($menu)) {
                    $parentName = $menu->name;
                }
                return $parentName;
            })
            ->addColumn('status', function ($row) {

                return $row->status;
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
