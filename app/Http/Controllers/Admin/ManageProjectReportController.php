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
use Illuminate\Http\Request;
use MacsiDigital\OAuth2\Support\Token\DB;

use Carbon\Carbon;


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
    public function show($id)
    {
        $this->generateProjectReportRoute = 'admin.report.generate';
        $this->id = $id;
        $reportConditionalTextObj = new ReportConditionalText();
        $this->reportConditionalText =   $reportConditionalTextObj->getAllForCompany();

         //dd($reportConditionalText);
        $this->currencies = Currency::all();
            $this->project = Project::findorFail($id);
        // $users = ReportConditionalText::all();
        // return $users;
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
