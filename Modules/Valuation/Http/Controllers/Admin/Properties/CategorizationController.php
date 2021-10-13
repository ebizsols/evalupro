<?php
namespace Modules\Valuation\Http\Controllers\Admin\Properties;

use App\Helper\Reply;
use Illuminate\Http\Request;

use Modules\Valuation\Entities\ValuationPropertyCategorization;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Yajra\DataTables\Facades\DataTables;

class CategorizationController extends ValuationAdminBaseController
{

    const viewFolderPath = 'valuation::Admin.Property.Categorization.';
    const saveUpdateDataRoute = 'valuation.admin.property.categorization.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.property.categorization.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Property.Categorization.';
    private $listingPageRoute = 'valuation.admin.property.categorization';
    private $dataRoute = 'valuation.admin.property.categorization.data';
    private $saveUpdateDataRoute = 'valuation.admin.property.categorization.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.property.categorization.addEditView';
    private $destroyRoute = 'valuation.admin.property.categorization.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.property.categorization.title';

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

        $propertyCategorizations = new ValuationPropertyCategorization();

        $this->propertyCategorizationCount = $propertyCategorizations->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $this->title = 'valuation::valuation.property.categorization.createPropertyCategorization';
        $this->id = $id;

        $propertyCategorization = null;
        if ($id > 0) {
            $propertyCategorizationObj = new ValuationPropertyCategorization();
            $propertyCategorization = $propertyCategorizationObj->find($id);
        }

        $this->title = isset($propertyCategorization->title) ? $propertyCategorization->title : '';
        $this->status = isset($propertyCategorization->status) ? $propertyCategorization->status : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationPropertyCategorization::find($request->id)) {
            $propertyCategorization = ValuationPropertyCategorization::find($request->id);
        } else {
            $propertyCategorization = new ValuationPropertyCategorization;
        }

        $propertyCategorization->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $propertyCategorization->title = isset($request->title) ? $request->title : 0;
        $propertyCategorization->status = isset($request->status) ? $request->status : "Active";
        $propertyCategorization->save();

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

        $propertyCategorization = ValuationPropertyCategorization::find($id);

        if (empty($propertyCategorization)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationPropertyCategorization::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $propertyCategorizationObj = new ValuationPropertyCategorization();

        $propertyCategorizations = $propertyCategorizationObj->getAllAjaxForCompany();

        echo  json_encode($propertyCategorizations);
    }

    public function data()
    {
        $propertyCategorizationObj = new ValuationPropertyCategorization();

        $propertyCategorizations = $propertyCategorizationObj->getAllForCompany();

        return DataTables::of($propertyCategorizations)
            ->addColumn('action', function ($row) {

                $action = '<div class="btn-group dropdown m-r-10">
                <button aria-expanded="false" data-toggle="dropdown" class="btn dropdown-toggle waves-effect waves-light" categorization="button"><i class="ti-more"></i></button>
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
