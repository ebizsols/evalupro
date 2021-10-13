<?php

namespace Modules\Valuation\Http\Controllers\Admin\Properties;

use App\Country;
use App\Helper\Files;
use App\Helper\Reply;
use Illuminate\Http\Request;
use Modules\Valuation\Entities\ValuationBaseModel;
use Modules\Valuation\Entities\ValuationBlock;
use Modules\Valuation\Entities\ValuationGeneralSetting;
use Modules\Valuation\Entities\ValuationGovernorate;
use Modules\Valuation\Entities\ValuationPropertyClass;
use Modules\Valuation\Entities\ValuationPropertyFeature;
use Modules\Valuation\Entities\ValuationPropertyFeatureCategory;
use Modules\Valuation\Entities\ValuationPropertyMedia;
use Modules\Valuation\Http\Controllers\Admin\Properties\CategorizationController;
use Modules\Valuation\Http\Controllers\Admin\Settings\BlockController;
use Modules\Valuation\Http\Controllers\Admin\ValuationAdminBaseController;
use Modules\Valuation\Entities\ValuationProperty;
use Modules\Valuation\Entities\ValuationCity;
use Modules\Valuation\Entities\ValuationPropertyType;
use Modules\Valuation\Entities\ValuationPropertyCategorization;
use Modules\Valuation\Entities\ValuationPropertyClassification;
use Yajra\DataTables\Facades\DataTables;
use Modules\Valuation\Http\Controllers\Admin\Settings\CityController;
use Modules\Valuation\Http\Controllers\Admin\Properties\ClassController;
use Modules\Valuation\Http\Controllers\Admin\Properties\ClassificationController;
use Modules\Valuation\Http\Controllers\Admin\Properties\TypeController;
use App\Currency;
use Modules\Valuation\Entities\ValuationMeasurementUnit;
use App\User;
use Modules\Valuation\Entities\ValuationPropertyWeightageCategory;
use Modules\Valuation\Entities\ValuationPropertyWeightage;
use Modules\Valuation\Entities\ValuationPropertyXref;

class PropertyController extends ValuationAdminBaseController
{

    private $viewFolderPath = 'valuation::Admin.Property.';

    private $listingPageRoute = 'valuation.admin.property';
    private $dataRoute = 'valuation.admin.property.data';
    private $saveUpdateDataRoute = 'valuation.admin.property.saveUpdateData';
    private $saveUnitRoute = 'valuation.admin.property.saveUnit';
    private $getUnitRoute = 'valuation.admin.property.getUnit';
    private $addEditViewRoute = 'valuation.admin.property.addEditView';
    private $destroyRoute = 'valuation.admin.property.destroy';
    private $propertyDetailRoute = 'valuation.admin.property.property-detail';

    public function __construct()
    {
        parent::__construct();

        $this->pageTitle = 'valuation::valuation.property.title';

        $this->pageIcon = 'icon-speedometer';

    }

    public function __customConstruct(&$data)
    {
        //assign routes for views
        $data['listingPageRoute'] = $this->listingPageRoute;
        $data['dataRoute'] = $this->dataRoute;
        $data['saveUpdateDataRoute'] = $this->saveUpdateDataRoute;
        $data['saveUnitRoute'] = $this->saveUnitRoute;
        $data['getUnitRoute'] = $this->getUnitRoute;
        $data['addEditViewRoute'] = $this->addEditViewRoute;
        $data['destroyRoute'] = $this->destroyRoute;

        $data['cityViewFolderPath'] = CityController::viewFolderPath;
        $data['citySaveUpdateDataRoute'] = CityController::saveUpdateDataRoute;
        $data['getAjaxCityDataRoute'] = CityController::getAjaxDataRoute;

        $data['blockViewFolderPath'] = BlockController::viewFolderPath;
        $data['blockSaveUpdateDataRoute'] = BlockController::saveUpdateDataRoute;
        $data['getAjaxBlockDataRoute'] = BlockController::getAjaxDataRoute;

        $data['propertyClassViewFolderPath'] = ClassController::viewFolderPath;
        $data['propertyClassSaveUpdateDataRoute'] = ClassController::saveUpdateDataRoute;
        $data['getAjaxPropertyClassDataRoute'] = ClassController::getAjaxDataRoute;

        $data['propertyCategorizationViewFolderPath'] = CategorizationController::viewFolderPath;
        $data['propertyCategorizationSaveUpdateDataRoute'] = CategorizationController::saveUpdateDataRoute;
        $data['getAjaxPropertyCategorizationDataRoute'] = CategorizationController::getAjaxDataRoute;

        $data['propertyClassificationViewFolderPath'] = ClassificationController::viewFolderPath;
        $data['propertyClassificationSaveUpdateDataRoute'] = ClassificationController::saveUpdateDataRoute;
        $data['getAjaxPropertyClassificationDataRoute'] = ClassificationController::getAjaxDataRoute;

        $data['propertyTypeViewFolderPath'] = TypeController::viewFolderPath;
        $data['propertyTypeSaveUpdateDataRoute'] = TypeController::saveUpdateDataRoute;
        $data['getAjaxPropertyTypeDataRoute'] = TypeController::getAjaxDataRoute;

        $data['companyId'] = isset(company()->id) ? company()->id : 0;
        $currencyId = isset(company()->currency_id) ? company()->currency_id : 0;
        $currencyDetails = Currency::withoutGlobalScope('enable')->findOrFail($currencyId);
        $data['currencyCode'] = isset($currencyDetails->currency_code) ? $currencyDetails->currency_code : '';

        $data['adminCountryId'] = (isset(user()->country_id) && user()->country_id != '') ? user()->country_id : 0;
        $unitObj = new ValuationMeasurementUnit;

        $units = $unitObj->getCompanyUnitSetting(isset(company()->id) ? company()->id : 0);

        $unit = (isset($units[0])) ? $units[0] : null;

        $data['measurementUnit'] = isset($unit->measure_unit) ? $unit->measure_unit : $unitObj->default;
    }

    public function newCreateView()
    {

        $this->__customConstruct($this->data);

        $properties = new ValuationProperty();

        $this->propertiesCount = $properties->count();
        $this->valuationMethods = array();
        $this->propertyCategories = array();

        $countryObj = new Country();
        $this->countries = $countryObj->get();

        $governorateObj = new ValuationGovernorate();
        $this->governorates = $governorateObj->getAllForCompany();

        $cityObj = new ValuationCity();
        $this->cities = $cityObj->getAllForCompany();

        $blockObj = new ValuationBlock();
        $this->blocks = $blockObj->getAllForCompany();


        return view($this->viewFolderPath . 'newCreateView', $this->data);
    }

    public function index()
    {
        $this->__customConstruct($this->data);

        $properties = new ValuationProperty();

        $this->propertiesCount = $properties->countForCompany();

        return view($this->viewFolderPath . 'Index', $this->data);
    }

