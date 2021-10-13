<?php
namespace Modules\Valuation\Entities;
use Modules\Valuation\Entities\ValuationBaseModel;
class ValuationPropertyXref extends ValuationBaseModel
{
  protected $fillable = ['property_id','unit_id'];  
  public $timestamps = false;
  public function getAllUnit($propertyId)
    {
         return $this->join('valuation_properties', 'valuation_property_xrefs.property_id', '=','valuation_properties.id')
              ->select('valuation_properties.title','valuation_property_xrefs.unit_id')
             ->where('valuation_property_xrefs.property_id','=',$propertyId)
              ->get();
    }
    public function getUnit()
    {
        return $this->belongsTo(ValuationProperty::class, 'unit_id');
    }
//  public function getUnit()
//    {
//        return $this->hasMany(ValuationProperty::class, 'property_id');
//    }
    
}

