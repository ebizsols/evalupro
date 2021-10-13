<?php
namespace Modules\Valuation\Http\Controllers\Admin\Properties;

use App\Helper\Reply;
use Illuminate\Http\Request;

use Modules\Valuation\Entities\ValuationPropertyClass;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Yajra\DataTables\Facades\DataTables;

class ClassController extends ValuationAdminBaseController
{
    const viewFolderPath = 'valuation::Admin.Property.Class.';
    const saveUpdateDataRoute = 'valuation.admin.property.class.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.property.class.getAjaxData';


    private $viewFolderPath = 'valuation::Admin.Property.Class.';
    private $listingPageRoute = 'valuation.admin.property.class';
    private $dataRoute = 'valuation.admin.property.class.data';
    private $saveUpdateDataRoute = 'valuation.admin.property.class.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.property.class.addEditView';
    private $destroyRoute = 'valuation.admin.property.class.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.property.class.title';

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

        $propertyClasss = new ValuationPropertyClass();

        $this->propertyClassCount = $propertyClasss->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $this->title = 'valuation::valuation.property.class.createPropertyClass';
        $this->id = $id;

        $propertyClass = null;
        if ($id > 0) {
            $propertyClassObj = new ValuationPropertyClass();
            $propertyClass = $propertyClassObj->find($id);
        }

        $this->title = isset($propertyClass->title) ? $propertyClass->title : '';
        $this->status = isset($propertyClass->status) ? $propertyClass->status : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationPropertyClass::find($request->id)) {
            $propertyClass = ValuationPropertyClass::find($request->id);
        } else {
            $propertyClass = new ValuationPropertyClass;
        }

        $propertyClass->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $propertyClass->title = isset($request->title) ? $request->title : 0;
        $propertyClass->status = isset($request->status) ? $request->status : "Active";
        $propertyClass->save();

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

        $propertyClass = ValuationPropertyClass::find($id);

        if (empty($propertyClass)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationPropertyClass::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $propertyClassObj = new ValuationPropertyClass();

        $propertyClasses = $propertyClassObj->getAllAjaxForCompany();

        echo  json_encode($propertyClasses);
    }

    public function data()
    {
        $propertyClassObj = new ValuationPropertyClass();

        $propertyClasses = $propertyClassObj->getAllForCompany();

        return DataTables::of($propertyClasses)
            ->addColumn('action', function ($row) {

                $action = '<div class="btn-group dropdown m-r-10">
                <button aria-expanded="false" data-toggle="dropdown" class="btn dropdown-toggle waves-effect waves-light" class="button"><i class="ti-more"></i></button>
                <ul role="menu" class="dropdown-menu pull-right">
                  <li><a href="' . route($this->addEditViewRoute, $row->id) . '"><i class="fa fa-pencil" aria-hidden="true"></i> ' . trans('valuation::app.edit') . '</a></li>
                  <li><a href="javascript:void(0)" id="'.$row->id.'" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> ' . trans('valuation::app.delete') . '</a></li>
                 ';

                $action .= '</ul> </div>';

                return $action;

            })
            ->editColumn(
                'title',
                function ($row) {
                    return ucfirst($row->title);
                }
            )
            ->addIndexColumn()
            ->rawColumns(['title', 'action'])
            ->make(true);
    }

}
