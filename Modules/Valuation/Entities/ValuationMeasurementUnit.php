<?php
namespace Modules\Valuation\Entities;

use Modules\Valuation\Entities\ValuationBaseModel;

class ValuationMeasurementUnit extends ValuationBaseModel
{
    // region Properties
    protected $table = 'valuation_measurement_unit';
    public $timestamps = true;
    protected $fillable = ['company_id','measure_unit'];
    public $default = 'feet';
    public function getCompanyUnitSetting($id)
    {
        return $this->where('company_id', $id)->orderBy('id', 'desc')->limit(1)->get();
    }

}
