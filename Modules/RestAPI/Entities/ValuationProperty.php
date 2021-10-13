<?php

namespace Modules\RestAPI\Entities;

use App\BaseModel;
use App\Traits\CustomFieldsTrait;
use Zoha\Metable;

class ValuationProperty extends BaseModel
{
    use CustomFieldsTrait;
    use Metable;
    protected $guarded = ['id'];
    const DimensionsMetaKey = 'propertyDimensions';
    const PropertyFeatureMetaKey = 'propertyFeatures';
    const AddOnCostMetaKey = 'propertyAddOnCost';
    const FinancialAcquisitionCost='FinancialAcquisitionCost';
    const FinancialBuildUpCost='FinancialBuildUpCost';
    const FinancialAddOnCost='FinancialAddOnCost';

    protected $metaTable = 'valuation_property_meta';
    protected $fillable = array();
}
