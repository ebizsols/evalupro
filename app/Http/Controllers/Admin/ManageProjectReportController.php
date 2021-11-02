<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\Currency;
use Modules\Valuation\Entities\ValuationProperty;
use Modules\Valuation\Entities\ValuationSowRule;
use Modules\Valuation\Entities\ReportConditionalText;
use App\Product;
use App\ClientDetails;
use App\ProductCategory;
use App\ProductSubCategory;
use App\ProjectMember;
use App\User;
use Illuminate\Http\Request;
use MacsiDigital\OAuth2\Support\Token\DB;
use Carbon\Carbon;
use Modules\Valuation\Entities\ValuationCity;
use Modules\Valuation\Entities\ValuationPropertyCategorization;
use Modules\Valuation\Entities\ValuationPropertyClassification;
use Modules\Valuation\Entities\ValuationPropertyType;

class ManageProjectReportController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'app.menu.projects';
        $this->pageIcon = 'icon-layers';
        $this->middleware(function ($request, $next) {
            if (!in_array('projects', $this->user->modules)) {
                abort(403);
            }
            return $next($request);
        });
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $this->generateProjectReportRoute = 'admin.report.generate';
        $this->id = $id;
        $reportConditionalTextObj = new ReportConditionalText();
        $this->reportConditionalText =   $reportConditionalTextObj->getAllForCompany();

         //dd($reportConditionalText);
        $this->currencies = Currency::all();
            $this->project = Project::find($id);
        // $users = ReportConditionalText::all();
        // return $users;

        // New Code
         $projectObj = new Project();
         $projectInfo = $projectObj::find($id);
         $propertyId = $projectInfo['property_id'];
         $productId = $projectInfo->product_id;

        $productData = Product::find($productId);
        $categoryId = $productData->category_id;
        $subCategoryId = $productData->sub_category_id;
        $productCategory = ProductCategory::find($categoryId);
        if($productCategory){
            $productCategory = $productCategory->toArray();
        }
        $this->purposeOfValuation = (isset($productCategory['category_name'])) ? $productCategory['category_name'] : "Not found";

        $productSubCategory = ProductSubCategory::find($subCategoryId);
        if($productSubCategory){
            $productSubCategory = $productSubCategory->toArray();
        }
        $this->basisOfValuation = (isset($productSubCategory['category_name'])) ? $productSubCategory['category_name'] : "Not found";

        $this->approachInfo = $projectObj::find($id)->getMeta('approaches');
         $propertyInfo = ValuationProperty::find($propertyId);
         if($propertyInfo){
             $propertyInfo = $propertyInfo->toArray();
         }
 
         $companyId = $propertyInfo['company_id'];
 
         $clientDetails = ClientDetails::find($companyId);
         if($clientDetails){
             $clientDetails = $clientDetails->toArray();
         }
         $this->clientName = (isset($clientDetails['name'])) ? $clientDetails['name'] : 'Not found';
         $this->date = Carbon::now("GMT+5")->toDateTimeString();
 
        //  New Dynamic Data
        $propertyData = ValuationProperty::find($propertyId);
        $subjectProperty = $propertyData->type_id;
        $propertyType = ValuationPropertyType::find($subjectProperty);
        $this->propertyType = $propertyType->title;

        $valuationDate = $projectInfo->created_at->toArray();
        $this->valuationDate = $valuationDate['formatted'];

        $projectId = $projectInfo->id;
        $projectMembers = new ProjectMember;
        $projectMembersData = $projectMembers->where('project_id',$projectId)->first();
        $userId = $projectMembersData->user_id;

        $userData = User::find($userId);
        $this->roleName = $userData->name;

        $this->valuationMethod = $projectObj::find($id)->getMeta('methods');

        $this->landSizeMeterSquare = $propertyData->sizes_in_meter_sq;
        $this->landSizeSquareFeet = $propertyData->sizes_in_sq_feet;
        $this->plotNumber = $propertyData->plot_num;
        $this->noOfRoads = $propertyData->no_of_roads;
        $this->landShape = $propertyData->land_structure_type;
        $this->locality = $propertyData->locality;


        $categorizationId = $propertyData->categorization_id;
        $landCategory = ValuationPropertyCategorization::find($categorizationId);
        $this->landCategory = $landCategory->title;

        $classificationId = $propertyData->classification_id;
        $landClassification = ValuationPropertyClassification::find($classificationId);
        $this->landClassification = $landClassification->title;

        $cityId = $propertyData->city_id;
        $cityName = ValuationCity::find($cityId);
        $this->cityName = $cityName->name;

        $comparisonContent = (array)json_decode($projectInfo->getMeta('methodologyResult'));
        $comparisonContent['hideContent'] = true;
        $this->comparisonContent = $comparisonContent;
        // dd("Here");
        //echo "<pre>"; print_r($this->comparisonContect); exit;

        //  End New Dynamic Data
       

        return view('admin.projects.report.show', $this->data);
    }

    public function processProjectReport($id)
    {
        $project = Project::findorFail($id);
        $viewData = array();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.scopeOfWork.scopeOfWork-pdf', [
            'viewData' => $project,
            'project' => $project,
        ]);
        $filename = 'ValuationReport-' . $id;

        return [
            'pdf' => $pdf,
            'fileName' => $filename
        ];
    }

    public function tempGenerateProjectReport(Request $request)
    {
        $reportTextIds = isset($request->reportText)?$request->reportText:array();

        $selectedReportData = array();

        foreach($reportTextIds as $reportTextId){
            $reportConditionalTextObj = new ReportConditionalText();
            $reportData = $reportConditionalTextObj->where('id',$reportTextId)->first()->toArray();
            if(!empty($reportData)){
                $selectedReportData[] = $reportData;
            }
        }

        $id = $request->project_id;


        // dd($id);
        // Client Name
        $projectObj = new Project();
        $projectInfo = $projectObj::find($id);

        $propertyId = $projectInfo['property_id'];

        $propertyInfo = ValuationProperty::find($propertyId);
        if($propertyInfo){
            $propertyInfo = $propertyInfo->toArray();
        }

        $companyId = $propertyInfo['company_id'];

        $clientDetails = ClientDetails::find($companyId);
        if($clientDetails){
            $clientDetails = $clientDetails->toArray();
        }
        $clientName = (isset($clientDetails['name'])) ? $clientDetails['name'] : 'Not found';
        // End Client Name

        // Date Time
        $date = Carbon::now("GMT+5")->toDateTimeString();

        // Purpose of Valuation
        $productCategory = ProductCategory::find($companyId);
        if($productCategory){
            $productCategory = $productCategory->toArray();
        }
        $purposeOfValuation = (isset($productCategory['category_name'])) ? $productCategory['category_name'] : "Not found";
        //End Purpose of Valuation

        // Basis of Valuation
        $productSubCategory = ProductSubCategory::find($companyId);
        if($productSubCategory){
            $productSubCategory = $productSubCategory->toArray();
        }
        $basisOfValuation = (isset($productSubCategory['category_name'])) ? $productSubCategory['category_name'] : "Not found";

        // End Basis of Valuation
        // Valuation Approach
        $approachInfo = $projectObj::find($id)->getMeta('approaches');
        // End Valuation Approach


        // final Array
        $viewData = array();
        $viewData['clientName'] = $clientName;
        $viewData['date'] = $date;
        $viewData['purposeOfValuation'] = $purposeOfValuation;
        $viewData['basisOfValuation'] = $basisOfValuation;
        $viewData['approachInfo'] = $approachInfo;
        $viewData['selectedReportData'] = $selectedReportData;

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.projects.report.ValuationReportPDF', $viewData);
        $filename = 'ValuationReport';

        $pdfOption = [
            'pdf' => $pdf,
            'fileName' => $filename
        ];
        //$pdfOption = $this->domPdfObjectForDownload($id);
        $pdf = $pdfOption['pdf'];
        $filename = $pdfOption['fileName'];

        return $pdf->download($filename . '.pdf');
        echo "in";
        exit;

        $viewData = array();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.projects.report.ValuationReportPDF', [
            'viewData' => '',
        ]);
        $filename = 'ValuationReport-';

        return $pdf->download($filename . '.pdf');

        $project = Project::findorFail($id);
        $propertyId = isset($project->property_id)?$project->property_id:0;
        $productId = isset($project->product_id)?$project->product_id:0;
        $product = Product::findorFail($productId);
        $product->image = 'https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885__480.jpg';
        $valuationProperty = ValuationProperty::findorFail($propertyId);



        $viewData = array();

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('admin.projects.report.ValuationReportPDF', [
            'viewData' => $project,
            'project' => $project,
            'product' => $product,
            'valuationProperty' => $valuationProperty,
        ]);
        $filename = 'ValuationReport-' . $id;

        return $pdf->download($filename . '.pdf');
    }

    public function generateProjectReport($id)
    {

        echo "<pre>"; print_r('generateProjectReport'); exit;
        $pdfOption = $this->processProjectReport($id);
        $pdf = $pdfOption['pdf'];
        $filename = $pdfOption['fileName'];

        return $pdf->download($filename . '.pdf');
    }

}
