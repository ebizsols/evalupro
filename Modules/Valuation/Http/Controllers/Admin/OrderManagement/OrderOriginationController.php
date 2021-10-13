<?php

namespace Modules\Valuation\Http\Controllers\Admin\OrderManagement;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;


class OrderOriginationController extends ValuationAdminBaseController
{
    private $viewFolderPath = 'valuation::Admin.OrderOrigination.';

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'valuation::valuation.orderOrigination';
        $this->pageIcon = '';
    }

    /**
     * Display order origination form
     * @return Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $this->valuationMethods = array('Comparative method', 'Investment method', 'Residual appraisal', 'Depreciated Replacement cost', 'Profit Methods');
        $this->propertyCategories = array('Land', 'Apartment', 'Building', 'Compound', 'Villa');
        $this->gender = 'male';
        $this->selectedValuationMethod = 'Investment method';
        $this->selectedPropertyCategory  = 'Apartment';

        $this->isAdmin = user()->hasRole('admin');

        return view($this->viewFolderPath . 'Create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        echo "<pre>";
        print_r("in store");
        exit;
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        return view('valuation::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        return view('valuation::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
