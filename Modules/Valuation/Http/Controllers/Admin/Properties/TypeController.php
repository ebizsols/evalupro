<?php
namespace Modules\Valuation\Http\Controllers\Admin\Properties;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Illuminate\Http\Request;
use Modules\Valuation\Entities\ValuationPropertyType;
use Yajra\DataTables\Facades\DataTables;

class TypeController extends ValuationAdminBaseController
{

    const viewFolderPath = 'valuation::Admin.Property.Type.';
    const saveUpdateDataRoute = 'valuation.admin.property.type.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.property.type.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Property.Type.';
    private $listingPageRoute = 'valuation.admin.property.type';
    private $dataRoute = 'valuation.admin.property.type.data';
    private $saveUpdateDataRoute = 'valuation.admin.property.type.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.property.type.addEditView';
    private $destroyRoute = 'valuation.admin.property.type.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.property.type.title';

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

        $propertyTypes = new ValuationPropertyType();

        $this->propertyTypeCount = $propertyTypes->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $this->title = 'valuation::valuation.property.type.createPropertyType';
        $this->id = $id;

        $propertyType = null;
        if ($id > 0) {
            $propertyTypeObj = new ValuationPropertyType();
            $propertyType = $propertyTypeObj->find($id);
        }

        $this->title = isset($propertyType->title) ? $propertyType->title : '';
        $this->status = isset($propertyType->status) ? $propertyType->status : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);


    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationPropertyType::find($request->id)) {
            $propertyType = ValuationPropertyType::find($request->id);
        } else {
            $propertyType = new ValuationPropertyType;
        }

        $propertyType->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $propertyType->title = isset($request->title) ? $request->title : 0;
        $propertyType->status = isset($request->status) ? $request->status : "Active";
        $propertyType->save();

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

        $propertyType = ValuationPropertyType::find($id);

        if (empty($propertyType)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationPropertyType::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $propertyTypeObj = new ValuationPropertyType();

        $propertyTypes = $propertyTypeObj->getAllAjaxForCompany();

        echo  json_encode($propertyTypes);
    }

    public function data()
    {
        $propertyTypeObj = new ValuationPropertyType();

        $propertyTypes = $propertyTypeObj->getAllForCompany();

        return DataTables::of($propertyTypes)
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
