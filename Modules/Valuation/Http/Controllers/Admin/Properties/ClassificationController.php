<?php
namespace Modules\Valuation\Http\Controllers\Admin\Properties;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Illuminate\Http\Request;
use Modules\Valuation\Entities\ValuationPropertyClassification;
use Yajra\DataTables\Facades\DataTables;

class ClassificationController extends ValuationAdminBaseController
{

    const viewFolderPath = 'valuation::Admin.Property.Classification.';
    const saveUpdateDataRoute = 'valuation.admin.property.classification.saveUpdateData';
    const getAjaxDataRoute = 'valuation.admin.property.classification.getAjaxData';

    private $viewFolderPath = 'valuation::Admin.Property.Classification.';
    private $listingPageRoute = 'valuation.admin.property.classification';
    private $dataRoute = 'valuation.admin.property.classification.data';
    private $saveUpdateDataRoute = 'valuation.admin.property.classification.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.property.classification.addEditView';
    private $destroyRoute = 'valuation.admin.property.classification.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.property.classification.title';

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

        $propertyClassifications = new ValuationPropertyClassification();

        $this->propertyClassificationCount = $propertyClassifications->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $this->title = 'valuation::valuation.property.classification.createPropertyClassification';
        $this->id = $id;

        $propertyClassification = null;
        if ($id > 0) {
            $propertyClassificationObj = new ValuationPropertyClassification();
            $propertyClassification = $propertyClassificationObj->find($id);
        }

        $this->title = isset($propertyClassification->title) ? $propertyClassification->title : '';
        $this->status = isset($propertyClassification->status) ? $propertyClassification->status : '';

        return view($this->viewFolderPath . 'AddEditView', $this->data);


    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (ValuationPropertyClassification::find($request->id)) {
            $propertyClassification = ValuationPropertyClassification::find($request->id);
        } else {
            $propertyClassification = new ValuationPropertyClassification;
        }

        $propertyClassification->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $propertyClassification->title = isset($request->title) ? $request->title : 0;
        $propertyClassification->status = isset($request->status) ? $request->status : "Active";
        $propertyClassification->save();

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

        $propertyClassification = ValuationPropertyClassification::find($id);

        if (empty($propertyClassification)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationPropertyClassification::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function getAjaxData()
    {
        $propertyClassificationObj = new ValuationPropertyClassification();

        $propertyClassifications = $propertyClassificationObj->getAllAjaxForCompany();

        echo  json_encode($propertyClassifications);
    }

    public function data()
    {
        $propertyClassificationObj = new ValuationPropertyClassification();

        $propertyClassifications = $propertyClassificationObj->getAllForCompany();

        return DataTables::of($propertyClassifications)
            ->addColumn('action', function ($row) {

                $action = '<div class="btn-group dropdown m-r-10">
                <button aria-expanded="false" data-toggle="dropdown" class="btn dropdown-toggle waves-effect waves-light" classification="button"><i class="ti-more"></i></button>
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