    public function addEditView($id = 0)
    {
        $this->__customConstruct($this->data);

        $this->title = 'valuation::valuation.property.createProperty';
        $this->id = $id;
        $properties = new ValuationProperty();
        if ($id == 0) {
            $properties->company_id = isset($this->data['companyId']) ? $this->data['companyId'] : 0;
            $properties->title = 'Temp';
            $properties->status = 'Draft';
            $properties->save();
            $propertyIdTempSave = $properties->id;
            return redirect()->route($this->addEditViewRoute, $propertyIdTempSave);
        }

        $this->propertiesCount = $properties->countForCompany();
        $countryObj = new Country();
        $this->countries = $countryObj->get();
        $governorateObj = new ValuationGovernorate();
        $this->governorates = $governorateObj->getAllForCompany();
        $cityObj = new ValuationCity();
        $this->cities = $cityObj->getAllForCompany();
        $blockObj = new ValuationBlock();
        $this->blocks = $blockObj->getAllForCompany();
        $typeObj = new ValuationPropertyType();
        $this->types = $typeObj->getAllForCompany();
        $propertyClassificationObj = new ValuationPropertyClassification();
        $this->classifications = $propertyClassificationObj->getAllForCompany();
        $propertyCategorizationObj = new ValuationPropertyCategorization();
        $this->categorizations = $propertyCategorizationObj->getAllForCompany();
        $propertyClassObj = new ValuationPropertyClass();
        $this->classes = $propertyClassObj->getAllForCompany();
        $featureCategory = new ValuationPropertyFeatureCategory();
        $this->featureCategorList = $featureCategory->getAllForCompany();
        $ValuationGeneralSettingFeature = new ValuationGeneralSetting();
        $googleApi = $ValuationGeneralSettingFeature->where('meta_key','=','googleApi')->get();
        $this->googleApi = $googleApi[0]['meta_value'];
        $staffList = User::allEmployees();

        $staff = array();
        if (!empty($staffList)) {
            foreach ($staffList as $key => $staffObj) {

                $staff[] = array('id' => $staffObj->id, 'name' => $staffObj->name);
            }
        }
        $propertyData = null;

        if ($id > 0) {
            $propertyObj = new ValuationProperty();
            $propertyData = $propertyObj->find($id);
            $ValuationPropertyXref = new ValuationPropertyXref();
        }
        $ValuationPropertyXref = new ValuationPropertyXref();
        if ($id > 0) {
            $getAllUnit = $ValuationPropertyXref->getAllUnit($id);
            $this->unitRefToProperty = $getAllUnit;
            if (!empty($getAllUnit)) {
//                foreach($getAllUnit as $unitMeta)
//                {
//                    $unitKey=$unitMeta->unit_id;
//                    $unitType=ValuationProperty::UnitType.'-'.$unitKey;
//                    $NoOfBedroomText=ValuationProperty::NoOfBedroomText.'-'.$unitKey;
//                    $NoOfBathoomsText=ValuationProperty::NoOfBathoomsText.'-'.$unitKey;
//                    $FinishingQualityText=ValuationProperty::FinishingQualityText.'-'.$unitKey;
//                    $MaintenanceText=ValuationProperty::MaintenanceText.'-'.$unitKey;
//                    $FloorlevelText=ValuationProperty::FloorlevelText.'-'.$unitKey;
//                    $UnitInfoView=ValuationProperty::UnitInfoView.'-'.$unitKey;
//                    $UnitInfoCondition=ValuationProperty::UnitInfoCondition.'-'.$unitKey;
//                    $UnitInfoStyling=ValuationProperty::UnitInfoStyling.'-'.$unitKey;
//                    $UnitInfoStatus=ValuationProperty::UnitInfoStatus.'-'.$unitKey;
//                    $UnitInfoInteriorStatus=ValuationProperty::UnitInfoInteriorStatus.'-'.$unitKey;
//                    $RentalIncomeUnitInfo=ValuationProperty::RentalIncomeUnitInfo.'-'.$unitKey;
//                    $DepictedValueUnitInfo=ValuationProperty::DepictedValueUnitInfo.'-'.$unitKey;
//                    $EstimatedValueUnitInfo=ValuationProperty::EstimatedValueUnitInfo.'-'.$unitKey;
//                    $ResidualValueUnitInfo=ValuationProperty::ResidualValueUnitInfo.'-'.$unitKey;
//                    $IncomeBaseValueUnitInfo=ValuationProperty::IncomeBaseValueUnitInfo.'-'.$unitKey;
//                    $UnitInfoAcquisitionCost=ValuationProperty::UnitInfoAcquisitionCost.'-'.$unitKey;
//                    $UnitInfoAddOnCost=ValuationProperty::UnitInfoAddOnCost.'-'.$unitKey;
//                    $UnitInfoIncome=ValuationProperty::UnitInfoIncome.'-'.$unitKey;
//                    $CostOfConstructionValueUnitInfo=ValuationProperty::CostOfConstructionValueUnitInfo.'-'.$unitKey;
//                    $this->$unitType=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::UnitType.'-'.$unitKey , array()))->toArray():array();
//                    $this->$NoOfBedroomText=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::NoOfBedroomText.'-'.$unitKey , array()))->toArray():array();
//                    $this->$NoOfBathoomsText=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::NoOfBathoomsText.'-'.$unitKey , array()))->toArray():array();
//                    $this->$FinishingQualityText=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::FinishingQualityText.'-'.$unitKey , array()))->toArray():array();
//                    $this->$MaintenanceText=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::MaintenanceText.'-'.$unitKey , array()))->toArray():array();
//                    $this->$FloorlevelText=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::FloorlevelText.'-'.$unitKey , array()))->toArray():array();
//                    $this->$UnitInfoView=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::UnitInfoView.'-'.$unitKey , array()))->toArray():array();
//                    $this->$UnitInfoCondition=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::UnitInfoCondition.'-'.$unitKey , array()))->toArray():array();
//                    $this->$UnitInfoStyling=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::UnitInfoStyling.'-'.$unitKey , array()))->toArray():array();
//                    $this->$UnitInfoStatus=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::UnitInfoStatus.'-'.$unitKey , array()))->toArray():array();
//                    $this->$UnitInfoInteriorStatus=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::UnitInfoInteriorStatus.'-'.$unitKey , array()))->toArray():array();
//                    $this->$RentalIncomeUnitInfo=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::RentalIncomeUnitInfo.'-'.$unitKey , array()))->toArray():array();
//                    $this->$DepictedValueUnitInfo=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::DepictedValueUnitInfo.'-'.$unitKey , array()))->toArray():array();
//                    $this->$EstimatedValueUnitInfo=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::EstimatedValueUnitInfo.'-'.$unitKey , array()))->toArray():array();
//                    $this->$ResidualValueUnitInfo=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::ResidualValueUnitInfo.'-'.$unitKey , array()))->toArray():array();
//                    $this->$CostOfConstructionValueUnitInfo=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::CostOfConstructionValueUnitInfo.'-'.$unitKey , array()))->toArray():array();
//                    $this->$IncomeBaseValueUnitInfo=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::IncomeBaseValueUnitInfo.'-'.$unitKey , array()))->toArray():array();
//                    $this->$UnitInfoAcquisitionCost=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::UnitInfoAcquisitionCost.'-'.$unitKey , array()))->toArray():array();
//                    $this->$UnitInfoAddOnCost=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::UnitInfoAddOnCost.'-'.$unitKey , array()))->toArray():array();
//                    $this->$UnitInfoIncome=($propertyData != null)?optional($propertyData->getMeta(ValuationProperty::UnitInfoIncome.'-'.$unitKey , array()))->toArray():array();
//                }
            }
        }
       //*************************************************************
//all options to show on property
        //*********************************
        $categoryObj = new ValuationPropertyWeightageCategory();
        $this->Accessibility = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::AccessibilityText)->get();
        $this->AccessibilityType = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::AccessibilityTypeText)->get();
        $this->LandClassification = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::LandClassificationTypeText)->get();
        $this->RoadAccessNo = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::NoOfAccessRoadsText)->get();
        $this->RoadAccessType = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::AccessRoadTypeText)->get();
        $this->RecencyTransection = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::RecencyTransectionText)->get();
        $this->LandShape = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::LandshapeText)->get();
        $this->LocationClassification = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::LocationClassificationText)->get();
        $this->BedRooms = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::NoOfBedroomText)->get();
        $this->BathRoom = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::NoOfBathoomsText)->get();
        $this->FinishingQuality = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::FinishingQualityText)->get();
        $this->Floorlevel = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::FloorlevelText)->get();
        $this->WeitageView = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::ViewText)->get();
        $this->Maintenance = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::MaintenanceText)->get();
        $this->Amenities = (object)$categoryObj->where('conditional_text', '=', ValuationPropertyWeightageCategory::AmenitiesText)->get();
        $this->defaultMeasurementUnit = $this->data['measurementUnit'];


        $this->adminCountryId = isset($propertyData->country_id) ? $propertyData->country_id : $this->data['adminCountryId'];
        $this->governorateId = isset($propertyData->governorate_id) ? $propertyData->governorate_id : 0;
        $this->cityId = isset($propertyData->city_id) ? $propertyData->city_id : 0;
        $this->blockId = isset($propertyData->block_id) ? $propertyData->block_id : 0;
        $this->classId = isset($propertyData->class_id) ? $propertyData->class_id : 0;
        $this->classificationId = isset($propertyData->classification_id) ? $propertyData->classification_id : 0;
        $this->categorizationId = isset($propertyData->categorization_id) ? $propertyData->categorization_id : 0;
        $this->typeId = isset($propertyData->type_id) ? $propertyData->type_id : 0;
        $this->processStatusId = isset($propertyData->process_status_id) ? $propertyData->process_status_id : 0;
        $this->propertyTitle = isset($propertyData->title) ? $propertyData->title : '';
        $this->locality = isset($propertyData->locality) ? $propertyData->locality : '';
        $this->road = isset($propertyData->road) ? $propertyData->road : '';
//        $this->coordinates = isset($propertyData->coordinates) ? $propertyData->coordinates : '';
        $this->latitude = isset($propertyData->latitude) ? $propertyData->latitude : '0';
        $this->longitude = isset($propertyData->longitude) ? $propertyData->longitude : '0';
        $this->plotNum = isset($propertyData->plot_num) ? $propertyData->plot_num : 0;
        $this->landSize = isset($propertyData->land_size) ? $propertyData->land_size : '';
        $this->municipalityCutting = isset($propertyData->municipalityCutting) ? $propertyData->municipalityCutting : '';
        $this->landStructureType = isset($propertyData->land_structure_type) ? $propertyData->land_structure_type : '';
        $this->sizeMeterSQ = isset($propertyData->sizes_in_meter_sq) ? $propertyData->sizes_in_meter_sq : 0;
        $this->sizeSQFeet = isset($propertyData->sizes_in_sq_feet) ? $propertyData->sizes_in_sq_feet : 0;
        $this->buildupSizes = isset($propertyData->buildup_sizes) ? $propertyData->buildup_sizes : 0;
        $this->frontElivation = isset($propertyData->front_elivation) ? $propertyData->front_elivation : 0;
        $this->depth = isset($propertyData->depth) ? $propertyData->depth : '';
        $this->commonArea = isset($propertyData->common_area) ? $propertyData->common_area : 0;
        $this->entranceNum = isset($propertyData->entrance_num) ? $propertyData->entrance_num : 0;
        $this->BLDGNum = isset($propertyData->bldg_num) ? $propertyData->bldg_num : 0;
        $this->unitNum = isset($propertyData->unit_num) ? $propertyData->unit_num : 0;
        $this->age = isset($propertyData->age) ? $propertyData->age : 0;
        $this->status = isset($propertyData->status) ? $propertyData->status : 0;
        $this->name = isset($propertyData->name) ? $propertyData->name : 0;
        $this->role = isset($propertyData->role) ? $propertyData->role : 0;
        $this->use = isset($propertyData->use) ? $propertyData->use : 0;
        $this->maintenance = isset($propertyData->maintenance) ? $propertyData->maintenance : 0;
        $this->noOfUnits = isset($propertyData->no_of_units) ? $propertyData->no_of_units : 0;
        $this->noOfRooms = isset($propertyData->no_of_rooms) ? $propertyData->no_of_rooms : 0;
        $this->noOfRoads = isset($propertyData->no_of_roads) ? $propertyData->no_of_roads : 0;
        $this->purchasePrice = isset($propertyData->purchase_price) ? $propertyData->purchase_price : 0;
        $this->landPrice = isset($propertyData->land_price) ? $propertyData->land_price : 0;
        $this->constructionPrice = isset($propertyData->construction_price) ? $propertyData->construction_price : 0;
        $this->renovationPrice = isset($propertyData->renovation_price) ? $propertyData->renovation_price : 0;
        $this->rentalIncome = isset($propertyData->rental_income) ? $propertyData->rental_income : 0;///
        $this->rentalStructureIncome = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::RentalIncomeStructure, array()))->toArray() : array();
        $this->estimatedValueStructure = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::EstimatedValueStructure, array()))->toArray() : array();
        $this->residual_value_for_Structure = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::ResidualValueForStructure, array()))->toArray() : array();
        $this->depicted_value_for_Structure = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::DepictedValueForStructure, array()))->toArray() : array();
        $this->cost_construction_for_Structure = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::CostOfConstructionValueForStructure, array()))->toArray() : array();
        $this->incomebasevalue_for_Structure = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::IncomeBaseValueForStructure, array()))->toArray() : array();
