<?php

namespace Modules\Valuation\Http\Controllers\Member;

use App\Company;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Valuation\Http\Controllers\Member\MemberBaseController;


class MemberDashboardController extends MemberBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'valuation::app.menu.dashboard';
        $this->pageIcon = 'icon-speedometer';


        $roleId = '93';
        $this->userRole = Role::where('id', $roleId)->first();

        $companyId = '30';//Auth::user()->company_id;
        $this->global = Company::withoutGlobalScope('active')->where('id', $companyId)->first();

        //$this->user = auth()->user();


    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('valuation::index', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('valuation::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
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
