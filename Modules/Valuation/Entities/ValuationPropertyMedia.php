<?php
namespace Modules\Valuation\Entities;

use Modules\Valuation\Entities\ValuationBaseModel;

class ValuationPropertyMedia extends ValuationBaseModel
{
   
    protected $table = 'valuation_properties_media';
    public $timestamps = true;
    protected $fillable = ['property_id','media_name'];
    public function getPropertyImg($id)
    {
        return $this->where('property_id', $id)->get();
    }
}
?>