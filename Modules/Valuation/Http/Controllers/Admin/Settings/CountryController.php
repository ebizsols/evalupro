<?php

namespace Modules\Valuation\Http\Controllers\Admin\Settings;

use App\Helper\Reply;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use App\Country;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class CountryController extends ValuationAdminBaseController
{

    private $viewFolderPath = 'valuation::Admin.Settings.Country.';

    private $listingPageRoute = 'valuation.admin.settings.country';
    private $dataRoute = 'valuation.admin.settings.country.data';
    private $saveUpdateDataRoute = 'valuation.admin.settings.country.saveUpdateData';
    private $addEditViewRoute = 'valuation.admin.settings.country.addEditView';
    private $destroyRoute = 'valuation.admin.settings.country.destroy';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::app.country';

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
        $data['companyId'] = isset(company()->id)?company()->id:0;
    }

    public function index()
    {
        $this->__customConstruct($this->data);

        $country = new Country();

        $countriesCount = $country->count();

        $this->countriesCount = $countriesCount;

        return view( $this->viewFolderPath . 'Index', $this->data);
    }

    public function edit($id = 0)
    {
        $this->__customConstruct($this->data);

        $countryData = Country::find($id);

        $this->id = $id;
        $this->countryName = isset($countryData->name) ? $countryData->name : '';
        $this->isoAlpha2 = isset($countryData->iso_alpha2) ? $countryData->iso_alpha2 : '';
        $this->isoAlpha3 = isset($countryData->iso_alpha3) ? $countryData->iso_alpha3 : '';
        $this->isoNumeric = isset($countryData->iso_numeric) ? $countryData->iso_numeric : '';
        $this->currencyName = isset($countryData->currency_code) ? $countryData->currency_code : '';
        $this->currencyCode = isset($countryData->currency_name) ? $countryData->currency_name : '';
        $this->currencySymbol = isset($countryData->currency_symbol) ? $countryData->currency_symbol : '';
        $this->flag = isset($countryData->flag) ? $countryData->flag : '';
        $this->isVisible = isset($countryData->is_visible) ? $countryData->is_visible : '';

        return view( $this->viewFolderPath . 'Edit', $this->data);
    }

    public function saveUpdate(Request $request)
    {
        if (Country::find($request->id)) {
            $country = Country::find($request->id);
        } else {
            $country = new Country;
        }

        $country->id = $request->id;
        $country->name = $request->countryName;
        $country->iso_alpha2 = $request->isoAlpha2;
        $country->iso_alpha3 = $request->isoAlpha3;
        $country->iso_numeric = $request->isoNumeric;
        $country->currency_name = $request->currencyName;
        $country->currency_code = $request->currencyCode;
        $country->currency_symbol = $request->currencySymbol;
        $country->flag = $request->flag;
        $country->is_visible = $request->isVisible;
        $country->save();

        return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
    }

    public function data()
    {
        $country = new Country();

        $countries = $country->get();

        return DataTables::of($countries)
            ->addColumn('action', function ($row) {

                $action = '<div class="btn-group dropdown m-r-10">
                <button aria-expanded="false" data-toggle="dropdown" class="btn dropdown-toggle waves-effect waves-light" type="button"><i class="ti-more"></i></button>
                <ul role="menu" class="dropdown-menu pull-right">
                  <li><a href="' . route('valuation.admin.settings.country.edit', $row->id) . '"><i class="fa fa-pencil" aria-hidden="true"></i> ' . trans('app.edit') . '</a></li>
                 ';

                $action .= '</ul> </div>';

                return $action;

            })
            ->editColumn(
                'country',
                function ($row) {
                    return ucfirst($row->name);
                }
            )
            ->addIndexColumn()
            ->rawColumns(['name', 'action'])
            ->make(true);
    }

}
