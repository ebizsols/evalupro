<?php

namespace Modules\Valuation\Entities;

use Modules\Valuation\Entities\ValuationBaseModel;
use Zoha\Metable;

class ValuationProperty extends ValuationBaseModel
{
    use Metable;
    const DimensionsMetaKey = 'propertyDimensions';
    const PropertyFeatureMetaKey = 'propertyFeatures';
    const AddOnCostMetaKey = 'propertyAddOnCost';
    const FinancialAcquisitionCost='FinancialAcquisitionCost';
    const AcquisitionCostPropertyInfo='AcquisitionCostPropertyInfo';
    const UnitInfoAcquisitionCost='UnitInfoAcquisitionCost';
    
    const FinancialBuildUpCost='FinancialBuildUpCost';
    const FinancialBuildUpCostStructureInfo='FinancialBuildUpCostStructureInfo';
    const FinancialAddOnCost='FinancialAddOnCost';
    const PropertyInfoAddOnCost='PropertyInfoAddOnCost';
    const UnitInfoAddOnCost='UnitInfoAddOnCost';
    const StructureUnit='StructureUnit';
    const OwnerShip='OwnerShip';
    const PropertyEnvirementalMatters='PropertyEnvirementalMatters';
    const PropertyAssumption='PropertyAssumption';
    const PropertyRelventInformation='PropertyRelventInformation';
    const PropertyPlanningPotential='PropertyPlanningPotential';
    const PropertyInfoIncome='PropertyInfoIncome';
    const StructureInfoIncome='StructureInfoIncome';
    const UnitInfoIncome='UnitInfoIncome';
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
    const ResidualValueForPropertyInfo='ResidualValueForPropertyInfo';
    const DepictedValueForPropertyInfo='DepictedValueForPropertyInfo';
    const CostOfConstructionValueForPropertyInfo='CostOfConstructionValueForPropertyInfo';
    const IncomeBaseValueForPropertyInfo='IncomeBaseValueForPropertyInfo';
    const AcquisitionCostStructureInfo='AcquisitionCostStructureInfo';
    const RentalIncomeStructure='RentalIncomeStructure';
    const RentalIncomePropertyInfo='RentalIncomePropertyInfo';
    const EstimatedValueStructure='EstimatedValueStructure';
    const ResidualValueForStructure='ResidualValueForStructure';
    const DepictedValueForStructure='DepictedValueForStructure';
    const CostOfConstructionValueForStructure='CostOfConstructionValueForStructure';
    const IncomeBaseValueForStructure='IncomeBaseValueForStructure';
    const SalePurchaseHistory='SalePurchaseHistory';
    const RentalIncomeHistory='RentalIncomeHistory';
    const Valuations='Valuations';
    const UnitType='UnitType';
    const UnitInfoView='UnitInfoView';
    const UnitInfoCondition='UnitInfoCondition';
    const UnitInfoStyling='UnitInfoStyling';
    const UnitInfoStatus='UnitInfoStatus';
    const UnitInfoInteriorStatus='UnitInfoInteriorStatus';
    const UnitInfoFloor='UnitInfoFloor';
    const RentalIncomeUnitInfo='RentalIncomeUnitInfo';
    const EstimatedValueUnitInfo='EstimatedValueUnitInfo';
    const EstimatedValuePropertyInfo='EstimatedValuePropertyInfo';
    const ResidualValueUnitInfo='ResidualValueUnitInfo';
    const DepictedValueUnitInfo='DepictedValueUnitInfo';
    const CostOfConstructionValueUnitInfo='CostOfConstructionValueUnitInfo';
    const IncomeBaseValueUnitInfo='IncomeBaseValueUnitInfo';
    const PropertyLog='PropertyLog';

    protected $metaTable = 'valuation_property_meta';
    protected $fillable = array();
    public static $array = array();
    public function __construct()
    {
        parent::__construct();
        $array[self::UnitInfoAcquisitionCost] = self::UnitInfoAcquisitionCost;
        $array[self::UnitType] = self::UnitType;
        $array[self::UnitInfoView] = self::UnitInfoView;
        $array[self::UnitInfoCondition] = self::UnitInfoCondition;
        $array[self::UnitInfoStyling] = self::UnitInfoStyling;
        $array[self::UnitInfoStatus] = self::UnitInfoStatus;
        $array[self::UnitInfoInteriorStatus] = self::UnitInfoInteriorStatus;
        $array[self::RentalIncomeUnitInfo] = self::RentalIncomeUnitInfo;
        $array[self::EstimatedValueUnitInfo] = self::EstimatedValueUnitInfo;
        $array[self::ResidualValueUnitInfo] = self::ResidualValueUnitInfo;
        $array[self::DepictedValueUnitInfo] = self::DepictedValueUnitInfo;
        $array[self::CostOfConstructionValueUnitInfo] = self::CostOfConstructionValueUnitInfo;
        $array[self::IncomeBaseValueUnitInfo] = self::IncomeBaseValueUnitInfo;
        $array[self::UnitInfoAddOnCost] = self::UnitInfoAddOnCost;
        $array[self::UnitInfoIncome] = self::UnitInfoIncome;
        $array[self::FloorlevelText] = self::FloorlevelText;
        $array[self::NoOfBedroomText] = self::NoOfBedroomText;
        $array[self::NoOfBathoomsText] = self::NoOfBathoomsText;
        $array[self::FinishingQualityText] = self::FinishingQualityText;
        $array[self::MaintenanceText] = self::MaintenanceText;
    
    }
   
//    public function getAllUnit($propertyId)
//    {
//         return $this->join('valuation_property_xrefs', 'valuation_property_xrefs.property_id', '=','valuation_properties.id')
//              ->select('valuation_properties.*')
//             ->where('valuation_property_xrefs.property_id','=',$propertyId)
//              ->get();
//    }
//    public function unitItem()
//    {
//        
//        return $this->belongsTo(ValuationPropertyXref::class, 'property_id');
//    }
}