//        $this->estimatedValue = isset($propertyData->estimated_value) ? $propertyData->estimated_value : 0;
        $this->estimatedValue = isset($propertyData->estimated_value) ? $propertyData->estimated_value : 0;
        $this->status = isset($propertyData->status) ? $propertyData->status : 'Draft';
        $this->dimensionsMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::DimensionsMetaKey, array()))->toArray() : array();
        $this->addOnCosts = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::AddOnCostMetaKey, array()))->toArray() : array();
        $this->financialAcquisitionCost = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::FinancialAcquisitionCost, array()))->toArray() : array();
        $this->financialBuildUpCost = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::FinancialBuildUpCost, array()))->toArray() : array();
        $this->financialAddonCost = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::FinancialAddOnCost, array()))->toArray() : array();
        $this->StructureUnit = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::StructureUnit, array()))->toArray() : array();
        $this->OwnerShip = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::OwnerShip, array()))->toArray() : array();
        $this->ref_id = isset($propertyData->ref_id) ? $propertyData->ref_id : '';
        $this->PropertyEnvirementalMatters = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::PropertyEnvirementalMatters, array()))->toArray() : array();
        $this->PropertyAssumption = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::PropertyAssumption, array()))->toArray() : array();
        $this->PropertyRelventInformation = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::PropertyRelventInformation, array()))->toArray() : array();
        $this->PropertyPlanningPotential = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::PropertyPlanningPotential, array()))->toArray() : array();
        $this->PropertyInfoIncome = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::PropertyInfoIncome, array()))->toArray() : array();
        $this->StructureInfoIncome = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::StructureInfoIncome, array()))->toArray() : array();
        $this->AcquisitionCostPropertyInfo = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::AcquisitionCostPropertyInfo, array()))->toArray() : array();
        $this->PropertyInfoAddOnCost = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::PropertyInfoAddOnCost, array()))->toArray() : array();
        $this->staffData = $staff;
        $this->AccessibilityWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::AccessibilityText, array()))->toArray() : array();
        $this->AccessibilityTypeWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::AccessibilityTypeText, array()))->toArray() : array();
        $this->LandClassificationTypeWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::LandClassificationTypeText, array()))->toArray() : array();
        $this->LocationClassificationWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::LocationClassificationText, array()))->toArray() : array();
        $this->NoOfAccessRoadsWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::NoOfAccessRoadsText, array()))->toArray() : array();
        $this->AccessRoadTypeWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::AccessRoadTypeText, array()))->toArray() : array();
        $this->RecencyTransectionWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::RecencyTransectionText, array()))->toArray() : array();
        $this->LandshapeWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::LandshapeText, array()))->toArray() : array();
        $this->MaintenanceWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::MaintenanceText, array()))->toArray() : array();
        $this->NoOfBedroomWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::NoOfBedroomText, array()))->toArray() : array();
        $this->NoOfBathoomsWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::NoOfBathoomsText, array()))->toArray() : array();
        $this->FinishingQualityWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::FinishingQualityText, array()))->toArray() : array();
        $this->FloorlevelWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::FloorlevelText, array()))->toArray() : array();
        $this->ViewCategoryWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::ViewText, array()))->toArray() : array();
        $this->AmenitiesWeightage = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::AmenitiesText, array()))->toArray() : array();
        $this->ResidualValueForPropertyInfo = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::ResidualValueForPropertyInfo, array()))->toArray() : array();
        $this->DepictedValueForPropertyInfo = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::DepictedValueForPropertyInfo, array()))->toArray() : array();
        $this->CostOfConstructionValueForPropertyInfo = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::CostOfConstructionValueForPropertyInfo, array()))->toArray() : array();
        $this->IncomeBaseValueForPropertyInfo = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::IncomeBaseValueForPropertyInfo, array()))->toArray() : array();
        $this->landClassficationMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::LandClassificationTypeText, array()))->toArray() : array();
        $this->AccessibilityMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::AccessibilityText, array()))->toArray() : array();
        $this->AccessibilityTypeMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::AccessibilityTypeText, array()))->toArray() : array();
        $this->NoOfAccessRoadMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::NoOfAccessRoadsText, array()))->toArray() : array();
        $this->AccessRoadTypeMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::AccessRoadTypeText, array()))->toArray() : array();
        $this->RecencyTransectionMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::RecencyTransectionText, array()))->toArray() : array();
        $this->LocationClassificationMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::LocationClassificationText, array()))->toArray() : array();
        $this->RentalIncomePropertyInfoMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::RentalIncomePropertyInfo, array()))->toArray() : array();
        $this->EstimatedValuePropertyInfoMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::EstimatedValuePropertyInfo, array()))->toArray() : array();
        $this->ResidualValueForPropertyInfoMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::ResidualValueForPropertyInfo, array()))->toArray() : array();
        $this->DepictedValueForPropertyInfoMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::DepictedValueForPropertyInfo, array()))->toArray() : array();
        $this->CostOfConstructionValueForPropertyInfoMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::CostOfConstructionValueForPropertyInfo, array()))->toArray() : array();
        $this->IncomeBaseValueForPropertyInfoMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::IncomeBaseValueForPropertyInfo, array()))->toArray() : array();
        $this->landShapeMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::LandshapeText, array()))->toArray() : array();
        $this->PropertyFeatureMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::PropertyFeatureMetaKey, array()))->toArray() : array();
        $this->AmenitiesMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::AmenitiesText, array()))->toArray() : array();
        $this->SalePurchaseHistoryMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::SalePurchaseHistory, array()))->toArray() : array();
        $this->RentalIncomeHistoryMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::RentalIncomeHistory, array()))->toArray() : array();
        $this->ValuationsMeta = ($propertyData != null) ? optional($propertyData->getMeta(ValuationProperty::Valuations, array()))->toArray() : array();

        $this->surroundingFront = isset($propertyData->neighbour_front) ? $propertyData->neighbour_front : '';
        $this->surroundingBack = isset($propertyData->neighbour_back) ? $propertyData->neighbour_back : '';
        $this->surroundingLeft = isset($propertyData->left_side) ? $propertyData->left_side : '';
        $this->surroundingRight = isset($propertyData->right_side) ? $propertyData->right_side : '';
        $this->surroundingAdjacent = isset($propertyData->neighbour_adjacent) ? $propertyData->neighbour_adjacent : '';
        $this->propertyInfo = isset($propertyData->propertyInfo) ? $propertyData->propertyInfo : '';
        $this->description = isset($propertyData->description) ? $propertyData->description : '';


        return view($this->viewFolderPath . 'AddEditView', $this->data);
    }

    public function saveUpdateData(Request $request)
    {
        $data = array();
        $this->__customConstruct($data);
        $postFeatures = isset($_POST['feature'])?$_POST['feature']:array();
        $propertyFeatureEncode = $this->featureMetaData($postFeatures);
        if (ValuationProperty::find($request->id)) {
            $property = ValuationProperty::find($request->id);
        } else {
            $property = new ValuationProperty;
        }
        $property->title = isset($request->propertyTitle) ? $request->propertyTitle : '';
        $property->ref_id = isset($request->propertyRefId) ? $request->propertyRefId : '';
        $property->company_id = isset($data['companyId']) ? $data['companyId'] : 0;
        $property->type_id = isset($request->propertyType) ? $request->propertyType : 0;
        $property->class_id = isset($request->propertyClass) ? $request->propertyClass : 0;
        $property->categorization_id = isset($request->propertyCategorization) ? $request->propertyCategorization : 0;

        $property->neighbour_front = isset($request->front) ? $request->front : '';
        $property->neighbour_back = isset($request->back) ? $request->back : '';
        $property->left_side = isset($request->leftSide) ? $request->leftSide : '';
        $property->right_side = isset($request->rightSide) ? $request->rightSide : '';
        $property->neighbour_adjacent = isset($request->adjacent) ? $request->adjacent : '';

        $property->country_id = isset($request->country) ? $request->country : 0;
        $property->governorate_id = isset($request->governorate) ? $request->governorate : 0;
        $property->city_id = isset($request->city) ? $request->city : 0;
        $property->block_id = isset($request->block) ? $request->block : 0;
        $property->locality = isset($request->locality) ? $request->locality : '';
        $property->road = isset($request->address_road) ? $request->address_road : '';
        $property->latitude = isset($request->latitude) ? $request->latitude : '0';
        $property->longitude = isset($request->longitude) ? $request->longitude : '0';
        $property->plot_num = isset($request->plotNum) ? $request->plotNum : 0;

        $property->land_size = isset($request->landSize) ? $request->landSize : 0;
        if (isset($data['measurementUnit'])) {
            if ($data['measurementUnit'] == 'meter') {
                $property->sizes_in_meter_sq = isset($request->landSize) ? $request->landSize : 0;
                $property->sizes_in_sq_feet = isset($request->landSize) ? $request->landSize * 3.28084 : 0;
            } else if ($data['measurementUnit'] == 'feet') {
                $property->sizes_in_meter_sq = isset($request->landSize) ? $request->landSize / 3.28084 : 0;
                $property->sizes_in_sq_feet = isset($request->landSize) ? $request->landSize : 0;
            }
        }
        $property->municipalityCutting = isset($request->municipalityCutting) ? $request->municipalityCutting : 0;
        $property->land_structure_type = isset($request->land_structure_type) ? $request->land_structure_type : '';

        $property->buildup_sizes = isset($request->buildupSizes) ? $request->buildupSizes : 0;
        $property->front_elivation = isset($request->frontElivation) ? $request->frontElivation : 0;
        $property->common_area = isset($request->commonArea) ? $request->commonArea : 0;
        $property->depth = isset($request->depth) ? $request->depth : 0;
        $property->entrance_num = isset($request->entranceNum) ? $request->entranceNum : 0;
        $property->bldg_num = isset($request->BLDGNum) ? $request->BLDGNum : 0;
        $property->unit_num = isset($request->unitNum) ? $request->unitNum : 0;
        $property->name = isset($request->name) ? $request->name : 0;
        $property->use = isset($request->use) ? $request->use : 0;
        $property->age = isset($request->age) ? $request->age : 0;

        $property->description = isset($request->description) ? $request->description : '';
        $property->maintenance = isset($request->maintenance) ? $request->maintenance : 0;
        $property->no_of_rooms = isset($request->noOfRooms) ? $request->noOfRooms : 0;
        $property->no_of_roads = isset($request->noOfRoads) ? $request->noOfRoads : 0;
        $property->propertyInfo = isset($request->propertyInfo) ? $request->propertyInfo : '';

        $property->process_status_id = isset($request->process_status_id) ? $request->process_status_id : 0;


//        $property->coordinates = isset($request->coordinates) ? $request->coordinates : '';


//        $property->sizes_in_meter_sq = isset($request->sizeMeterSQ) ? $request->sizeMeterSQ : 0;
//        $property->sizes_in_sq_feet = isset($request->sizeSQFeet) ? $request->sizeSQFeet : 0;


//        $property->status = isset($request->status) ? $request->status : 0;

        $property->role = isset($request->role) ? $request->role : 0;
        $property->no_of_units = isset($request->noOfUnits) ? $request->noOfUnits : 0;
        $property->purchase_price = isset($request->purchasePrice) ? $request->purchasePrice : 0;
        $property->land_price = isset($request->landPrice) ? $request->landPrice : 0;
        $property->construction_price = isset($request->constructionPrice) ? $request->constructionPrice : 0;
        $property->renovation_price = isset($request->renovationPrice) ? $request->renovationPrice : 0;
        $property->rental_income = isset($request->rentalIncome) ? $request->rentalIncome : 0;
        $property->estimated_value = isset($request->estimatedValue) ? $request->estimatedValue : 0;
        $property->status = isset($request->propertyStatus) ? $request->propertyStatus : 'Draft';


        $property->save();
        $propertyId = $property->id;

        if ($request->hasFile('image')) {
            foreach ($request->image as $key => $img) {
                $propertyImg = new ValuationPropertyMedia;
                $imgName = Files::upload($img, 'property-img', 300);
                $propertyImg->property_id = $propertyId;
                $propertyImg->media_name = $imgName;
                $propertyImg->save();
            }

        }

        $bathRoomUnitInfoWeightageArray = array();
        $finishingQualityUnitInfoWeightageArray = array();
        $unitInfoMaintenanceWeightageArray = array();
        $unitInfoFloorLevelWeightageArray = array();
        $unitInfoViewWeightageArray = array();

        $landClassificationWeightage = isset($request->LandClassification) ? $request->LandClassification : 0;
        $landClassificationWeightageArray = array();
        $landClassificationWeightageArray[] = $landClassificationWeightage;

        $landInfoAccessibilityWeightage = isset($request->landInfoAccessibility) ? $request->landInfoAccessibility : 0;
        $landInfoAccessibilityWeightageArray = array();
        $landInfoAccessibilityWeightageArray[] = $landInfoAccessibilityWeightage;

        $landInfoAccessibilityTypeWeightage = isset($request->landInfoAccessibilityType) ? $request->landInfoAccessibilityType : 0;
        $landInfoAccessibilityTypeWeightageArray = array();
        $landInfoAccessibilityTypeWeightageArray[] = $landInfoAccessibilityTypeWeightage;

        $landInfoRoadAccessWeightage = isset($request->landInfoRoadAccess) ? $request->landInfoRoadAccess : 0;
        $landInfoRoadAccessWeightageArray = array();
        $landInfoRoadAccessWeightageArray[] = $landInfoRoadAccessWeightage;

        $landRoadAccessTypeWeightage = isset($request->landRoadAccessType) ? $request->landRoadAccessType : 0;
        $landRoadAccessTypeWeightageArray = array();
        $landRoadAccessTypeWeightageArray[] = $landRoadAccessTypeWeightage;

        $landInfoRecencyWeightage = isset($request->landInfoRecency) ? $request->landInfoRecency : 0;
        $landInfoRecencyWeightageArray = array();
        $landInfoRecencyWeightageArray[] = $landInfoRecencyWeightage;

        $addressLocationClassificationWeightage = isset($request->addressLocationClassification) ? $request->addressLocationClassification : 0;
        $addressLocationClassificationWeightageArray = array();
        $addressLocationClassificationWeightageArray[] = $addressLocationClassificationWeightage;

        $residual_value_for_property_infoWeightage = isset($request->residual_value_for_property_info) ? $request->residual_value_for_property_info : '';
        $residual_value_for_property_infoWeightageArray = array();
        $residual_value_for_property_infoWeightageArray[] = $residual_value_for_property_infoWeightage;

        $depicted_value_for_property_infoWeightage = isset($request->depicted_value_for_property_info) ? $request->depicted_value_for_property_info : '';
        $depicted_value_for_property_infoWeightageArray = array();
        $depicted_value_for_property_infoWeightageArray[] = $depicted_value_for_property_infoWeightage;

        $cost_construction_for_property_infoWeightage = isset($request->cost_construction_for_property_info) ? $request->cost_construction_for_property_info : '';
        $cost_construction_for_property_infoWeightageArray = array();
        $cost_construction_for_property_infoWeightageArray[] = $cost_construction_for_property_infoWeightage;

        $incomebasevalue_for_property_infoWeightage = isset($request->incomebasevalue_for_property_info) ? $request->incomebasevalue_for_property_info : '';
        $incomebasevalue_for_property_infoWeightageArray = array();
        $incomebasevalue_for_property_infoWeightageArray[] = $incomebasevalue_for_property_infoWeightage;

        $landInfoLandShapeWeightage = isset($request->landInfoLandShape) ? $request->landInfoLandShape : '';
        $landInfoLandShapeWeightageArray = array();
        $landInfoLandShapeWeightageArray[] = $landInfoLandShapeWeightage;

        $aminatieForStructureInfoWeightage = isset($request->aminatie) ? $request->aminatie : array();
        $aminatieForStructureInfoWeightageArray = array();
        $aminatieForStructureInfoWeightageArray[] = $aminatieForStructureInfoWeightage;

        $rentalIncomeStructureWeightage = isset($request->rentalIncomeStructure) ? $request->rentalIncomeStructure : '';
        $rentalIncomeStructureWeightageArray = array();
        $rentalIncomeStructureWeightageArray[] = $rentalIncomeStructureWeightage;

        $estimatedValueStructureWeightage = isset($request->estimatedValueStructure) ? $request->estimatedValueStructure : '';
        $estimatedValueStructureWeightageArray = array();
        $estimatedValueStructureWeightageArray[] = $estimatedValueStructureWeightage;

        $residual_value_for_StructureWeightage = isset($request->residual_value_for_Structure) ? $request->residual_value_for_Structure : '';
        $residual_value_for_StructureWeightageArray = array();
        $residual_value_for_StructureWeightageArray[] = $residual_value_for_StructureWeightage;

        $depicted_value_for_StructureWeightage = isset($request->depicted_value_for_Structure) ? $request->depicted_value_for_Structure : '';
        $depicted_value_for_StructureWeightageArray = array();
        $depicted_value_for_StructureWeightageArray[] = $depicted_value_for_StructureWeightage;

        $cost_construction_for_StructureWeightage = isset($request->cost_construction_for_Structure) ? $request->cost_construction_for_Structure : '';
        $cost_construction_for_StructureWeightageArray = array();
        $cost_construction_for_StructureWeightageArray[] = $cost_construction_for_StructureWeightage;

        $incomebasevalue_for_StructureWeightage = isset($request->incomebasevalue_for_Structure) ? $request->incomebasevalue_for_Structure : '';
        $incomebasevalue_for_StructureWeightageArray = array();
        $incomebasevalue_for_StructureWeightageArray[] = $incomebasevalue_for_StructureWeightage;

        $salePurchaseHistory = isset($request->salePurchaseHistory) ? $request->salePurchaseHistory : '';
        $salePurchaseHistoryArray = array();
        $salePurchaseHistoryArray[] = $salePurchaseHistory;

        $rentalIncomeHistory = isset($request->rentalIncomeHistory) ? $request->rentalIncomeHistory : '';
        $rentalIncomeHistoryArray = array();
        $rentalIncomeHistoryArray[] = $rentalIncomeHistory;

        $valuations = isset($request->valuations) ? $request->valuations : '';
        $valuationsArray = array();
        $valuationsArray[] = $valuations;

        $rentalIncomePropertyInfo = isset($request->rentalIncomePropertyInfo) ? $request->rentalIncomePropertyInfo : '';
        $rentalIncomePropertyInfoArray = array();
        $rentalIncomePropertyInfoArray[] = $rentalIncomePropertyInfo;

        $estimatedValuePropertyInfo = isset($request->estimatedValuePropertyInfo) ? $request->estimatedValuePropertyInfo : '';
        $estimatedValuePropertyInfoArray = array();
        $estimatedValuePropertyInfoArray[] = $estimatedValuePropertyInfo;

        $ValuationPropertyXref = new ValuationPropertyXref();
        $unitTypeArray = array();
        $bedRoomsUnitInfoWeightageArray = array();

        if (isset($request->id) && $request->id > 0) {
            $getAllUnit = $ValuationPropertyXref->getAllUnit($request->id);
            if (!empty($getAllUnit)) {
                foreach ($getAllUnit as $unitObj) {
                    if (!empty($unitObj->unit_id) && $unitObj->unit_id > 0) {
                        $propertyObj = ValuationProperty::find($unitObj->unit_id);
                        $key = $unitObj->unit_id;
                        $unitTypeName = 'unitType-' . $key;
                        $bedRoomsUnitInfoName = 'bedRoomsUnitInfo-' . $key;
                        $bathRoomUnitInfoName = 'bathRoomUnitInfo-' . $key;
                        $finishingQualityUnitInfoName = 'finishingQualityUnitInfo-' . $key;
                        $unitInfoMaintenanceName = 'unitInfoMaintenance-' . $key;
                        $unitInfoFloorLevelName = 'unitInfoFloorLevel-' . $key;
                        $unitInfoViewName = 'unitInfoView-' . $key;
                        $unitInfoConditionName = 'unitInfoCondition-' . $key;
                        $unitInfoStylingName = 'unitInfoStyling-' . $key;
                        $unitInfoStatusName = 'unitInfoStatus-' . $key;
                        $unitInfoInteriorStatusName = 'unitInfoInteriorStatus-' . $key;
                        $rentalIncomeUnitInfoName = 'rentalIncomeUnitInfo-' . $key;
                        $depicted_value_for_UnitInfoName = 'depicted_value_for_UnitInfo-' . $key;
                        $estimatedValueUnitInfoName = 'estimatedValueUnitInfo-' . $key;
                        $residual_value_for_UnitInfoName = 'residual_value_for_UnitInfo-' . $key;
                        $cost_construction_for_UnitInfoName = 'cost_construction_for_UnitInfo-' . $key;
                        $incomebasevalue_for_UnitInfoName = 'incomebasevalue_for_UnitInfo-' . $key;
                        $unitInfofloorName = 'unitInfofloor-' . $key;

                        $unitType = isset($request->$unitTypeName) ? $request->$unitTypeName : '';
                        $unitTypeArray = array();
                        $unitTypeArray[] = $unitType;

                        $bedRoomsUnitInfoWeightage = isset($request->$bedRoomsUnitInfoName) ? $request->$bedRoomsUnitInfoName : 0;
                        $bedRoomsUnitInfoWeightageArray = array();
                        $bedRoomsUnitInfoWeightageArray[] = $bedRoomsUnitInfoWeightage;

                        $bathRoomUnitInfoWeightage = isset($request->$bathRoomUnitInfoName) ? $request->$bathRoomUnitInfoName : 0;
                        $bathRoomUnitInfoWeightageArray = array();
                        $bathRoomUnitInfoWeightageArray[] = $bathRoomUnitInfoWeightage;

                        $finishingQualityUnitInfoWeightage = isset($request->$finishingQualityUnitInfoName) ? $request->$finishingQualityUnitInfoName : 0;
                        $finishingQualityUnitInfoWeightageArray = array();
                        $finishingQualityUnitInfoWeightageArray[] = $finishingQualityUnitInfoWeightage;

                        $unitInfoMaintenanceWeightage = isset($request->$unitInfoMaintenanceName) ? $request->$unitInfoMaintenanceName : 0;
                        $unitInfoMaintenanceWeightageArray = array();
                        $unitInfoMaintenanceWeightageArray[] = $unitInfoMaintenanceWeightage;

                        $unitInfoFloorLevelWeightage = isset($request->$unitInfoFloorLevelName) ? $request->$unitInfoFloorLevelName : 0;
                        $unitInfoFloorLevelWeightageArray = array();
                        $unitInfoFloorLevelWeightageArray[] = $unitInfoFloorLevelWeightage;

                        $unitInfoViewWeightage = isset($request->$unitInfoViewName) ? $request->$unitInfoViewName : 0;
                        $unitInfoViewWeightageArray = array();
                        $unitInfoViewWeightageArray[] = $unitInfoViewWeightage;

                        $unitInfoCondition = isset($request->$unitInfoConditionName) ? $request->$unitInfoConditionName : '';
                        $unitInfoConditionArray = array();
                        $unitInfoConditionArray[] = $unitInfoCondition;

                        $unitInfoStyling = isset($request->$unitInfoStylingName) ? $request->$unitInfoStylingName : '';
                        $unitInfoStylingArray = array();
                        $unitInfoStylingArray[] = $unitInfoStyling;

                        $unitInfoStatus = isset($request->$unitInfoStatusName) ? $request->$unitInfoStatusName : '';
                        $unitInfoStatusArray = array();
                        $unitInfoStatusArray[] = $unitInfoStatus;

                        $unitInfoInteriorStatus = isset($request->$unitInfoInteriorStatusName) ? $request->$unitInfoInteriorStatusName : '';
                        $unitInfoInteriorStatusArray = array();
                        $unitInfoInteriorStatusArray[] = $unitInfoInteriorStatus;

                        $rentalIncomeUnitInfo = isset($request->$rentalIncomeUnitInfoName) ? $request->$rentalIncomeUnitInfoName : '';
                        $rentalIncomeUnitInfoArray = array();
                        $rentalIncomeUnitInfoArray[] = $rentalIncomeUnitInfo;

                        $depicted_value_for_UnitInfo = isset($request->$depicted_value_for_UnitInfoName) ? $request->$depicted_value_for_UnitInfoName : '';
                        $depicted_value_for_UnitInfoArray = array();
                        $depicted_value_for_UnitInfoArray[] = $depicted_value_for_UnitInfo;

                        $estimatedValueUnitInfo = isset($request->$estimatedValueUnitInfoName) ? $request->$estimatedValueUnitInfoName : '';
                        $estimatedValueUnitInfoArray = array();
                        $estimatedValueUnitInfoArray[] = $estimatedValueUnitInfo;

                        $residual_value_for_UnitInfo = isset($request->$residual_value_for_UnitInfoName) ? $request->$residual_value_for_UnitInfoName : '';
                        $residual_value_for_UnitInfoArray = array();
                        $residual_value_for_UnitInfoArray[] = $residual_value_for_UnitInfo;

                        $cost_construction_for_UnitInfo = isset($request->$cost_construction_for_UnitInfoName) ? $request->$cost_construction_for_UnitInfoName : '';
                        $cost_construction_for_UnitInfoArray = array();
                        $cost_construction_for_UnitInfoArray[] = $cost_construction_for_UnitInfo;

                        $incomebasevalue_for_UnitInfo = isset($request->$incomebasevalue_for_UnitInfoName) ? $request->$incomebasevalue_for_UnitInfoName : '';
                        $incomebasevalue_for_UnitInfoArray = array();
                        $incomebasevalue_for_UnitInfoArray[] = $incomebasevalue_for_UnitInfo;

                        $unitInfofloor = isset($request->$unitInfofloorName) ? $request->$unitInfofloorName : '';
                        $unitInfofloorArray = array();
                        $unitInfofloorArray[] = $unitInfofloor;

                        //UnitInfoAcquisitionCost
                        $aquDateUnitInfoName = 'aqu_Date_unit_info-' . $key;
                        $aquTransectionTypeUnitInfoName = 'aqu_transection_type_unit_info-' . $key;
                        $aquDescriptionUnitInfoName = 'aqu_description_unit_info-' . $key;
                        $acqLandPriceUnitInfoName = 'acqlandPrice_unit_info-' . $key;
                        $currencyCodeUnitInfoName = 'currencyCode_unit_info-' . $key;
                        $aquDateUnitInfo = isset($request->$aquDateUnitInfoName) ? $request->$aquDateUnitInfoName : array();
                        $aquTransectionTypeUnitInfo = isset($request->$aquTransectionTypeUnitInfoName) ? $request->$aquTransectionTypeUnitInfoName : array();
                        $aquDescriptionUnitInfo = isset($request->$aquDescriptionUnitInfoName) ? $request->$aquDescriptionUnitInfoName : array();
                        $acqLandPriceUnitInfo = isset($request->$acqLandPriceUnitInfoName) ? $request->$acqLandPriceUnitInfoName : array();
                        $acqLandCurrencyCodeUnitInfo = isset($request->$currencyCodeUnitInfoName) ? $request->$currencyCodeUnitInfoName : array();
                        $acqDataArrayUnitInfo = array();
                        if (!empty($aquDateUnitInfo) && !empty($aquTransectionTypeUnitInfo) && !empty($aquDescriptionUnitInfo) && !empty($acqLandPriceUnitInfo)) {
                            foreach ($aquDateUnitInfo as $key => $obj) {
                                if (!empty($aquDateUnitInfo[$key]) && !empty($aquTransectionTypeUnitInfo[$key]) && !empty($aquDescriptionUnitInfo[$key]) && !empty($acqLandPriceUnitInfo[$key])) {
                                    $acqDataArrayUnitInfo[] = array('date' => $aquDateUnitInfo[$key], 'trnsectionType' => $aquTransectionTypeUnitInfo[$key], 'description' => $aquDescriptionUnitInfo[$key], 'price' => $acqLandPriceUnitInfo[$key], 'currencyCode' => $acqLandCurrencyCodeUnitInfo[$key]);
                                }
                            }
                        }
                        $acqTransectionUnitInfoData = json_encode($acqDataArrayUnitInfo);
                        //UnitInfoAcquisitionCost
                        //Unit InfoAddOn cost
                        $addonCostDateUnitInfoName = 'addon_cost_Date_unit_info-' . $key;
                        $addonTransectionTypeUnitInfoName = 'addon_transection_type_unit_info-' . $key;
                        $addonDescriptionUnitInfoName = 'addon_description_unit_info-' . $key;
                        $addonPriceUnitInfoName = 'addonPrice_unit_info-' . $key;
                        $addonCurrencyCodeUnitInfoName = 'addonCurrencyCode_unit_info-' . $key;
                        $addOnCostDateUnitInfo = isset($request->$addonCostDateUnitInfoName) ? $request->$addonCostDateUnitInfoName : array();
                        $addoncostTransectionTypeUnitInfo = isset($request->$addonTransectionTypeUnitInfoName) ? $request->$addonTransectionTypeUnitInfoName : array();
                        $addoncostDescriptionUnitInfo = isset($request->$addonDescriptionUnitInfoName) ? $request->$addonDescriptionUnitInfoName : array();
                        $addoncostPriceUnitInfo = isset($request->$addonPriceUnitInfoName) ? $request->$addonPriceUnitInfoName : array();
                        $addonCurrencyCodeUnitInfo = isset($request->$addonCurrencyCodeUnitInfoName) ? $request->$addonCurrencyCodeUnitInfoName : array();
                        $addonCostDataArrayUnitInfo = array();
                        if (!empty($addOnCostDateUnitInfo) && !empty($addoncostTransectionTypeUnitInfo) && !empty($addoncostDescriptionUnitInfo) && !empty($addoncostPriceUnitInfo)) {
                            foreach ($addOnCostDateUnitInfo as $key => $obj) {
                                if (!empty($addOnCostDateUnitInfo[$key]) && !empty($addoncostTransectionTypeUnitInfo[$key]) && !empty($addoncostDescriptionUnitInfo[$key]) && !empty($addoncostPriceUnitInfo[$key])) {
                                    $addonCostDataArrayUnitInfo[] = array('date' => $addOnCostDateUnitInfo[$key], 'trnsectionType' => $addoncostTransectionTypeUnitInfo[$key], 'description' => $addoncostDescriptionUnitInfo[$key], 'price' => $addoncostPriceUnitInfo[$key], 'currencyCode' => $addonCurrencyCodeUnitInfo[$key]);
                                }
                            }
                        }
                        $addonTransectionDataUnitInfo = json_encode($addonCostDataArrayUnitInfo);
                        //Unit InfoAddOn cost
                        //Unit info income
                        $incomeDateUnitInfoName = 'income_date_Unit_info-' . $key;
                        $typeUnitInfoName = 'type_Unit_info-' . $key;
                        $incomeDescriptionUnitInfoName = 'income_description_Unit_info-' . $key;
                        $incomePriceUnitInfoName = 'incomePrice_Unit_info-' . $key;
                        $incomeCurrencyCodeUnitInfoName = 'incomeCurrencyCode_Unit_info-' . $key;
                        $incomeDateUnitInfo = isset($request->$incomeDateUnitInfoName) ? $request->$incomeDateUnitInfoName : array();
                        $typeUnitInfo = isset($request->$typeUnitInfoName) ? $request->$typeUnitInfoName : array();
                        $incomeDescriptionUnitInfo = isset($request->$incomeDescriptionUnitInfoName) ? $request->$incomeDescriptionUnitInfoName : array();
                        $incomePriceUnitInfo = isset($request->$incomePriceUnitInfoName) ? $request->$incomePriceUnitInfoName : array();
                        $incomeCurrencyCodeUnitInfo = isset($request->$incomeCurrencyCodeUnitInfoName) ? $request->$incomeCurrencyCodeUnitInfoName : array();
                        $incomeDataArrayUnitInfo = array();
                        if (!empty($incomeDateUnitInfo) && !empty($typeUnitInfo) && !empty($incomeDescriptionUnitInfo) && !empty($incomePriceUnitInfo)) {
                            foreach ($incomeDateUnitInfo as $key => $obj) {
                                if (!empty($incomeDateUnitInfo[$key]) && !empty($typeUnitInfo[$key]) && !empty($incomeDescriptionUnitInfo[$key]) && !empty($incomePriceUnitInfo[$key])) {
                                    $incomeDataArrayUnitInfo[] = array('date' => $incomeDateUnitInfo[$key], 'trnsectionType' => $typeUnitInfo[$key], 'description' => $incomeDescriptionUnitInfo[$key], 'price' => $incomePriceUnitInfo[$key], 'currencyCode' => $incomeCurrencyCodeUnitInfo[$key]);
                                }

                            }
                        }
                        $incomeJsonDataUnitInfo = json_encode($incomeDataArrayUnitInfo);
                        //Unit info income
                        $updatePropertyMetaUnit = array();
                        $updatePropertyMetaUnit[ValuationProperty::UnitType . '-' . $key] = json_encode($unitTypeArray);
                        $updatePropertyMetaUnit[ValuationProperty::NoOfBedroomText . '-' . $key] = json_encode($bedRoomsUnitInfoWeightageArray);
                        $updatePropertyMetaUnit[ValuationProperty::NoOfBathoomsText . '-' . $key] = json_encode($bathRoomUnitInfoWeightageArray);
                        $updatePropertyMetaUnit[ValuationProperty::FinishingQualityText . '-' . $key] = json_encode($finishingQualityUnitInfoWeightageArray);
                        $updatePropertyMetaUnit[ValuationProperty::MaintenanceText . '-' . $key] = json_encode($unitInfoMaintenanceWeightageArray);
                        $updatePropertyMetaUnit[ValuationProperty::FloorlevelText . '-' . $key] = json_encode($unitInfoFloorLevelWeightageArray);
                        $updatePropertyMetaUnit[ValuationProperty::UnitInfoView . '-' . $key] = json_encode($unitInfoViewWeightageArray);
                        $updatePropertyMetaUnit[ValuationProperty::UnitInfoCondition . '-' . $key] = json_encode($unitInfoConditionArray);
                        $updatePropertyMetaUnit[ValuationProperty::UnitInfoStyling . '-' . $key] = json_encode($unitInfoStylingArray);
                        $updatePropertyMetaUnit[ValuationProperty::UnitInfoStatus . '-' . $key] = json_encode($unitInfoStatusArray);
                        $updatePropertyMetaUnit[ValuationProperty::UnitInfoInteriorStatus . '-' . $key] = json_encode($unitInfoInteriorStatusArray);
                        $updatePropertyMetaUnit[ValuationProperty::UnitInfoFloor . '-' . $key] = json_encode($unitInfofloorArray);
                        $updatePropertyMetaUnit[ValuationProperty::RentalIncomeUnitInfo . '-' . $key] = json_encode($rentalIncomeUnitInfoArray);
                        $updatePropertyMetaUnit[ValuationProperty::DepictedValueUnitInfo . '-' . $key] = json_encode($depicted_value_for_UnitInfoArray);
                        $updatePropertyMetaUnit[ValuationProperty::EstimatedValueUnitInfo . '-' . $key] = json_encode($estimatedValueUnitInfoArray);
                        $updatePropertyMetaUnit[ValuationProperty::ResidualValueUnitInfo . '-' . $key] = json_encode($residual_value_for_UnitInfoArray);
                        $updatePropertyMetaUnit[ValuationProperty::CostOfConstructionValueUnitInfo . '-' . $key] = json_encode($cost_construction_for_UnitInfoArray);
                        $updatePropertyMetaUnit[ValuationProperty::IncomeBaseValueUnitInfo . '-' . $key] = json_encode($incomebasevalue_for_UnitInfoArray);
                        $updatePropertyMetaUnit[ValuationProperty::UnitInfoAcquisitionCost . '-' . $key] = $acqTransectionUnitInfoData;
                        $updatePropertyMetaUnit[ValuationProperty::UnitInfoAddOnCost . '-' . $key] = $addonTransectionDataUnitInfo;
                        $updatePropertyMetaUnit[ValuationProperty::UnitInfoIncome . '-' . $key] = $incomeJsonDataUnitInfo;

                        $logUnit = array('propertyInfo' => $propertyObj, 'meta' => $updatePropertyMetaUnit);
                        $updatePropertyMetaUnit[ValuationProperty::PropertyLog] = json_encode($logUnit);
                        $propertyObj->setMeta($updatePropertyMetaUnit);


//                    $logArrayUnit();
//
//                    $propertyObj->setMeta($logArrayUnit);
                    }
                }
            }

        }


//        $dimensions = isset($request->dimensions)?$request->dimensions:array();
//        $dimensionsEncode = json_encode($dimensions);
//        $addOnCosts = isset($request->addOnCosts)?$request->addOnCosts:array();
//        $addOnCostsEncode = json_encode($addOnCosts);
        //FinancialInfoAcquisitionCost
        $aqu_Date = isset($request->aqu_Date) ? $request->aqu_Date : array();
        $aqu_transection_type = isset($request->aqu_transection_type) ? $request->aqu_transection_type : array();
        $aqu_description = isset($request->aqu_description) ? $request->aqu_description : array();
        $acqlandPrice = isset($request->acqlandPrice) ? $request->acqlandPrice : array();
        $acqlandCurrencyCode = isset($request->currencyCode) ? $request->currencyCode : array();
        $acqDataArray = array();
        if (!empty($aqu_Date) && !empty($aqu_transection_type) && !empty($aqu_description) && !empty($acqlandPrice)) {
            foreach ($aqu_Date as $key => $obj) {
                if (!empty($aqu_Date[$key]) && !empty($aqu_transection_type[$key]) && !empty($aqu_description[$key]) && !empty($acqlandPrice[$key])) {
                    $acqDataArray[] = array('date' => $aqu_Date[$key], 'trnsectionType' => $aqu_transection_type[$key], 'description' => $aqu_description[$key], 'price' => $acqlandPrice[$key], 'currencyCode' => $acqlandCurrencyCode[$key]);
                }
            }
        }
        $acqtransectionData = json_encode($acqDataArray);

        //FinancialInfoAcquisitionCostPropertyInfo
        $aqu_Date_properyInfoTab = isset($request->aqu_Date_properyInfoTab) ? $request->aqu_Date_properyInfoTab : array();
        $aqu_transection_type_properyInfoTab = isset($request->aqu_transection_type_properyInfoTab) ? $request->aqu_transection_type_properyInfoTab : array();
        $aqu_description_properyInfoTab = isset($request->aqu_description_properyInfoTab) ? $request->aqu_description_properyInfoTab : array();
        $acqlandPrice_properyInfoTab = isset($request->acqlandPrice_properyInfoTab) ? $request->acqlandPrice_properyInfoTab : array();
        $acqlandCurrencyCode_properyInfoTab = isset($request->currencyCode_properyInfoTab) ? $request->currencyCode_properyInfoTab : array();
        $acqDataArray_properyInfoTab = array();
        if (!empty($aqu_Date_properyInfoTab) && !empty($aqu_transection_type_properyInfoTab) && !empty($aqu_description_properyInfoTab) && !empty($acqlandPrice_properyInfoTab)) {
            foreach ($aqu_Date_properyInfoTab as $key => $obj) {
                if (!empty($aqu_Date_properyInfoTab[$key]) && !empty($aqu_transection_type_properyInfoTab[$key]) && !empty($aqu_description_properyInfoTab[$key]) && !empty($acqlandPrice_properyInfoTab[$key])) {
                    $acqDataArray_properyInfoTab[] = array('date' => $aqu_Date_properyInfoTab[$key], 'trnsectionType' => $aqu_transection_type_properyInfoTab[$key], 'description' => $aqu_description_properyInfoTab[$key], 'price' => $acqlandPrice_properyInfoTab[$key], 'currencyCode' => $acqlandCurrencyCode_properyInfoTab[$key]);
                }
            }
        }
        $acqtransectionData_properyInfoTab = json_encode($acqDataArray_properyInfoTab);
        //Financial Build up cost
        $buildupcost_cost_Date = isset($request->build_up_Date) ? $request->build_up_Date : array();
        $buildupcost_transection_type = isset($request->buildup_transection_type) ? $request->buildup_transection_type : array();
        $buildupcost_description = isset($request->buildup_description) ? $request->buildup_description : array();
        $buildupcostPrice = isset($request->buildupPrice) ? $request->buildupPrice : array();
        $buildupCurrencyCode = isset($request->buildupCurrencyCode) ? $request->buildupCurrencyCode : array();
        $buildUpCostDataArray = array();
        if (!empty($buildupcost_cost_Date) && !empty($buildupcost_transection_type) && !empty($buildupcost_description) && !empty($buildupcostPrice)) {
            foreach ($buildupcost_cost_Date as $key => $obj) {
                if (!empty($buildupcost_cost_Date[$key]) && !empty($buildupcost_transection_type[$key]) && !empty($buildupcost_description[$key]) && !empty($buildupcostPrice[$key])) {
                    $buildUpCostDataArray[] = array('date' => $buildupcost_cost_Date[$key], 'trnsectionType' => $buildupcost_transection_type[$key], 'description' => $buildupcost_description[$key], 'price' => $buildupcostPrice[$key], 'currencyCode' => $buildupCurrencyCode[$key]);
                }
            }
        }
        $buildUpTransectionData = json_encode($buildUpCostDataArray);
        //Financial AddOn cost
        $addOn_cost_Date = isset($request->addon_cost_Date) ? $request->addon_cost_Date : array();
        $addoncost_transection_type = isset($request->addon_transection_type) ? $request->addon_transection_type : array();
        $addoncost_description = isset($request->addon_description) ? $request->addon_description : array();
        $addoncostPrice = isset($request->addonPrice) ? $request->addonPrice : array();
        $addonCurrencyCode = isset($request->addonCurrencyCode) ? $request->addonCurrencyCode : array();
        $addonCostDataArray = array();
        if (!empty($addOn_cost_Date) && !empty($addoncost_transection_type) && !empty($addoncost_description) && !empty($addoncostPrice)) {
            foreach ($addOn_cost_Date as $key => $obj) {
                if (!empty($addOn_cost_Date[$key]) && !empty($addoncost_transection_type[$key]) && !empty($addoncost_description[$key]) && !empty($addoncostPrice[$key])) {
                    $addonCostDataArray[] = array('date' => $addOn_cost_Date[$key], 'trnsectionType' => $addoncost_transection_type[$key], 'description' => $addoncost_description[$key], 'price' => $addoncostPrice[$key], 'currencyCode' => $addonCurrencyCode[$key]);
                }

            }
        }
        $addonTransectionData = json_encode($addonCostDataArray);
        //Property info AddOn cost
        $addOn_cost_Date_property_info = isset($request->addon_cost_Date_property_info) ? $request->addon_cost_Date_property_info : array();
        $addoncost_transection_type_property_info = isset($request->addon_transection_type_property_info) ? $request->addon_transection_type_property_info : array();
        $addoncost_description_property_info = isset($request->addon_description_property_info) ? $request->addon_description_property_info : array();
        $addoncostPrice_property_info = isset($request->addonPrice_property_info) ? $request->addonPrice_property_info : array();
        $addonCurrencyCode_property_info = isset($request->addonCurrencyCode_property_info) ? $request->addonCurrencyCode_property_info : array();
        $addonCostDataArray_property_info = array();
        if (!empty($addOn_cost_Date_property_info) && !empty($addoncost_transection_type_property_info) && !empty($addoncost_description_property_info) && !empty($addoncostPrice_property_info)) {
            foreach ($addOn_cost_Date_property_info as $key => $obj) {
                if (!empty($addOn_cost_Date_property_info[$key]) && !empty($addoncost_transection_type_property_info[$key]) && !empty($addoncost_description_property_info[$key]) && !empty($addoncostPrice_property_info[$key])) {
                    $addonCostDataArray_property_info[] = array('date' => $addOn_cost_Date_property_info[$key], 'trnsectionType' => $addoncost_transection_type_property_info[$key], 'description' => $addoncost_description_property_info[$key], 'price' => $addoncostPrice_property_info[$key], 'currencyCode' => $addonCurrencyCode_property_info[$key]);
                }

            }
        }
        $addonTransectionData_property_info = json_encode($addonCostDataArray_property_info);

        //Property info income
        $income_date_property_info = isset($request->income_date_property_info) ? $request->income_date_property_info : array();
        $type_property_info = isset($request->type_property_info) ? $request->type_property_info : array();
        $income_description_property_info = isset($request->income_description_property_info) ? $request->income_description_property_info : array();
        $incomePrice_property_info = isset($request->incomePrice_property_info) ? $request->incomePrice_property_info : array();
        $incomeCurrencyCode__property_info = isset($request->incomeCurrencyCode_property_info) ? $request->incomeCurrencyCode_property_info : array();
        $incomeDataArray_property_info = array();
        if (!empty($income_date_property_info) && !empty($type_property_info) && !empty($income_description_property_info) && !empty($incomePrice_property_info)) {
            foreach ($income_date_property_info as $key => $obj) {
                if (!empty($income_date_property_info[$key]) && !empty($type_property_info[$key]) && !empty($income_description_property_info[$key]) && !empty($incomePrice_property_info[$key])) {
                    $incomeDataArray_property_info[] = array('date' => $income_date_property_info[$key], 'trnsectionType' => $type_property_info[$key], 'description' => $income_description_property_info[$key], 'price' => $incomePrice_property_info[$key], 'currencyCode' => $incomeCurrencyCode__property_info[$key]);
                }

            }
        }
        $incomejsonData_property_info = json_encode($incomeDataArray_property_info);

        //Structure income
        $income_date_structure_info = isset($request->income_date_structure_info) ? $request->income_date_structure_info : array();
        $type_structure_info = isset($request->type_structure_info) ? $request->type_structure_info : array();
        $income_description_structure_info = isset($request->income_description_structure_info) ? $request->income_description_structure_info : array();
        $incomePrice_structure_info = isset($request->incomePrice_structure_info) ? $request->incomePrice_structure_info : array();
        $incomeCurrencyCode_structure_info = isset($request->incomeCurrencyCode_structure_info) ? $request->incomeCurrencyCode_structure_info : array();
        $incomeDataArray_structure_info = array();
        if (!empty($income_date_structure_info) && !empty($type_structure_info) && !empty($income_description_structure_info) && !empty($incomePrice_structure_info)) {
            foreach ($income_date_structure_info as $key => $obj) {
                if (!empty($income_date_structure_info[$key]) && !empty($type_structure_info[$key]) && !empty($income_description_structure_info[$key]) && !empty($incomePrice_structure_info[$key])) {
                    $incomeDataArray_structure_info[] = array('date' => $income_date_structure_info[$key], 'trnsectionType' => $type_structure_info[$key], 'description' => $income_description_structure_info[$key], 'price' => $incomePrice_structure_info[$key], 'currencyCode' => $incomeCurrencyCode_structure_info[$key]);
                }

            }
        }
        $incomejsonData_structure_info = json_encode($incomeDataArray_structure_info);
        //Structure Unit
        $structureUnitType = isset($request->structureUnitType) ? $request->structureUnitType : array();
        $structureUnitId = isset($request->structureUnitId) ? $request->structureUnitId : array();
        $structureUnitDescription = isset($request->structureUnitDescription) ? $request->structureUnitDescription : array();

        $structureUnitArray = array();
        if (!empty($structureUnitType) && !empty($structureUnitId) && !empty($structureUnitDescription)) {
            foreach ($structureUnitType as $unitKey => $strUnit) {
                if (!empty($structureUnitType[$unitKey]) && !empty($structureUnitId[$unitKey]) && !empty($structureUnitDescription[$unitKey])) {
                    $structureUnitArray[] = array('unitType' => $structureUnitType[$unitKey], 'unitId' => $structureUnitId[$unitKey], 'unitDescription' => $structureUnitDescription[$unitKey]);
                }
            }
        }
        $structureUnitJsonData = json_encode($structureUnitArray);

        //Ownership
        $onwership_cpr_no = isset($request->onwership_cpr_no) ? $request->onwership_cpr_no : array();
        $onwership_passport_no = isset($request->onwership_passport_no) ? $request->onwership_passport_no : array();
        $onwership_first_name = isset($request->onwership_first_name) ? $request->onwership_first_name : array();
        $onwership_last_name = isset($request->onwership_last_name) ? $request->onwership_last_name : array();
        $onwership_email = isset($request->onwership_email) ? $request->onwership_email : array();
        $onwership_phone = isset($request->onwership_phone) ? $request->onwership_phone : array();
        $onwership_sale_agreement = isset($request->onwership_sale_agreement) ? $request->onwership_sale_agreement : array();
        $onwership_date_of_purchase = isset($request->onwership_date_of_purchase) ? $request->onwership_date_of_purchase : array();
        $ownerShipDataArray = array();
        if (!empty($onwership_cpr_no) && !empty($onwership_passport_no) && !empty($onwership_first_name) && !empty($onwership_last_name) && !empty($onwership_email) && !empty($onwership_phone) && !empty($onwership_sale_agreement) && !empty($onwership_date_of_purchase)) {
            foreach ($onwership_cpr_no as $ownerKey => $ownerObj) {
                if (!empty($onwership_cpr_no[$ownerKey]) && !empty($onwership_passport_no[$ownerKey]) && !empty($onwership_first_name[$ownerKey]) && !empty($onwership_last_name[$ownerKey]) && !empty($onwership_email[$ownerKey]) && !empty($onwership_phone[$ownerKey]) && !empty($onwership_sale_agreement[$ownerKey]) && !empty($onwership_date_of_purchase[$ownerKey])) {
                    $ownerShipDataArray[] = array('cprNo' => $onwership_cpr_no[$ownerKey], 'passportNo' => $onwership_passport_no[$ownerKey], 'firstName' => $onwership_first_name[$ownerKey], 'lastName' => $onwership_last_name[$ownerKey], 'email' => $onwership_email[$ownerKey], 'phone' => $onwership_phone[$ownerKey], 'saleAgrement' => $onwership_sale_agreement[$ownerKey], 'dateOfpurchase' => $onwership_date_of_purchase[$ownerKey]);
                }
            }
        }
        $ownerShipJsonData = json_encode($ownerShipDataArray);

        //EnvironmentalMatters
        $envirmentMatterArray = array();
        $env_date = isset($request->env_date) ? $request->env_date : array();
        $env_type = isset($request->env_type) ? $request->env_type : array();
        $env_description = isset($request->env_description) ? $request->env_description : array();
        $env_staff = isset($request->env_staff) ? $request->env_staff : array();
        if (!empty($env_date) && !empty($env_type) && !empty($env_description) && !empty($env_staff)) {
            foreach ($env_date as $keyEnv => $envObj) {
                if (!empty($env_date[$keyEnv]) && !empty($env_type[$keyEnv]) && !empty($env_description[$keyEnv]) && !empty($env_staff[$keyEnv])) {
                    $envirmentMatterArray[] = array('date' => $env_date[$keyEnv], 'type' => $env_type[$keyEnv], 'description' => $env_description[$keyEnv], 'staff' => $env_staff[$keyEnv]);
                }
            }
        }
        $envirmentMatterJsonData = json_encode($envirmentMatterArray);

        //Assumption
        $assumptionArray = array();
        $ass_date = isset($request->ass_date) ? $request->ass_date : array();
        $assumption_type = isset($request->assumption_type) ? $request->assumption_type : array();
        $assumption_description = isset($request->assumption_description) ? $request->assumption_description : array();
        $assumption_staff = isset($request->assumption_staff) ? $request->assumption_staff : array();
        if (!empty($ass_date) && !empty($assumption_type) && !empty($assumption_description) && !empty($assumption_staff)) {
            foreach ($ass_date as $keyAss => $assObj) {
                if (!empty($ass_date[$keyAss]) && !empty($assumption_type[$keyAss]) && !empty($assumption_description[$keyAss]) && !empty($assumption_staff[$keyAss])) {
                    $assumptionArray[] = array('date' => $ass_date[$keyAss], 'type' => $assumption_type[$keyAss], 'description' => $assumption_description[$keyAss], 'staff' => $assumption_staff[$keyAss]);
                }
            }
        }
        $assumptionJsonData = json_encode($assumptionArray);
        //RelevantInformation
        $relevantArray = array();
        $relvent_date = isset($request->relvent_date) ? $request->relvent_date : array();
        $relvent_type = isset($request->relvent_type) ? $request->relvent_type : array();
        $relvent_description = isset($request->relvent_description) ? $request->relvent_description : array();
        $relvent_staff = isset($request->relvent_staff) ? $request->relvent_staff : array();
        if (!empty($relvent_date) && !empty($relvent_type) && !empty($relvent_description) && !empty($relvent_staff)) {
            foreach ($relvent_date as $keyRel => $relObj) {
                if (!empty($relvent_date[$keyRel]) && !empty($relvent_type[$keyRel]) && !empty($relvent_description[$keyRel]) && !empty($relvent_staff[$keyRel])) {
                    $relevantArray[] = array('date' => $relvent_date[$keyRel], 'type' => $relvent_type[$keyRel], 'description' => $relvent_description[$keyRel], 'staff' => $relvent_staff[$keyRel]);
                }
            }
        }
        $relevantJsonData = json_encode($relevantArray);
        //Planning Potential
        $planningArray = array();
        $planning_date = isset($request->planning_date) ? $request->planning_date : array();
        $planning_type = isset($request->planning_type) ? $request->planning_type : array();
        $planning_description = isset($request->planning_description) ? $request->planning_description : array();
        $planning_staff = isset($request->planning_staff) ? $request->planning_staff : array();
        if (!empty($planning_date) && !empty($planning_type) && !empty($planning_description) && !empty($planning_staff)) {
            foreach ($planning_date as $keyPlan => $planObj) {
                if (!empty($planning_date[$keyPlan]) && !empty($planning_type[$keyPlan]) && !empty($planning_description[$keyPlan]) && !empty($planning_staff[$keyPlan])) {
                    $planningArray[] = array('date' => $planning_date[$keyPlan], 'type' => $planning_type[$keyPlan], 'description' => $planning_description[$keyPlan], 'staff' => $planning_staff[$keyPlan]);
                }
            }
        }
        $planningJsonData = json_encode($planningArray);
        //Dimision
        $DimisionArray = array();
        $dimision_label = isset($request->label) ? $request->label : array();
        $diminision_value = isset($request->value) ? $request->value : array();

        if (!empty($dimision_label) && !empty($diminision_value)) {
            foreach ($dimision_label as $keyLabel => $labelObj) {
                if (!empty($dimision_label[$keyLabel]) && !empty($diminision_value[$keyLabel])) {
                    $DimisionArray[] = array('label' => $dimision_label[$keyLabel], 'value' => $diminision_value[$keyLabel]);
                }
            }
        }
        $dimisisionJsonData = json_encode($DimisionArray);

        // add and update property Meta
        $updatePropertyMeta = array();
        $updatePropertyMeta[ValuationProperty::DimensionsMetaKey] = $dimisisionJsonData;
//        $updatePropertyMeta[ValuationProperty::AddOnCostMetaKey] = $addOnCostsEncode;
        $updatePropertyMeta[ValuationProperty::FinancialAcquisitionCost] = $acqtransectionData;
//        $updatePropertyMeta[ValuationProperty::UnitInfoAcquisitionCost] = $acqtransection_unit_infoData;
        $updatePropertyMeta[ValuationProperty::AcquisitionCostPropertyInfo] = $acqtransectionData_properyInfoTab;
        $updatePropertyMeta[ValuationProperty::FinancialBuildUpCost] = $buildUpTransectionData;
        $updatePropertyMeta[ValuationProperty::FinancialAddOnCost] = $addonTransectionData;
        $updatePropertyMeta[ValuationProperty::PropertyInfoAddOnCost] = $addonTransectionData_property_info;
//        $updatePropertyMeta[ValuationProperty::UnitInfoAddOnCost] = $addonTransectionData_unit_info;
        $updatePropertyMeta[ValuationProperty::PropertyInfoIncome] = $incomejsonData_property_info;
        $updatePropertyMeta[ValuationProperty::StructureInfoIncome] = $incomejsonData_structure_info;
//        $updatePropertyMeta[ValuationProperty::UnitInfoIncome] = $incomejsonData_Unit_info;
        $updatePropertyMeta[ValuationProperty::StructureUnit] = $structureUnitJsonData;
        $updatePropertyMeta[ValuationProperty::OwnerShip] = $ownerShipJsonData;
        $updatePropertyMeta[ValuationProperty::PropertyFeatureMetaKey] = $propertyFeatureEncode;
        $updatePropertyMeta[ValuationProperty::PropertyEnvirementalMatters] = $envirmentMatterJsonData;
        $updatePropertyMeta[ValuationProperty::PropertyAssumption] = $assumptionJsonData;
        $updatePropertyMeta[ValuationProperty::PropertyRelventInformation] = $relevantJsonData;
        $updatePropertyMeta[ValuationProperty::PropertyPlanningPotential] = $planningJsonData;
        $updatePropertyMeta[ValuationProperty::LandClassificationTypeText] = json_encode($landClassificationWeightageArray);
        $updatePropertyMeta[ValuationProperty::AccessibilityText] = json_encode($landInfoAccessibilityWeightageArray);
        $updatePropertyMeta[ValuationProperty::AccessibilityTypeText] = json_encode($landInfoAccessibilityTypeWeightageArray);
        $updatePropertyMeta[ValuationProperty::NoOfAccessRoadsText] = json_encode($landInfoRoadAccessWeightageArray);
        $updatePropertyMeta[ValuationProperty::AccessRoadTypeText] = json_encode($landRoadAccessTypeWeightageArray);
        $updatePropertyMeta[ValuationProperty::RecencyTransectionText] = json_encode($landInfoRecencyWeightageArray);
        $updatePropertyMeta[ValuationProperty::LocationClassificationText] = json_encode($addressLocationClassificationWeightageArray);
        $updatePropertyMeta[ValuationProperty::ResidualValueForPropertyInfo] = json_encode($residual_value_for_property_infoWeightageArray);
        $updatePropertyMeta[ValuationProperty::DepictedValueForPropertyInfo] = json_encode($depicted_value_for_property_infoWeightageArray);
        $updatePropertyMeta[ValuationProperty::CostOfConstructionValueForPropertyInfo] = json_encode($cost_construction_for_property_infoWeightageArray);
        $updatePropertyMeta[ValuationProperty::IncomeBaseValueForPropertyInfo] = json_encode($incomebasevalue_for_property_infoWeightageArray);
        $updatePropertyMeta[ValuationProperty::LandshapeText] = json_encode($landInfoLandShapeWeightageArray);
        $updatePropertyMeta[ValuationProperty::AmenitiesText] = json_encode($aminatieForStructureInfoWeightageArray);
        $updatePropertyMeta[ValuationProperty::RentalIncomeStructure] = json_encode($rentalIncomeStructureWeightageArray);
        $updatePropertyMeta[ValuationProperty::EstimatedValueStructure] = json_encode($estimatedValueStructureWeightageArray);
        $updatePropertyMeta[ValuationProperty::ResidualValueForStructure] = json_encode($residual_value_for_StructureWeightageArray);
        $updatePropertyMeta[ValuationProperty::DepictedValueForStructure] = json_encode($depicted_value_for_StructureWeightageArray);
        $updatePropertyMeta[ValuationProperty::CostOfConstructionValueForStructure] = json_encode($cost_construction_for_StructureWeightageArray);
        $updatePropertyMeta[ValuationProperty::IncomeBaseValueForStructure] = json_encode($incomebasevalue_for_StructureWeightageArray);
        $updatePropertyMeta[ValuationProperty::SalePurchaseHistory] = json_encode($salePurchaseHistoryArray);
        $updatePropertyMeta[ValuationProperty::RentalIncomeHistory] = json_encode($rentalIncomeHistoryArray);
        $updatePropertyMeta[ValuationProperty::Valuations] = json_encode($valuationsArray);
        $updatePropertyMeta[ValuationProperty::UnitType] = json_encode($unitTypeArray);
        $updatePropertyMeta[ValuationProperty::NoOfBedroomText] = json_encode($bedRoomsUnitInfoWeightageArray);
        $updatePropertyMeta[ValuationProperty::NoOfBathoomsText] = json_encode($bathRoomUnitInfoWeightageArray);
        $updatePropertyMeta[ValuationProperty::FinishingQualityText] = json_encode($finishingQualityUnitInfoWeightageArray);
        $updatePropertyMeta[ValuationProperty::MaintenanceText] = json_encode($unitInfoMaintenanceWeightageArray);
        $updatePropertyMeta[ValuationProperty::FloorlevelText] = json_encode($unitInfoFloorLevelWeightageArray);
        $updatePropertyMeta[ValuationProperty::ViewText] = json_encode($unitInfoViewWeightageArray);
        $updatePropertyMeta[ValuationProperty::RentalIncomePropertyInfo] = json_encode($rentalIncomePropertyInfoArray);
        $updatePropertyMeta[ValuationProperty::EstimatedValuePropertyInfo] = json_encode($estimatedValuePropertyInfoArray);
//        $updatePropertyMeta[ValuationProperty::UnitInfoView] = json_encode($unitInfoViewWeightageArray);
//        $updatePropertyMeta[ValuationProperty::UnitInfoCondition] = json_encode($unitInfoConditionArray);
//        $updatePropertyMeta[ValuationProperty::UnitInfoStyling] = json_encode($unitInfoStylingArray);
//        $updatePropertyMeta[ValuationProperty::UnitInfoStatus] = json_encode($unitInfoStatusArray);
//        $updatePropertyMeta[ValuationProperty::UnitInfoInteriorStatus] = json_encode($unitInfoInteriorStatusArray);
//        $updatePropertyMeta[ValuationProperty::RentalIncomeUnitInfo] = json_encode($rentalIncomeUnitInfoArray);
//        $updatePropertyMeta[ValuationProperty::EstimatedValueUnitInfo] = json_encode($estimatedValueUnitInfoArray);
//        $updatePropertyMeta[ValuationProperty::ResidualValueUnitInfo] = json_encode($residual_value_for_UnitInfoArray);
//        $updatePropertyMeta[ValuationProperty::DepictedValueUnitInfo] = json_encode($depicted_value_for_UnitInfoArray);
//        $updatePropertyMeta[ValuationProperty::CostOfConstructionValueUnitInfo] = json_encode($cost_construction_for_UnitInfoArray);
//        $updatePropertyMeta[ValuationProperty::IncomeBaseValueUnitInfo] = json_encode($incomebasevalue_for_UnitInfoArray);

        $log = array('propertyInfo' => $property, 'meta' => $updatePropertyMeta);
        $updatePropertyMeta[ValuationProperty::PropertyLog] = json_encode($log);
        $property->setMeta($updatePropertyMeta);


//		$logArray();
//
//		$property->setMeta($logArray);

        if ($request->id) {
            return Reply::redirect(route($this->addEditViewRoute, $request->id), __('Updated Success'));
        } else {
            return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
        }
//        return Reply::redirect(route($this->listingPageRoute), __('Save Success'));
    }

    /**
     * Convert feature into meta data.
     *
     * @param array $features
     * @return array $data
     */

    private function featureMetaData($features)
    {
        $data = array();
        foreach ($features as $key => $feature) {
            if (isset($feature['id'])) {
                $featureData = ValuationPropertyFeature::find($feature['id']);
                $data[$feature['id']] = $featureData->toArray();
                $data[$feature['id']] ['value'] = $feature['value'];
            }
        }
        return json_encode($data);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $property = ValuationProperty::find($id);

        if (empty($property)) {
            return Reply::error(__('valuation::messages.dataNotFound'));
        }

        ValuationProperty::destroy($id);

        return Reply::success(__('valuation::messages.dataDeleted'));
    }

    public function data()
    {
        $propertyObj = new ValuationProperty();
        $properties = $propertyObj->getAllForCompany();

        return DataTables::of($properties)
            ->addIndexColumn()
            ->editColumn(
                'id',
                function ($row) {
                    return $row->id;
                }
            )
            ->addColumn('action', function ($row) {

                $action = '<div class="btn-group dropdown m-r-10">
                <button aria-expanded="false" data-toggle="dropdown" class="btn dropdown-toggle waves-effect waves-light" type="button"><i class="ti-more"></i></button>
                <ul role="menu" class="dropdown-menu pull-right">
                  <li><a href="' . route($this->addEditViewRoute, $row->id) . '"><i class="fa fa-pencil" aria-hidden="true"></i> ' . trans('valuation::app.edit') . '</a></li>
                  <li><a href="javascript:void(0)" id="' . $row->id . '" class="sa-params"><i class="fa fa-times" aria-hidden="true"></i> ' . trans('valuation::app.delete') . '</a></li>
                      <li><a href="' . route($this->propertyDetailRoute, $row->id) . '"><i class="fa fa-eye" aria-hidden="true"></i> ' . trans('valuation::valuation.property.detailProperty') . '</a></li>
                 ';

                $action .= '</ul> </div>';

                return $action;

            })
            ->editColumn(
                'title',
                function ($row) {
                    return ucfirst($row->title);
                }
            )
            ->editColumn(
                'type',
                function ($row) {
                    if ($row->type_id > 0) {
                        $typeProperty = ValuationPropertyType::find($row->type_id);
                        return isset($typeProperty) ? ucfirst($typeProperty->title) : '';
                    }
                }
            )
            ->editColumn(
                'city',
                function ($row) {
                    if ($row->city_id > 0) {
                        $cityProperty = ValuationCity::find($row->city_id);
                        return isset($cityProperty) ? ucfirst($cityProperty->name) : '';
                    }
                }
            )
            ->rawColumns(array('title', 'action'))
            ->make(true);
    }

    public function propertyDetail($id)
    {
        $this->__customConstruct($this->data);
        $properties = new ValuationProperty();

        $this->propertiesCount = $properties->countForCompany();
        return view($this->viewFolderPath . 'detail.Index', $this->data);
    }

    public function saveUnit(Request $request)
    {
        $this->__customConstruct($data);
        $unitStructureType = isset($request->unitStructureType) ? $request->unitStructureType : array();
        $unitStructureUnitId = isset($request->unitStructureUnitId) ? $request->unitStructureUnitId : array();
        $structureUnitDescription = isset($request->structureUnitDescription) ? $request->structureUnitDescription : array();
        $oldPropertyId = isset($request->propertyIdOld) ? $request->propertyIdOld : 0;
        if (!empty($unitStructureType)) {
            foreach ($unitStructureType as $unitkey => $unitObj) {
                $property = new ValuationProperty();
                $xref = new ValuationPropertyXref();
                $property->title = $unitStructureUnitId[$unitkey];
                $property->status = 'Active';
                $property->type_id = $unitStructureType[$unitkey];
                $property->save();
                $propertyIdNew = $property->id;
                $xref->property_id = $oldPropertyId;
                $xref->unit_id = $propertyIdNew;
                $xref->save();
            }
            return Reply::redirect(route($this->addEditViewRoute, $oldPropertyId), __('Units Save Successfully'));
        }

    }

    public function getUnit($id = 0)
    {
//        $xref=new ValuationPropertyXref();
//        $unitList=$xref->getUnit();
        $property = new ValuationProperty();
        $unitList = $property->unitItem();
        echo "<pre>";
        print_r($unitList);
        echo "</pre>";
        echo "i am here ";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createPropertyModalView()
    {
        return view($this->viewFolderPath . 'createPropertyWithModal', $this->data);
    }

    public function savePropertyWithModal(Request $request)
    {
        $this->__customConstruct($this->data);
        $properties = new ValuationProperty();
        $properties->company_id = isset($this->data['companyId']) ? $this->data['companyId'] : 0;
        $properties->title = isset($request->propertyTitle)?$request->propertyTitle:'Temp';
        $properties->status = 'Draft';
        $properties->save();
        $propertyId = $properties->id;
        return Reply::successWithData('Property Added successfully', array('title'=>$properties->title, 'id'=>$propertyId));

    }

}
