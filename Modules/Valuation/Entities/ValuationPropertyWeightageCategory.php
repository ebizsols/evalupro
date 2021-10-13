<?php

namespace Modules\Valuation\Entities;

class ValuationPropertyWeightageCategory extends ValuationBaseModel
{
    const AccessibilityText='Accessibility';
    const AccessibilityTypeText='AccessibilityType';
    const LandClassificationTypeText='LandClassification';
    const LocationClassificationText='LocationClassification';
    const NoOfAccessRoadsText='NoOfAccessRoads';
    const AccessRoadTypeText='AccessRoadType';
    const RecencyTransectionText='RecencyTransection';
    const LandshapeText='Landshape';
    const MaintenanceText='Maintenance';
    const NoOfBedroomText='NoOfBedroom';
    const NoOfBathoomsText='NoOfBathooms';
    const FinishingQualityText='FinishingQuality';
    const FloorlevelText='Floorlevel';
    const ViewText='View';
    const AmenitiesText='Amenities';
    
    public function weightageCategoryItems()
    {
        //return 'aa';
        return $this->hasMany(ValuationPropertyWeightage::class, 'category_id');
    }
}
