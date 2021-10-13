<?php

namespace Modules\Valuation\Entities;

class ValuationGeneralSetting extends ValuationBaseModel
{
    public $timestamps = false;
    protected $fillable = array();
    public $data = [
        'valuationInfoTitle' => 'Valuation Information',
        'serviceInfoTitle' => 'Service Information',
        'propertyInfoTitle' => 'Valuation Information',
        'googleApi' => 'Google Api',
        'maxNumberOfBedrooms'=>8,
        'maxNumberOfBathrooms'=>8,
        'maxNumberOfAmenities'=>8,
        'maxRecencyOfTransaction'=>10,
        'maxLocationOfLand'=>10
    ];

}
