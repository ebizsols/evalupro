<?php
namespace Modules\Valuation\Entities;
use Modules\Valuation\Entities\ValuationBaseModel;

class ValuationSowRule extends ValuationBaseModel
{
    const ValuatorsLimitations='ValuatorsLimitations';
    const InformationOfSources='InformationOfSources';
    const TypeOfReport='TypeOfReport';
    const RestrictionsOnDistribution='RestrictionsOnDistribution';
    const ValuationReport='ValuationReport';
    public $timestamps = true;
    protected $fillable = array();

}
?>