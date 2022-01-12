<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Illuminate\Http\Request;
use Modules\Valuation\Entities\MethodologyTemplate;
use Modules\Valuation\Entities\ValuationPropertyType;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;

class MethodologyController extends ValuationAdminBaseController
{

    private $viewFolderPath = 'valuation::Admin.Settings.Methodology.';
    private $listingPageRoute = 'valuation.admin.settings.methodology';
    private $dataRoute = 'valuation.admin.settings.methodology.data';
    private $addEditViewRoute = 'valuation.admin.settings.methodology.addEditView';
    private $saveUpdateDataRoute = 'valuation.admin.settings.methodology.saveUpdateData';
    private $destroyRoute = 'valuation.admin.settings.methodology.destroy';
    private $getComparableData = 'valuation.admin.settings.methodology.getComparableData';


    /**
     * @var mixed|string
     */
    private $mate_key;
    /**
     * @var mixed|string
     */
    private $countryId;
    /**
     * @var mixed|string
     */
    private $meta_value;

    protected $model = '';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.methodologySettings.Title';
        $this->pageIcon = 'icon-speedometer';
    }

    public function __customConstruct(&$data)
    {
        //assign routes for views
        $data['viewFolderPath'] = $this->viewFolderPath;
        $data['dataRoute'] = $this->dataRoute;
        $data['listingPageRoute'] = $this->listingPageRoute;
        $data['addEditViewRoute'] = $this->addEditViewRoute;
        $data['saveUpdateDataRoute'] = $this->saveUpdateDataRoute;
        $data['destroyRoute'] = $this->destroyRoute;
        $data['getComparableData'] = $this->getComparableData;
        $data['companyId'] = isset(company()->id) ? company()->id : 0;
    }

    public function index()
    {
        $this->__customConstruct($this->data);
        $this->title = 'valuation::valuation.generalSetting.createFeature';

        $template = new MethodologyTemplate();
        $this->templateCount = $template->countForCompany();
        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);


        $this->id = $id;
        $this->headingTitle = 'valuation::valuation.methodologySettings.createTemplate';
        $templateData = new MethodologyTemplate();
        // $this->templateData = $templateData->getAllForCompany();

        if ($id > 0) {
            $this->headingTitle = 'valuation::valuation.methodologySettings.editTemplate';
            $templateData = new MethodologyTemplate();
            $templateInfo = $templateData->find($id);
            $this->id = $id;
            $this->templateFields = json_decode($templateInfo->template_category, TRUE);
        }

        // Property Type
        $propertyType = new ValuationPropertyType();
        $this->propertyType = $propertyType->getAllForCompany();
        $this->property_type = isset($templateInfo->type_id) ? $templateInfo->type_id : '';

        $this->template_name = isset($templateInfo->template_name) ? $templateInfo->template_name : '';
        $template_category = isset($templateInfo->template) ? $templateInfo->template : "";
        $this->template_category = json_decode($template_category, true);

        $tempData = array();
        $tempData['apartmentSize'] = "Apartment Size";
        $tempData['noOfBedrooms'] = "No. of Bedrooms";
        $tempData['noOfBathrooms'] = "No. of Bathrooms";
        $tempData['finishingQuality'] = "Finishing Quality";
        $tempData['buildingAmenities'] = "Building Amenities";

        $this->tempData = $tempData;

        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);

        if (MethodologyTemplate::find($request->id)) {
            $template = MethodologyTemplate::find($request->id);
        } else {
            $template = new MethodologyTemplate();
        }

        $template->type_id = isset($request->property_type) ? $request->property_type : '';

        $template->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $template->template_name = isset($request->template_name) ? $request->template_name : '';
        $template->template_category = json_encode(isset($request->template_category) ? $request->template_category : array());
        $template->save();
        $templateId = $template->id;
        if ($templateId) {
            return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
        } else if ($request->id) {
            return Reply::redirect(route($this->listingPageRoute), __('Updated Success'));
        } else {
            return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $template = MethodologyTemplate::find($id);

        if (empty($template)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        MethodologyTemplate::destroy($id);

        return Reply::redirect(route($this->listingPageRoute), __('valuation::messages.dataDeleted'));
    }

    public function getComparableData(Request $request)
    {
        $comparable = $request->comparable;
        echo "<pre>--"; print_r($comparable); exit;

        $comparablesArray = array();
    }

    public function data()
    {
        $template = new MethodologyTemplate();
        $templateData = $template->getAllForCompany();

        return DataTables::of($templateData)
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
            ->editColumn(
                'template_name',
                function ($row) {
                    return ucfirst($row->template_name);
                }
            )
            ->editColumn(
                'type_id',
                function ($row) {
                    $id = $row->type_id;
                    $typeTitle = ValuationPropertyType::find($id)->title;
                    return ucfirst($typeTitle);
                }
            )
            ->editColumn(
                'template_category',
                function ($row) {
                    $template_fields =  ucfirst(isset($row->template_category) ? $row->template_category : 'Template not found');
                    return json_decode($template_fields, true);
                }
            )
            ->addIndexColumn()
            ->rawColumns(array('template_name', 'action'))
            ->make(true);
    }
}
