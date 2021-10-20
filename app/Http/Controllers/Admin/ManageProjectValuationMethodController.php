<?php

namespace App\Http\Controllers\Admin;

use App\EmployeeDetails;
use App\EmployeeTeam;
use App\Helper\Reply;
use App\Http\Requests\ProjectMembers\SaveGroupMembers;
use App\Http\Requests\ProjectMembers\StoreProjectMembers;
use App\Notifications\NewProjectMember;
use App\Project;
use App\ProjectMember;
use App\Team;
use App\User;
use Illuminate\Http\Request;
use Modules\Valuation\Entities\ValuationProperty;

class ManageProjectValuationMethodController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageIcon = 'icon-layers';
        $this->pageTitle = 'app.menu.projects';
    }


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->projectId = $id;
        $project = Project::findOrFail($id);
        $this->project = $project;

        $propertyObj = new ValuationProperty();


        $this->baseproprety = null;
        $basePropertyId = isset($project->property_id) ? $project->property_id : '0';
        $this->basePropertyId = $basePropertyId;

        if ($basePropertyId > 0) {
            $baseProperty = ValuationProperty::findOrFail($basePropertyId);
            $this->baseProperty = $baseProperty;
        }

        $allProperties = $propertyObj->getAllForCompany()->except($basePropertyId);
        $this->properties = $allProperties;

        return view('admin.projects.ValuationMethodology.ComparativeMethod', $this->data);
    }

    public function saveProjectBaseProperty(Request $request)
    {
        $projectId = isset($request->projectId) ? $request->projectId : 0;
        if ($projectId <= 0) {
            return Reply::error('Project id should be greater then 0');
        }

        $projectPropertyId = (isset($request->projectBaseProperty) && $request->projectBaseProperty > 0) ? $request->projectBaseProperty : 0;
        if ($projectPropertyId <= 0) {
            return Reply::error('Project property id should be greater then 0');
        }

        $project = Project::findOrFail($projectId);
        $project->property_id = (isset($request->projectBaseProperty) && $request->projectBaseProperty != '') ? $request->projectBaseProperty : '';
        $project->save();

        return Reply::redirect(route('admin.valuation-method.show', $project->id), 'Project base property saved');
    }

    public function processComparison_pre(Request $request)
    {

        $propertyIdBase = isset($request->basePropertyId) ? $request->basePropertyId : 0;
        if ($propertyIdBase <= 0) {
            return Reply::error('Base property id should be greater then 0');
        }

        $propertyIdOne = isset($request->comparePropertyOne) ? $request->comparePropertyOne : 0;
        if ($propertyIdOne <= 0) {
            return Reply::error('comparable property 1 id should be greater then 0');
        }

        $propertyIdTwo = isset($request->comparePropertyTwo) ? $request->comparePropertyTwo : 0;
        if ($propertyIdTwo <= 0) {
            return Reply::error('comparable property 2 id should be greater then 0');
        }

        $propertyIdThree = isset($request->comparePropertyThree) ? $request->comparePropertyThree : 0;
        if ($propertyIdThree <= 0) {
            return Reply::error('comparable property 3 id should be greater then 0');
        }


        $propertyType = 'unit';
        $valuationMethod = 'comparision';

        switch ($valuationMethod) {
            case 'comparision':
                switch ($propertyType) {
                    case'Apartment':
                        break;
                    case'Land':
                        break;
                    default:
                        return Reply::error('comparable property 3 id should be greater then 0');
                }
                $comparisionMethodRes = $this->comparisionMethod($request);
                $returnArray['comparisionResponseHtml'] = $comparisionMethodRes;
                $returnArray['status'] = 'success';
                echo json_encode($returnArray);
                exit;
                echo json_encode($comparisionMethodRes);
                exit;

                break;
            default :

                break;
        }

        /*$weightage = array();
        $weightage['bedrooms']['name'] = 'bedrooms';
        $weightage['bedrooms']['value'] = '2';
        $weightage['bedrooms']['percent'] = '20';
        $weightage['bedrooms']['maxValue'] = '8';

        $weightage['bathrooms']['name'] = 'bathroom';
        $weightage['bathrooms']['value'] = '3';
        $weightage['bathrooms']['percent'] = '10';
        $weightage['bathrooms']['maxValue'] = '8';

        $weightage['finishingQuality']['name'] = 'finishingQuality';
        $weightage['finishingQuality']['value'] = '3';
        $weightage['finishingQuality']['percent'] = '20';
        $weightage['finishingQuality']['maxValue'] = '8';

        $weightage['maintenance']['name'] = 'maintenance';
        $weightage['maintenance']['value'] = '3';
        $weightage['maintenance']['percent'] = '20';
        $weightage['maintenance']['maxValue'] = '8';

        $weightage['floorLevel']['name'] = 'floorLevel';
        $weightage['floorLevel']['value'] = '3';
        $weightage['floorLevel']['percent'] = '20';
        $weightage['floorLevel']['maxValue'] = '8';

        $weightage['amenities']['name'] = 'amenities';
        $weightage['amenities']['value'] = '3';
        $weightage['amenities']['percent'] = '20';
        $weightage['amenities']['maxValue'] = '8';

        $propertyBaseInfo->Weightage = $weightage;*/

        $propertyBaseInfo = ValuationProperty::findOrFail($propertyIdBase);

        $propertyBaseInfo->bedrooms = 2;
        $propertyBaseInfo->bathrooms = 3;
        $propertyBaseInfo->finishingQuality = 6.25;
        $propertyBaseInfo->maintenance = 0;
        $propertyBaseInfo->floorLevel = 3;
        $propertyBaseInfo->amenities = 8;

        $propertyInfoOne = ValuationProperty::findOrFail($propertyIdOne);
        $propertyInfoOne->bedrooms = 2;
        $propertyInfoOne->bathrooms = 3;
        $propertyInfoOne->finishingQuality = 6.25;
        $propertyInfoOne->maintenance = 0;
        $propertyInfoOne->floorLevel = 3;
        $propertyInfoOne->amenities = 8;

        $propertyInfoTwo = ValuationProperty::findOrFail($propertyIdTwo);
        $propertyInfoTwo->bedrooms = 2;
        $propertyInfoTwo->bathrooms = 3;
        $propertyInfoTwo->finishingQuality = 6.25;
        $propertyInfoTwo->maintenance = 0;
        $propertyInfoTwo->floorLevel = 3;
        $propertyInfoTwo->amenities = 8;

        $propertyInfoThree = ValuationProperty::findOrFail($propertyIdThree);
        $propertyInfoThree->bedrooms = 3;
        $propertyInfoThree->bathrooms = 3;
        $propertyInfoThree->finishingQuality = 6.25;
        $propertyInfoThree->maintenance = 0;
        $propertyInfoThree->floorLevel = 3;
        $propertyInfoThree->amenities = 8;


        //compare Processing start
        //bedrooms comparison
        $baseBedrooms = $propertyBaseInfo->bedrooms;
        $bedroomsPropertyInfoOne = $propertyInfoOne->bedrooms;
        $bedroomsPropertyInfoTwo = $propertyInfoTwo->bedrooms;
        $bedroomsPropertyInfoThree = $propertyInfoThree->bedrooms;
        $maxBedrooms = '8';

        $baseMinusProOne = $baseBedrooms - $bedroomsPropertyInfoOne;
        $propertyInfoOne->baseMinusProOne = $baseMinusProOne;
        $propertyInfoOne->bedComparison = ($baseMinusProOne / $maxBedrooms) * 100;

        $baseMinusProTwo = $baseBedrooms - $bedroomsPropertyInfoTwo;
        $propertyInfoTwo->baseMinusProTwo = $baseMinusProTwo;
        $propertyInfoTwo->bedComparison = ($baseMinusProTwo / $maxBedrooms) * 100;

        $baseMinusProThree = $baseBedrooms - $bedroomsPropertyInfoThree;
        $propertyInfoThree->baseMinusProThree = $baseMinusProThree;
        $propertyInfoThree->bedComparison = ($baseMinusProThree / $maxBedrooms) * 100;

        // bathroom comparison
        $baseBathroom = $propertyBaseInfo->bathrooms;
        $bathroomsPropertyInfoOne = $propertyInfoOne->bathrooms;
        $bathroomsPropertyInfoTwo = $propertyInfoTwo->bathrooms;
        $bathroomsPropertyInfoThree = $propertyInfoThree->bathrooms;
        $maxBathrooms = '8';

        $bathBaseMinusProOne = $baseBathroom - $bathroomsPropertyInfoOne;
        $propertyInfoOne->bathBaseMinusProOne = $bathBaseMinusProOne;
        $propertyInfoOne->bathComparison = ($bathBaseMinusProOne / $maxBathrooms) * 100;

        $bathBaseMinusProTwo = $baseBathroom - $bathroomsPropertyInfoTwo;
        $propertyInfoTwo->bathBaseMinusProTwo = $bathBaseMinusProTwo;
        $propertyInfoTwo->bathComparison = ($bathBaseMinusProTwo / $maxBathrooms) * 100;

        $bathBaseMinusProThree = $baseBathroom - $bathroomsPropertyInfoThree;
        $propertyInfoThree->bathBaseMinusProThree = $bathBaseMinusProThree;
        $propertyInfoThree->bathComparison = ($bathBaseMinusProThree / $maxBathrooms) * 100;

        //Finishing Quality
        $finishingQualityBase = $propertyBaseInfo->finishingQuality;
        $maintenanceBase = $propertyBaseInfo->maintenance;
        $finishingQualityPropertyInfoOne = $propertyInfoOne->finishingQuality;
        $maintenancePropertyInfoOne = $propertyInfoOne->maintenance;
        $finishingQualityPropertyInfoTwo = $propertyInfoTwo->finishingQuality;
        $maintenancePropertyInfoTwo = $propertyInfoTwo->maintenance;
        $finishingQualityPropertyInfoThree = $propertyInfoThree->finishingQuality;
        $maintenancePropertyInfoThree = $propertyInfoThree->maintenance;

        $finishingQualityCalBase = $finishingQualityBase + $maintenanceBase;

        $finishingQualityCalProOne = $finishingQualityPropertyInfoOne + $maintenancePropertyInfoOne;
        $propertyInfoOne->finishingQualityCal = $finishingQualityCalProOne;
        $propertyInfoOne->finishingQualityComparison = ($finishingQualityCalBase - $finishingQualityCalProOne) / 100;

        $finishingQualityCalProTwo = $finishingQualityPropertyInfoTwo + $maintenancePropertyInfoTwo;
        $propertyInfoTwo->finishingQualityCal = $finishingQualityCalProTwo;
        $propertyInfoTwo->finishingQualityComparison = ($finishingQualityCalBase - $finishingQualityCalProTwo) / 100;

        $finishingQualityCalProThree = $finishingQualityPropertyInfoThree + $maintenancePropertyInfoThree;
        $propertyInfoThree->finishingQualityCal = $finishingQualityCalProThree;
        $propertyInfoThree->finishingQualityComparison = ($finishingQualityCalBase - $finishingQualityCalProThree) / 100;

        // Building Amenities and Facilities
        $amenitiesBase = $propertyBaseInfo->amenities;
        $amenitiesPropertyInfoOne = $propertyInfoOne->amenities;
        $amenitiesPropertyInfoTwo = $propertyInfoTwo->amenities;
        $amenitiesPropertyInfoThree = $propertyInfoThree->amenities;
        $amenitiesMax = 8;

        $propertyInfoOne->amenitiesComparison = ($amenitiesBase - $amenitiesPropertyInfoOne) / $amenitiesMax;
        $propertyInfoThree->amenitiesComparison = ($amenitiesBase - $amenitiesPropertyInfoTwo) / $amenitiesMax;
        $propertyInfoThree->amenitiesComparison = ($amenitiesBase - $amenitiesPropertyInfoThree) / $amenitiesMax;


        $propertyInfo = array();
        $propertyInfo['propertyBaseInfo'] = $propertyBaseInfo;
        $propertyInfo['propertyInfoOne'] = $propertyInfoOne;
        $propertyInfo['propertyInfoTwo'] = $propertyInfoTwo;
        $propertyInfo['propertyInfoThree'] = $propertyInfoThree;

        echo "<pre>";
        print_r($propertyInfo);
        exit;

        $returnArray['propertyInfo'] = $propertyInfo;
        $returnArray['status'] = 'success';
        echo json_encode($returnArray);
        exit;
    }

    public function processComparison(Request $request)
    {

        $propertyIdBase = isset($request->basePropertyId) ? $request->basePropertyId : 0;
        if ($propertyIdBase <= 0) {
            return Reply::error('Base property id should be greater then 0');
        }

        $propertyIdOne = isset($request->comparePropertyOne) ? $request->comparePropertyOne : 0;
        if ($propertyIdOne <= 0) {
            return Reply::error('comparable property 1 id should be greater then 0');
        }

        $propertyIdTwo = isset($request->comparePropertyTwo) ? $request->comparePropertyTwo : 0;
        if ($propertyIdTwo <= 0) {
            return Reply::error('comparable property 2 id should be greater then 0');
        }

        $propertyIdThree = isset($request->comparePropertyThree) ? $request->comparePropertyThree : 0;
        if ($propertyIdThree <= 0) {
            return Reply::error('comparable property 3 id should be greater then 0');
        }

        $propertyType = 'Apartment';
        $valuationMethod = 'comparision';

        switch ($valuationMethod) {
            case 'comparision':
                switch ($propertyType) {
                    case'Apartment':
                        $comparisionMethodRes = $this->comparisionApartment($request);

                        $returnArray = array();
                        $returnArray['comparisionResponseHtml'] = $comparisionMethodRes;
                        $returnArray['status'] = 'success';

                        return Reply::successWithData('Comparison Completed', $returnArray);
                        /* echo json_encode($returnArray); exit;
                         echo json_encode($comparisionMethodRes); exit;*/
                        break;
                    case'Land':
                        $comparisionMethodRes = $this->comparisionLand($request);

                        $returnArray = array();
                        $returnArray['comparisionResponseHtml'] = $comparisionMethodRes;
                        $returnArray['status'] = 'success';

                        return Reply::successWithData('Comparison Completed', $returnArray);
                        break;
                    default:
                        return Reply::error('Property type not define');
                }


                break;
            default :
                return Reply::error('Method not define');
                break;
        }

    }

    public function comparisionApartment(Request $request)
    {

        $propertyIdBase = isset($request->basePropertyId) ? $request->basePropertyId : 0;
        if ($propertyIdBase <= 0) {
            return Reply::error('Base property id should be greater then 0');
        }

        $propertyIdOne = isset($request->comparePropertyOne) ? $request->comparePropertyOne : 0;
        if ($propertyIdOne <= 0) {
            return Reply::error('comparable property 1 id should be greater then 0');
        }

        $propertyIdTwo = isset($request->comparePropertyTwo) ? $request->comparePropertyTwo : 0;
        if ($propertyIdTwo <= 0) {
            return Reply::error('comparable property 2 id should be greater then 0');
        }

        $propertyIdThree = isset($request->comparePropertyThree) ? $request->comparePropertyThree : 0;
        if ($propertyIdThree <= 0) {
            return Reply::error('comparable property 3 id should be greater then 0');
        }

        //currency
        $this->currency = 'BHD';

        //percentage
        $sizeWeightagePer = '40';
        $this->sizeWeightagePerText = '40%';
        $bedroomsWeightagePer = '20';
        $this->bedroomsWeightagePerText = '20%';
        $bathWeightagePer = '10';
        $this->bathWeightagePerText = '10%';
        $finishingQualityWeightagePer = '15';
        $this->finishingQualityWeightagePerText = '15%';
        $amenitiesWeightagePer = '15';
        $this->amenitiesWeightagePerText = '15%';

        $propertyBaseInfo = ValuationProperty::findOrFail($propertyIdBase);


        $propertyBaseInfo->estimated_value = 0;
        $propertyBaseInfo->aptSizeIPMS = 176.40;
        $propertyBaseInfo->bedrooms = 2;
        $propertyBaseInfo->bathrooms = 3;
        $propertyBaseInfo->finishingQuality = 6.25;
        $propertyBaseInfo->maintenance = 0;
        $propertyBaseInfo->floorLevel = 3;
        $propertyBaseInfo->amenities = 8;

        $propertyInfoOne = ValuationProperty::findOrFail($propertyIdOne);

        $propertyInfoOne->estimated_value = 130000;
        $propertyInfoOne->aptSizeIPMS = 176.40;
        $propertyInfoOne->bedrooms = 2;
        $propertyInfoOne->bathrooms = 3;
        $propertyInfoOne->finishingQuality = 6.25;
        $propertyInfoOne->maintenance = 0;
        $propertyInfoOne->floorLevel = 3;
        $propertyInfoOne->amenities = 8;

        $propertyInfoTwo = ValuationProperty::findOrFail($propertyIdTwo);
        $propertyInfoTwo->estimated_value = 120000;
        $propertyInfoTwo->aptSizeIPMS = 176.40;
        $propertyInfoTwo->bedrooms = 2;
        $propertyInfoTwo->bathrooms = 3;
        $propertyInfoTwo->finishingQuality = 6.25;
        $propertyInfoTwo->maintenance = 0;
        $propertyInfoTwo->floorLevel = 3;
        $propertyInfoTwo->amenities = 8;

        $propertyInfoThree = ValuationProperty::findOrFail($propertyIdThree);
        $propertyInfoThree->estimated_value = 135000;
        $propertyInfoThree->aptSizeIPMS = 270.00;
        $propertyInfoThree->bedrooms = 3;
        $propertyInfoThree->bathrooms = 3;
        $propertyInfoThree->finishingQuality = 6.25;
        $propertyInfoThree->maintenance = 0;
        $propertyInfoThree->floorLevel = 3;
        $propertyInfoThree->amenities = 8;

        //compare Processing start

        //apartment comparison
        $baseAptSizeIPMS = $propertyBaseInfo->aptSizeIPMS;
        $aptSizeIPMSPropertyInfoOne = $propertyInfoOne->aptSizeIPMS;
        $aptSizeIPMSPropertyInfoTwo = $propertyInfoTwo->aptSizeIPMS;
        $aptSizeIPMSPropertyInfoThree = $propertyInfoThree->aptSizeIPMS;
        $maxBedrooms = '8';

        $baseAptSizeIPMSMinusProOne = $baseAptSizeIPMS - $aptSizeIPMSPropertyInfoOne;
        $propertyInfoOne->aptSizeIPMSCal = $baseAptSizeIPMSMinusProOne;
        $propertyInfoOne->aptSizeIPMSComparison = ($baseAptSizeIPMSMinusProOne / $baseAptSizeIPMS)*100;

        $baseAptSizeIPMSMinusProTwo = $baseAptSizeIPMS - $aptSizeIPMSPropertyInfoTwo;
        $propertyInfoTwo->aptSizeIPMSCal = $baseAptSizeIPMSMinusProTwo;
        $propertyInfoTwo->aptSizeIPMSComparison = ($baseAptSizeIPMSMinusProTwo / $baseAptSizeIPMS)*100;

        $baseAptSizeIPMSMinusProThree = $baseAptSizeIPMS - $aptSizeIPMSPropertyInfoThree;
        $propertyInfoThree->aptSizeIPMSCal = $baseAptSizeIPMSMinusProThree;
        $propertyInfoThree->aptSizeIPMSComparison = ($baseAptSizeIPMSMinusProThree / $baseAptSizeIPMS)*100;

        //bedrooms comparison
        $baseBedrooms = $propertyBaseInfo->bedrooms;
        $bedroomsPropertyInfoOne = $propertyInfoOne->bedrooms;
        $bedroomsPropertyInfoTwo = $propertyInfoTwo->bedrooms;
        $bedroomsPropertyInfoThree = $propertyInfoThree->bedrooms;
        $maxBedrooms = '8';

        $baseBedroomsMinusProOne = $baseBedrooms - $bedroomsPropertyInfoOne;
        $propertyInfoOne->baseBedroomsMinusProOne = $baseBedroomsMinusProOne;
        $propertyInfoOne->bedComparison = ($baseBedroomsMinusProOne / $maxBedrooms) * 100;

        $baseBedroomsMinusProTwo = $baseBedrooms - $bedroomsPropertyInfoTwo;
        $propertyInfoTwo->baseBedroomsMinusProTwo = $baseBedroomsMinusProTwo;
        $propertyInfoTwo->bedComparison = ($baseBedroomsMinusProTwo / $maxBedrooms) * 100;

        $baseBedroomsMinusProThree = $baseBedrooms - $bedroomsPropertyInfoThree;
        $propertyInfoThree->baseBedroomsMinusProThree = $baseBedroomsMinusProThree;
        $propertyInfoThree->bedComparison = ($baseBedroomsMinusProThree / $maxBedrooms) * 100;

        // bathroom comparison
        $baseBathroom = $propertyBaseInfo->bathrooms;
        $bathroomsPropertyInfoOne = $propertyInfoOne->bathrooms;
        $bathroomsPropertyInfoTwo = $propertyInfoTwo->bathrooms;
        $bathroomsPropertyInfoThree = $propertyInfoThree->bathrooms;
        $maxBathrooms = '8';

        $bathBaseMinusProOne = $baseBathroom - $bathroomsPropertyInfoOne;
        $propertyInfoOne->bathBaseMinusProOne = $bathBaseMinusProOne;
        $propertyInfoOne->bathComparison = ($bathBaseMinusProOne / $maxBathrooms) * 100;

        $bathBaseMinusProTwo = $baseBathroom - $bathroomsPropertyInfoTwo;
        $propertyInfoTwo->bathBaseMinusProTwo = $bathBaseMinusProTwo;
        $propertyInfoTwo->bathComparison = ($bathBaseMinusProTwo / $maxBathrooms) * 100;

        $bathBaseMinusProThree = $baseBathroom - $bathroomsPropertyInfoThree;
        $propertyInfoThree->bathBaseMinusProThree = $bathBaseMinusProThree;
        $propertyInfoThree->bathComparison = ($bathBaseMinusProThree / $maxBathrooms) * 100;

        //Finishing Quality
        $finishingQualityBase = $propertyBaseInfo->finishingQuality;
        $maintenanceBase = $propertyBaseInfo->maintenance;
        $propertyBaseInfo->finishingQualitySelectionTitle = 'Good Condition';
        $propertyBaseInfo->maintenanceSelectionTitle = 'No Maintenance Needed';

        $finishingQualityPropertyInfoOne = $propertyInfoOne->finishingQuality;
        $maintenancePropertyInfoOne = $propertyInfoOne->maintenance;
        $propertyInfoOne->finishingQualitySelectionTitle = 'Good Condition';
        $propertyInfoOne->maintenanceSelectionTitle = 'No Maintenance Needed';

        $finishingQualityPropertyInfoTwo = $propertyInfoTwo->finishingQuality;
        $maintenancePropertyInfoTwo = $propertyInfoTwo->maintenance;
        $propertyInfoTwo->finishingQualitySelectionTitle = 'Good Condition';
        $propertyInfoTwo->maintenanceSelectionTitle = 'No Maintenance Needed';

        $finishingQualityPropertyInfoThree = $propertyInfoThree->finishingQuality;
        $maintenancePropertyInfoThree = $propertyInfoThree->maintenance;
        $propertyInfoThree->finishingQualitySelectionTitle = 'Good Condition';
        $propertyInfoThree->maintenanceSelectionTitle = 'No Maintenance Needed';

        $finishingQualityCalBase = $finishingQualityBase + $maintenanceBase;
        $propertyBaseInfo->finishingQualityCal = $finishingQualityCalBase;

        $finishingQualityCalProOne = $finishingQualityPropertyInfoOne + $maintenancePropertyInfoOne;
        $propertyInfoOne->finishingQualityCal = $finishingQualityCalProOne;
        $propertyInfoOne->finishingQualityComparison = ($finishingQualityCalBase - $finishingQualityCalProOne) / 100;

        $finishingQualityCalProTwo = $finishingQualityPropertyInfoTwo + $maintenancePropertyInfoTwo;
        $propertyInfoTwo->finishingQualityCal = $finishingQualityCalProTwo;
        $propertyInfoTwo->finishingQualityComparison = ($finishingQualityCalBase - $finishingQualityCalProTwo) / 100;

        $finishingQualityCalProThree = $finishingQualityPropertyInfoThree + $maintenancePropertyInfoThree;
        $propertyInfoThree->finishingQualityCal = $finishingQualityCalProThree;
        $propertyInfoThree->finishingQualityComparison = ($finishingQualityCalBase - $finishingQualityCalProThree) / 100;

        // Building Amenities and Facilities
        $amenitiesBase = $propertyBaseInfo->amenities;
        $propertyBaseInfo->amenitiesSlectionTitle = 'Refer to Section 17';

        $amenitiesPropertyInfoOne = $propertyInfoOne->amenities;
        $propertyInfoOne->amenitiesSlectionTitle = 'Refer to Section 17';

        $amenitiesPropertyInfoTwo = $propertyInfoTwo->amenities;
        $propertyInfoTwo->amenitiesSlectionTitle = 'Refer to Section 17';

        $amenitiesPropertyInfoThree = $propertyInfoThree->amenities;
        $propertyInfoThree->amenitiesSlectionTitle = 'Refer to Section 17';

        $amenitiesMax = 8;

        $propertyInfoOne->amenitiesComparison = ($amenitiesBase - $amenitiesPropertyInfoOne) / $amenitiesMax;
        $propertyInfoThree->amenitiesComparison = ($amenitiesBase - $amenitiesPropertyInfoTwo) / $amenitiesMax;
        $propertyInfoThree->amenitiesComparison = ($amenitiesBase - $amenitiesPropertyInfoThree) / $amenitiesMax;


        //Weighted Factor Adjustment
        $weightedFacAdjProOne = ($propertyInfoOne->aptSizeIPMSComparison*$sizeWeightagePer)+
            ($propertyInfoOne->bedComparison*$bedroomsWeightagePer)+
            ($propertyInfoOne->bathComparison*$bathWeightagePer)+
            ($propertyInfoOne->finishingQualityComparison*$finishingQualityWeightagePer)+
            ($propertyInfoOne->amenitiesComparison*$amenitiesWeightagePer);
        $propertyInfoOne->weightedFacAdj = $weightedFacAdjProOne;

        $weightedFacAdjProTwo = ($propertyInfoOne->aptSizeIPMSComparison*$sizeWeightagePer)+
            ($propertyInfoTwo->bedComparison*$bedroomsWeightagePer)+
            ($propertyInfoTwo->bathComparison*$bathWeightagePer)+
            ($propertyInfoTwo->finishingQualityComparison*$finishingQualityWeightagePer)+
            ($propertyInfoTwo->amenitiesComparison*$amenitiesWeightagePer);
        $propertyInfoTwo->weightedFacAdj = $weightedFacAdjProTwo;

        $weightedFacAdjProThree = ($propertyInfoOne->aptSizeIPMSComparison*$sizeWeightagePer)+
            ($propertyInfoThree->bedComparison*$bedroomsWeightagePer)+
            ($propertyInfoThree->bathComparison*$bathWeightagePer)+
            ($propertyInfoThree->finishingQualityComparison*$finishingQualityWeightagePer)+
            ($propertyInfoThree->amenitiesComparison*$amenitiesWeightagePer);
        $propertyInfoThree->weightedFacAdj = $weightedFacAdjProThree;

        //Amount Adjustment to Original Price
        $propertyInfoOne->amountAdjOriPrice = $propertyInfoOne->estimated_value*$propertyInfoOne->weightedFacAdj;
        $propertyInfoTwo->amountAdjOriPrice = $propertyInfoTwo->estimated_value*$propertyInfoTwo->weightedFacAdj;
        $propertyInfoThree->amountAdjOriPrice = $propertyInfoThree->estimated_value*$propertyInfoThree->weightedFacAdj;

        //Weighted Factor Average Price
        $propertyInfoOne->weightedFactAvgPrice = $propertyInfoOne->estimated_value+$propertyInfoOne->amountAdjOriPrice;
        $propertyInfoTwo->weightedFactAvgPrice = $propertyInfoTwo->estimated_value+$propertyInfoTwo->amountAdjOriPrice;
        $propertyInfoThree->weightedFactAvgPrice = $propertyInfoThree->estimated_value+$propertyInfoThree->amountAdjOriPrice;

        //Comparable Overall Weighted Adjustment
        $propertyInfoOne->comparableOverallWeightAdj = 100;
        $propertyInfoTwo->comparableOverallWeightAdj = 0.00;
        $propertyInfoThree->comparableOverallWeightAdj = 0.00;

        //Total Weighted Adjusted Price
        $propertyInfoOne->totalWeightAdjPrice = $propertyInfoOne->weightedFactAvgPrice * $propertyInfoOne->comparableOverallWeightAdj;
        $propertyInfoTwo->totalWeightAdjPrice = $propertyInfoTwo->weightedFactAvgPrice * $propertyInfoTwo->comparableOverallWeightAdj;
        $propertyInfoThree->totalWeightAdjPrice =$propertyInfoThree->weightedFactAvgPrice * $propertyInfoThree->comparableOverallWeightAdj;

        $propertyInfoOne->totalWeightAdjPrice = $propertyInfoOne->weightedFactAvgPrice * $propertyInfoOne->comparableOverallWeightAdj;
        $propertyInfoTwo->totalWeightAdjPrice = $propertyInfoTwo->weightedFactAvgPrice * $propertyInfoTwo->comparableOverallWeightAdj;
        $propertyInfoThree->totalWeightAdjPrice =$propertyInfoThree->weightedFactAvgPrice * $propertyInfoThree->comparableOverallWeightAdj;

        //Subject Property Weighted Market Value
        $propertyBaseInfo->weightedMrktValue = $propertyInfoOne->totalWeightAdjPrice
            +$propertyInfoTwo->totalWeightAdjPrice
            +$propertyInfoThree->totalWeightAdjPrice;

        $propertiesInfo = array();
        $propertiesInfo['propertyBaseInfo'] = $propertyBaseInfo;
        $propertiesInfo['propertyInfoOne'] = $propertyInfoOne;
        $propertiesInfo['propertyInfoTwo'] = $propertyInfoTwo;
        $propertiesInfo['propertyInfoThree'] = $propertyInfoThree;

        $this->propertiesInfo = $propertiesInfo;
        $this->propertyBaseInfo = $propertyBaseInfo;
        $this->propertyInfoOne = $propertyInfoOne;
        $this->propertyInfoTwo = $propertyInfoTwo;
        $this->propertyInfoThree = $propertyInfoThree;

        return view('admin.projects.ValuationMethodology.ComparisionApartmentRes', $this->data)->render();

    }

    public function comparisionLand(Request $request)
    {

        $propertyIdBase = isset($request->basePropertyId) ? $request->basePropertyId : 0;
        if ($propertyIdBase <= 0) {
            return Reply::error('Base property id should be greater then 0');
        }

        $propertyIdOne = isset($request->comparePropertyOne) ? $request->comparePropertyOne : 0;
        if ($propertyIdOne <= 0) {
            return Reply::error('comparable property 1 id should be greater then 0');
        }

        $propertyIdTwo = isset($request->comparePropertyTwo) ? $request->comparePropertyTwo : 0;
        if ($propertyIdTwo <= 0) {
            return Reply::error('comparable property 2 id should be greater then 0');
        }

        $propertyIdThree = isset($request->comparePropertyThree) ? $request->comparePropertyThree : 0;
        if ($propertyIdThree <= 0) {
            return Reply::error('comparable property 3 id should be greater then 0');
        }

        //currency
        $this->currency = 'BHD';

        //percentage
        $sizeWeightagePer = '50';
        $this->sizeWeightagePerText = '50%';
        $recencyOfTransWeightagePer = '25';
        $this->recencyOfTransWeightagePerText = '25%';
        $locationWeightagePer = '20';
        $this->locationWeightagePerText = '20%';
        $NoAccessRoadsWeightagePer = '5';
        $this->NoAccessRoadsWeightagePer = '5%';

        $propertyBaseInfo = ValuationProperty::findOrFail($propertyIdBase);

        $propertyBaseInfo->landPriceWeightVal = '';
        $propertyBaseInfo->landSizeWeightVal = 36597.6;
        $propertyBaseInfo->RecencyOfTansWeightVal = '';
        $propertyBaseInfo->RecencyOfTansWeightTitle = 'current now';
        $propertyBaseInfo->locationCity = 'Budaiya';
        $propertyBaseInfo->locationWeightTitle = '';
        $propertyBaseInfo->locationWeightVal = -10.00;
        $propertyBaseInfo->numAccRoads = 4.00;
        $propertyBaseInfo->numAccRoadsWeightTitle = '';
        $propertyBaseInfo->numAccRoadsWeightVal = '0';

        $propertyInfoOne = ValuationProperty::findOrFail($propertyIdOne);

        $propertyInfoOne->landPriceWeightVal = '741000';
        $propertyInfoOne->landSizeWeightVal = '52926';
        $propertyInfoOne->RecencyOfTansWeightTitle = 'current now';
        $propertyInfoOne->RecencyOfTansWeightVal = 0.00;
        $propertyInfoOne->locationCity = 'Hamala';
        $propertyInfoOne->locationWeightTitle = 'Higher Rental';
        $propertyInfoOne->locationWeightVal = -10.00;
        $propertyInfoOne->numAccRoads = 1.00;
        $propertyInfoOne->numAccRoadsWeightTitle = '';
        $propertyInfoOne->numAccRoadsWeightVal = '3.75';

        $propertyInfoTwo = ValuationProperty::findOrFail($propertyIdTwo);

        $propertyInfoTwo->landPriceWeightVal = '960000';
        $propertyInfoTwo->landSizeWeightVal = '35521';
        $propertyInfoTwo->RecencyOfTansWeightTitle = 'current now';
        $propertyInfoTwo->RecencyOfTansWeightVal = 0.00;
        $propertyInfoTwo->locationCity = 'Janabiya';
        $propertyInfoTwo->locationWeightTitle = 'Higher Rental';
        $propertyInfoTwo->locationWeightVal = -10.00;
        $propertyInfoTwo->numAccRoads = 2.00;
        $propertyInfoTwo->numAccRoadsWeightTitle = '';
        $propertyInfoTwo->numAccRoadsWeightVal = 5.00;

        $propertyInfoThree = ValuationProperty::findOrFail($propertyIdThree);

        $propertyInfoThree->landPriceWeightVal = '484000';
        $propertyInfoThree->landSizeWeightVal = '32292';
        $propertyInfoThree->RecencyOfTansWeightVal = 0.00;
        $propertyInfoThree->RecencyOfTansWeightTitle = 'current now';
        $propertyInfoThree->locationCity = 'Diraz';
        $propertyInfoThree->locationWeightTitle = 'same';
        $propertyInfoThree->locationWeightVal = 0.00;
        $propertyInfoThree->numAccRoads = 1.00;
        $propertyInfoThree->numAccRoadsWeightTitle = 'Other-';
        $propertyInfoThree->numAccRoadsWeightVal = 2.50;

        //compare Processing start

        //Land Size (sq. ft)
        $landSizePropertyBase = $propertyBaseInfo->landSizeWeightVal;
        $landSizePropertyInfoOne = $propertyInfoOne->landSizeWeightVal;
        $landSizePropertyInfoTwo = $propertyInfoTwo->landSizeWeightVal;
        $landSizePropertyInfoThree = $propertyInfoThree->landSizeWeightVal;

        $landSizePropertyBaseMinusProOne = $landSizePropertyBase - $landSizePropertyInfoOne;
        $propertyInfoOne->landSizeCal = $landSizePropertyBaseMinusProOne;
        $propertyInfoOne->landSizeComparison = ($landSizePropertyBaseMinusProOne / $landSizePropertyBase);

        $landSizePropertyBaseMinusProTwo = $landSizePropertyBase - $landSizePropertyInfoTwo;
        $propertyInfoTwo->landSizeCal = $landSizePropertyBaseMinusProTwo;
        $propertyInfoTwo->landSizeComparison = ($landSizePropertyBaseMinusProTwo / $landSizePropertyBase);

        $landSizePropertyBaseMinusProThree = $landSizePropertyBase - $landSizePropertyInfoThree;
        $propertyInfoThree->landSizeCal = $landSizePropertyBaseMinusProThree;
        $propertyInfoThree->landSizeComparison = ($landSizePropertyBaseMinusProThree / $landSizePropertyBase);

        //Recency of Transaction
        $recencyOfTansPropertyBase = $propertyBaseInfo->recencyOfTansWeightVal;
        $recencyOfTansPropertyInfoOne = $propertyInfoOne->recencyOfTansWeightVal;
        $recencyOfTansPropertyInfoTwo = $propertyInfoTwo->recencyOfTansWeightVal;
        $recencyOfTansPropertyInfoThree = $propertyInfoThree->recencyOfTansWeightVal;
        $maxRecencyOfTans = 10;

        $landSizePropertyBaseCalProOne = ((0-$recencyOfTansPropertyInfoOne)/$maxRecencyOfTans);
        $propertyInfoOne->recencyOfTansComparison = $landSizePropertyBaseCalProOne;

        $landSizePropertyBaseCalProTwo = ((0-$recencyOfTansPropertyInfoTwo)/$maxRecencyOfTans);
        $propertyInfoTwo->recencyOfTansComparison = $landSizePropertyBaseCalProTwo;

        $landSizePropertyBaseCalProThree = ((0-$recencyOfTansPropertyInfoThree)/$maxRecencyOfTans);
        $propertyInfoThree->recencyOfTansComparison = $landSizePropertyBaseCalProThree;

        //Location
        $locationPropertyInfoOne = $propertyInfoOne->recencyOfTansWeightVal;
        $locationOfTansPropertyInfoTwo = $propertyInfoTwo->recencyOfTansWeightVal;
        $locationOfTansPropertyInfoThree = $propertyInfoThree->recencyOfTansWeightVal;
        $maxLocation = 10;

        $locationPropertyBaseCalProOne = (($locationPropertyInfoOne)/$maxLocation);
        $propertyInfoOne->locationComparison = $locationPropertyBaseCalProOne;

        $locationPropertyBaseCalProTwo = (($locationOfTansPropertyInfoTwo)/$maxLocation);
        $propertyInfoTwo->locationComparison = $locationPropertyBaseCalProTwo;

        $locationPropertyBaseCalProThree = (($locationOfTansPropertyInfoThree)/$maxLocation);
        $propertyInfoThree->locationComparison = $locationPropertyBaseCalProThree;

        //No. of Access Roads
        $numAccRoadsPropertyBase = $propertyBaseInfo->numAccRoads;
        $numAccRoadsPropertyInfoOne = $propertyInfoOne->numAccRoads;
        $numAccRoadsPropertyInfoTwo = $propertyInfoTwo->numAccRoads;
        $numAccRoadsPropertyInfoThree = $propertyInfoThree->numAccRoads;

        $propertyInfoOne->numAccRoadsComparison = ($numAccRoadsPropertyInfoOne / $numAccRoadsPropertyBase);

        $propertyInfoTwo->numAccRoadsComparison = ($numAccRoadsPropertyInfoTwo / $numAccRoadsPropertyBase);

        $propertyInfoThree->numAccRoadsComparison = ($numAccRoadsPropertyInfoThree / $numAccRoadsPropertyBase);

        $propertiesInfo = array();
        $propertiesInfo['propertyBaseInfo'] = $propertyBaseInfo;
        $propertiesInfo['propertyInfoOne'] = $propertyInfoOne;
        $propertiesInfo['propertyInfoTwo'] = $propertyInfoTwo;
        $propertiesInfo['propertyInfoThree'] = $propertyInfoThree;

        $this->propertiesInfo = $propertiesInfo;
        $this->propertyBaseInfo = $propertyBaseInfo;
        $this->propertyInfoOne = $propertyInfoOne;
        $this->propertyInfoTwo = $propertyInfoTwo;
        $this->propertyInfoThree = $propertyInfoThree;

        return view('admin.projects.ValuationMethodology.ComparisionLandRes', $this->data)->render();

    }




























    ////////////////////////////////////////////// not in use

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->projectMember = ProjectMember::findOrFail($id);
        return view('admin.projects.project-member.edit', $this->data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $member = ProjectMember::findOrFail($id);
        $member->hourly_rate = $request->hourly_rate;
        $member->save();
        return Reply::success(__('messages.updateSuccess'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $projectMember = ProjectMember::findOrFail($id);

        $project = Project::findOrFail($projectMember->project_id);

        if ($project->project_admin == $projectMember->user_id) {
            $project->project_admin = null;
            $project->save();
        }
        $projectMember->delete();

        return Reply::success(__('messages.memberRemovedFromProject'));
    }

    public function storeGroup(SaveGroupMembers $request)
    {
        $groups = $request->group_id;
        $project = Project::find($request->project_id);

        foreach ($groups as $group) {

            $members = EmployeeDetails::join('users', 'users.id', '=', 'employee_details.user_id')
                ->where('employee_details.department_id', $group)
                ->where('users.status', 'active')
                ->select('employee_details.*')
                ->get();

            foreach ($members as $user) {
                $check = ProjectMember::where('user_id', $user->user_id)->where('project_id', $request->project_id)->first();

                if (is_null($check)) {
                    $member = new ProjectMember();
                    $member->user_id = $user->user_id;
                    $member->project_id = $request->project_id;
                    $member->save();

                    if ($project->publish_status == 'published') {
                        $this->logProjectActivity($request->project_id, ucwords($member->user->name) . __('messages.isAddedAsProjectMember'));
                    }
                }
            }
        }

        return Reply::success(__('messages.membersAddedSuccessfully'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectMembers $request)
    {

    }
}
