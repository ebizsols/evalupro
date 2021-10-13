<?php

namespace Modules\Valuation\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Valuation\Entities\ValuationPropertyFeatureCategory;

class ValuationMethod extends ValuationBaseModel
{
    public $timestamps = true;
    protected $fillable = ['category_id','name','status'];

    public function featureCategory()
    {
        //return 'aa';
        return $this->belongsTo(ValuationApproache::class, 'category_id');
    }

}
