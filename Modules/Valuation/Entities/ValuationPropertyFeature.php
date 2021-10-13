<?php

namespace Modules\Valuation\Entities;

class ValuationPropertyFeature extends ValuationBaseModel
{
    /*protected $table = 'valuation_property_feature';*/
    public $timestamps = true;
    protected $fillable = ['category_id','company_id','feature_name','field_type','sub_fields'];

    public function featureCategory()
    {
        //return 'aa';
        return $this->belongsTo(ValuationPropertyFeatureCategory::class, 'category_id');
    }

    public function getFeature()
    {
       return $this->join('property_feature_category', 'valuation_property_feature.category_id', '=', 'property_feature_category.id')
            ->select('valuation_property_feature.*', 'property_feature_category.category_name')
            ->get();
    }
}
