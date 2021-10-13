<?php
namespace Modules\Valuation\Helper;

use Modules\Valuation\Entities\ValuationCity;
use Modules\Valuation\Entities\ValuationMenu;
use App\Country;
class ValuationModelHelper{

    public static function valuationCityModelObj()
    {
        return new ValuationCity();
    }

    public static function countryModelObj()
    {
        return new Country();
    }
    public static function valuationMenu()
    {
        return new ValuationMenu();
    }
}
