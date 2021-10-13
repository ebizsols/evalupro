<?php

namespace App\Http\Controllers\Admin;

use App\Project;
use App\Currency;
use Modules\Valuation\Entities\ValuationProperty;
use App\Product;

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
        $this->currencies = Currency::all();
            $this->project = Project::findorFail($id);

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

    public function tempGenerateProjectReport($id)
    {
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
