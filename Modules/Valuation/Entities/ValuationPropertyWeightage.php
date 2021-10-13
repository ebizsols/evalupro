<?php

namespace Modules\Valuation\Entities;

class ValuationPropertyWeightage extends ValuationBaseModel
{
    public function WeightageCategory()
    {
        return $this->belongsTo(ValuationPropertyWeightageCategory::class, 'category_id');
    }


}
