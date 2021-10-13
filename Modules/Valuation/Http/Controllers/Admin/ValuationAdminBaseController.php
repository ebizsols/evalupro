<?php

namespace Modules\Valuation\Http\Controllers\Admin;

use App\Http\Controllers\Admin\AdminBaseController;
use Modules\Valuation\Database\Seeders\SeedValuationLeftMenuTableSeeder;
use Modules\Valuation\Entities\ValuationMenu;

class ValuationAdminBaseController extends AdminBaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->openValuationMainMenu = 'open';

        $this->middleware(function ($request, $next) {

            $this->defaultMenuInsertion(company()->id);

            return $next($request);
        });

    }

    /**
     * Default Menu Insertion
     *
     * this method will insert default valuation menu for company
     * if company is first time login and do not have menu, it insert default menu.
     * @param int $companyId
     * @return void
     */

    public function defaultMenuInsertion($companyId = 0)
    {
        $modelValuationMenu = new ValuationMenu();
        $companyValuationMenu = $modelValuationMenu->getByCompanyId($companyId);

        if (empty($companyValuationMenu)) {
            $valuationLeftMenu = new SeedValuationLeftMenuTableSeeder();
            $valuationLeftMenu->run($companyId);
        }
    }

}
