<?php

namespace Modules\Valuation\Entities;

use Illuminate\Database\Eloquent\Model;

class ValuationApproache extends ValuationBaseModel
{
    public $timestamps = true;
    protected $fillable = ['id','company_id','name','status'];

    public function featureItems()
    {
        //return 'aa';
        return $this->hasMany(ValuationMethod::class, 'category_id');
    }
}
