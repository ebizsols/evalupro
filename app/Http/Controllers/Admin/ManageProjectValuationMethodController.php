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
use Modules\Valuation\Entities\MethodologyTemplate;
use Modules\Valuation\Entities\ValuationProperty;
use Modules\Valuation\Entities\ValuationPropertyType;
use Modules\Valuation\Entities\ValuationPropertyWeightage;

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
                    case 'Apartment':
                        break;
                    case 'Land':
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
            default:

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

        $propertyBaseInfo = ValuationProperty::find($propertyIdBase);

        $propertyBaseInfo->bedrooms = 2;
        $propertyBaseInfo->bathrooms = 3;
        $propertyBaseInfo->finishingQuality = 6.25;
        $propertyBaseInfo->maintenance = 0;
        $propertyBaseInfo->floorLevel = 3;
        $propertyBaseInfo->amenities = 8;

        $propertyInfoOne = ValuationProperty::find($propertyIdOne);
        $propertyInfoOne->bedrooms = 2;
        $propertyInfoOne->bathrooms = 3;
        $propertyInfoOne->finishingQuality = 6.25;
        $propertyInfoOne->maintenance = 0;
        $propertyInfoOne->floorLevel = 3;
        $propertyInfoOne->amenities = 8;

        $propertyInfoTwo = ValuationProperty::find($propertyIdTwo);
        $propertyInfoTwo->bedrooms = 2;
        $propertyInfoTwo->bathrooms = 3;
        $propertyInfoTwo->finishingQuality = 6.25;
        $propertyInfoTwo->maintenance = 0;
        $propertyInfoTwo->floorLevel = 3;
        $propertyInfoTwo->amenities = 8;

        $propertyInfoThree = ValuationProperty::find($propertyIdThree);
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

        // echo "<pre>";
        // print_r($propertyInfo);
        // exit;

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

        // New Code
        $templateData = MethodologyTemplate::get();
        $typeId = $templateData->pluck('type_id')->first();
        $propertyType = ValuationPropertyType::find($typeId);
        $TypeTitle = $propertyType->pluck('title')->toArray();
        
        $propertyBaseId = ValuationProperty::find($propertyIdBase);
        $BaseType = $propertyBaseId->type_id;
        $BaseTitle = valuationPropertyType::find($BaseType);
        $BaseTypeTitle = $BaseTitle->title;

        $valuationMethod = 'comparision';

        switch ($valuationMethod) {
            case 'comparision':
                switch (in_array($BaseTypeTitle, $TypeTitle) == true) {
                    case $BaseTypeTitle == 'Apartment':
                        $comparisionMethodRes = $this->comparisionApartment($request);

                        $returnArray = array();
                        $returnArray['comparisionResponseHtml'] = $comparisionMethodRes;
                        $returnArray['status'] = 'success';
                        $saveData = $request->saveData;
                        if ($saveData == true) {
                            return Reply::success('Data Saved Successfully!');
                        } else {
                            return Reply::successWithData('Comparison Completed', $returnArray);
                        }
                        break;
                    case $BaseTypeTitle == 'Land':
                        $comparisionMethodRes = $this->comparisionLand($request);

                        $returnArray = array();
                        $returnArray['comparisionResponseHtml'] = $comparisionMethodRes;
                        $returnArray['status'] = 'success';

                        return Reply::successWithData('Comparison Completed', $returnArray);
                        break;
                    default:
                        return Reply::error('Property type not define, please create a template');
                }


                break;
            default:
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
        // Apartment
        $sizeWeightagePer = '40';
        $this->sizeWeightagePerText = '40%';
        $this->sizeWeightagePerText = isset($request->apartmentWeightage) ? $request->apartmentWeightage: 0;
        // dd($this->sizeWeightagePerText);
        // Bedrooms
        $bedroomsWeightagePer = '20';
        $this->bedroomsWeightagePerText = '20%';
        // Bathrooms
        $bathWeightagePer = '10';
        $this->bathWeightagePerText = '10%';
        // Finishing Quality
        $finishingQualityWeightagePer = '15';
        $this->finishingQualityWeightagePerText = '15%';
        // Amenities
        $amenitiesWeightagePer = '15';
        $this->amenitiesWeightagePerText = '15%';

        $propertyBaseInfo = ValuationProperty::find($propertyIdBase);
        $propertyInfoOne = ValuationProperty::find($propertyIdOne);
        $propertyInfoTwo = ValuationProperty::find($propertyIdTwo);
        $propertyInfoThree = ValuationProperty::find($propertyIdThree);

        $templateData = MethodologyTemplate::get()->pluck('template_category')->toArray();
        $templateData = $templateData[0];
        $templateData = json_decode($templateData);

        $this->subjectProperty($propertyBaseInfo, $propertyInfoOne, $propertyInfoTwo, $propertyInfoThree);

        if (in_array("apartmentSize", $templateData)) {
            $this->apartmentSize($propertyBaseInfo, $propertyInfoOne, $propertyInfoTwo, $propertyInfoThree);
        }
        if (in_array("noOfBedrooms", $templateData)) {
            $this->noOfBedrooms($propertyBaseInfo, $propertyInfoOne, $propertyInfoTwo, $propertyInfoThree);
        }
        if (in_array("noOfBathrooms", $templateData)) {
            $this->noOfBathrooms($propertyBaseInfo, $propertyInfoOne, $propertyInfoTwo, $propertyInfoThree);
        }
        if (in_array("finishingQuality", $templateData)) {
            $this->finishingQuality($propertyBaseInfo, $propertyInfoOne, $propertyInfoTwo, $propertyInfoThree);
        }
        if (in_array("buildingAmenities", $templateData)) {
            $this->buildingAmenities($propertyBaseInfo, $propertyInfoOne, $propertyInfoTwo, $propertyInfoThree);
        }

        $apartmentSizeComparison = in_array("apartmentSize", $templateData);
        $noOfBedroomsComparison = in_array("noOfBedrooms", $templateData);
        $noOfBathroomsComparison = in_array("noOfBathrooms", $templateData);
        $finishingQualityComparison = in_array("finishingQuality", $templateData);
        $buildingAmenitiesComparison = in_array("buildingAmenities", $templateData);
        // if () {

        // } else {

        // }
        //compare Processing start

        if ($apartmentSizeComparison) {
            //apartment comparison
            $baseAptSizeIPMS = $propertyBaseInfo->aptSizeIPMS;
            $aptSizeIPMSPropertyInfoOne = $propertyInfoOne->aptSizeIPMS;
            $aptSizeIPMSPropertyInfoTwo = $propertyInfoTwo->aptSizeIPMS;
            $aptSizeIPMSPropertyInfoThree = $propertyInfoThree->aptSizeIPMS;
            $maxBedrooms = '8';

            $baseAptSizeIPMSMinusProOne = $baseAptSizeIPMS - $aptSizeIPMSPropertyInfoOne;
            $propertyInfoOne->aptSizeIPMSCal = $baseAptSizeIPMSMinusProOne;
            if ($baseAptSizeIPMS == 0) {
                $propertyInfoOne->aptSizeIPMSComparison = 0;
            } else {
                $propertyInfoOne->aptSizeIPMSComparison = round(($baseAptSizeIPMSMinusProOne / $baseAptSizeIPMS) * 100, 3);
            }

            $baseAptSizeIPMSMinusProTwo = $baseAptSizeIPMS - $aptSizeIPMSPropertyInfoTwo;
            $propertyInfoTwo->aptSizeIPMSCal = $baseAptSizeIPMSMinusProTwo;
            if ($baseAptSizeIPMS == 0) {
                $propertyInfoTwo->aptSizeIPMSComparison = 0;
            } else {
                $propertyInfoTwo->aptSizeIPMSComparison = round(($baseAptSizeIPMSMinusProTwo / $baseAptSizeIPMS) * 100, 3);
            }

            $baseAptSizeIPMSMinusProThree = $baseAptSizeIPMS - $aptSizeIPMSPropertyInfoThree;
            $propertyInfoThree->aptSizeIPMSCal = $baseAptSizeIPMSMinusProThree;
            if ($baseAptSizeIPMS == 0) {
                $propertyInfoThree->aptSizeIPMSComparison = 0;
            } else {
                $propertyInfoThree->aptSizeIPMSComparison = round(($baseAptSizeIPMSMinusProThree / $baseAptSizeIPMS) * 100, 3);
            }
        }

        if ($noOfBedroomsComparison) {
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
        }

        if ($noOfBathroomsComparison) {
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
        }

        if ($finishingQualityComparison) {
            //Finishing Quality
            $finishingQualityBase = $propertyBaseInfo->finishingQuality;
            $maintenanceBase = $propertyBaseInfo->maintenance;
            $propertyBaseInfo->finishingQualitySelectionTitle = $finishingQualityBase;
            $propertyBaseInfo->maintenanceSelectionTitle = $maintenanceBase;

            $finishingQualityPropertyInfoOne = $propertyInfoOne->finishingQuality;
            $maintenancePropertyInfoOne = $propertyInfoOne->maintenance;
            $propertyInfoOne->finishingQualitySelectionTitle = $finishingQualityPropertyInfoOne;
            $propertyInfoOne->maintenanceSelectionTitle = $finishingQualityPropertyInfoOne;

            $finishingQualityPropertyInfoTwo = $propertyInfoTwo->finishingQuality;
            $maintenancePropertyInfoTwo = $propertyInfoTwo->maintenance;
            $propertyInfoTwo->finishingQualitySelectionTitle = $finishingQualityPropertyInfoTwo;
            $propertyInfoTwo->maintenanceSelectionTitle = $maintenancePropertyInfoTwo;

            $finishingQualityPropertyInfoThree = $propertyInfoThree->finishingQuality;
            $maintenancePropertyInfoThree = $propertyInfoThree->maintenance;
            $propertyInfoThree->finishingQualitySelectionTitle = $finishingQualityPropertyInfoThree;
            $propertyInfoThree->maintenanceSelectionTitle = $maintenancePropertyInfoThree;

            $finishingQualityCalBase = $finishingQualityBase + $maintenanceBase;
            $propertyBaseInfo->finishingQualityCalBase = $finishingQualityCalBase;

            $finishingQualityCalProOne = $finishingQualityPropertyInfoOne + $maintenancePropertyInfoOne;
            $propertyInfoOne->finishingQualityCalOne = $finishingQualityCalProOne;
            $propertyInfoOne->finishingQualityComparison = ($finishingQualityCalBase - $finishingQualityCalProOne) / 100;

            $finishingQualityCalProTwo = $finishingQualityPropertyInfoTwo + $maintenancePropertyInfoTwo;
            $propertyInfoTwo->finishingQualityCalTwo = $finishingQualityCalProTwo;
            $propertyInfoTwo->finishingQualityComparison = ($finishingQualityCalBase - $finishingQualityCalProTwo) / 100;

            $finishingQualityCalProThree = $finishingQualityPropertyInfoThree + $maintenancePropertyInfoThree;
            $propertyInfoThree->finishingQualityCalThree = $finishingQualityCalProThree;
            $propertyInfoThree->finishingQualityComparison = ($finishingQualityCalBase - $finishingQualityCalProThree) / 100;
        }

        if ($buildingAmenitiesComparison) {
            // Building Amenities and Facilities
            $amenitiesBase = $propertyBaseInfo->amenities;
            $propertyBaseInfo->amenitiesSlectionTitle = $amenitiesBase;

            $amenitiesPropertyInfoOne = $propertyInfoOne->amenities;
            $propertyInfoOne->amenitiesSlectionTitle = $amenitiesPropertyInfoOne;

            $amenitiesPropertyInfoTwo = $propertyInfoTwo->amenities;
            $propertyInfoTwo->amenitiesSlectionTitle = $amenitiesPropertyInfoTwo;

            $amenitiesPropertyInfoThree = $propertyInfoThree->amenities;
            $propertyInfoThree->amenitiesSlectionTitle = $amenitiesPropertyInfoThree;

            $amenitiesMax = 8;

            $propertyInfoOne->amenitiesComparison = ($amenitiesBase - $amenitiesPropertyInfoOne) / $amenitiesMax;
            $propertyInfoThree->amenitiesComparison = ($amenitiesBase - $amenitiesPropertyInfoTwo) / $amenitiesMax;
            $propertyInfoThree->amenitiesComparison = ($amenitiesBase - $amenitiesPropertyInfoThree) / $amenitiesMax;
        }

        if (!$apartmentSizeComparison) {
            $propertyInfoOne->aptSizeIPMSComparison = 0;
            $propertyInfoTwo->aptSizeIPMSComparison = 0;
            $propertyInfoThree->aptSizeIPMSComparison   = 0;
            // dd("No Apartment Comparison Done");
        }
        if (!$noOfBedroomsComparison) {
            $propertyInfoOne->bedComparison = 0;
            $propertyInfoTwo->bedComparison = 0;
            $propertyInfoThree->bedComparison = 0;
        }
        if (!$noOfBathroomsComparison) {
            $propertyInfoOne->bathComparison = 0;
            $propertyInfoTwo->bathComparison = 0;
            $propertyInfoThree->bathComparison = 0;
        }
        if (!$finishingQualityComparison) {
            $propertyInfoOne->finishingQualityComparison = 0;
            $propertyInfoTwo->finishingQualityComparison = 0;
            $propertyInfoThree->finishingQualityComparison = 0;
        }
        if (!$buildingAmenitiesComparison) {
            $propertyInfoOne->amenitiesComparison = 0;
            $propertyInfoTwo->amenitiesComparison = 0;
            $propertyInfoThree->amenitiesComparison = 0;
        }

        //Weighted Factor Adjustment
        $weightedFacAdjProOne = ($propertyInfoOne->aptSizeIPMSComparison * $sizeWeightagePer) +
            ($propertyInfoOne->bedComparison * $bedroomsWeightagePer) +
            ($propertyInfoOne->bathComparison * $bathWeightagePer) +
            ($propertyInfoOne->finishingQualityComparison * $finishingQualityWeightagePer) +
            ($propertyInfoOne->amenitiesComparison * $amenitiesWeightagePer);
        $propertyInfoOne->weightedFacAdj = $weightedFacAdjProOne;

        $weightedFacAdjProTwo = ($propertyInfoOne->aptSizeIPMSComparison * $sizeWeightagePer) +
            ($propertyInfoTwo->bedComparison * $bedroomsWeightagePer) +
            ($propertyInfoTwo->bathComparison * $bathWeightagePer) +
            ($propertyInfoTwo->finishingQualityComparison * $finishingQualityWeightagePer) +
            ($propertyInfoTwo->amenitiesComparison * $amenitiesWeightagePer);
        $propertyInfoTwo->weightedFacAdj = $weightedFacAdjProTwo;

        $weightedFacAdjProThree = ($propertyInfoOne->aptSizeIPMSComparison * $sizeWeightagePer) +
            ($propertyInfoThree->bedComparison * $bedroomsWeightagePer) +
            ($propertyInfoThree->bathComparison * $bathWeightagePer) +
            ($propertyInfoThree->finishingQualityComparison * $finishingQualityWeightagePer) +
            ($propertyInfoThree->amenitiesComparison * $amenitiesWeightagePer);
        $propertyInfoThree->weightedFacAdj = $weightedFacAdjProThree;

        //Amount Adjustment to Original Price
        $propertyInfoOne->amountAdjOriPrice = $propertyInfoOne->estimated_value * $propertyInfoOne->weightedFacAdj;
        $propertyInfoTwo->amountAdjOriPrice = $propertyInfoTwo->estimated_value * $propertyInfoTwo->weightedFacAdj;
        $propertyInfoThree->amountAdjOriPrice = $propertyInfoThree->estimated_value * $propertyInfoThree->weightedFacAdj;

        //Weighted Factor Average Price
        $propertyInfoOne->weightedFactAvgPrice = $propertyInfoOne->estimated_value + $propertyInfoOne->amountAdjOriPrice;
        $propertyInfoTwo->weightedFactAvgPrice = $propertyInfoTwo->estimated_value + $propertyInfoTwo->amountAdjOriPrice;
        $propertyInfoThree->weightedFactAvgPrice = $propertyInfoThree->estimated_value + $propertyInfoThree->amountAdjOriPrice;

        //Comparable Overall Weighted Adjustment
        $propertyInfoOne->comparableOverallWeightAdj = 33.3;
        $propertyInfoTwo->comparableOverallWeightAdj = 33.3;
        $propertyInfoThree->comparableOverallWeightAdj = 33.3;

        //Total Weighted Adjusted Price
        $propertyInfoOne->totalWeightAdjPrice = $propertyInfoOne->weightedFactAvgPrice * $propertyInfoOne->comparableOverallWeightAdj;
        $propertyInfoTwo->totalWeightAdjPrice = $propertyInfoTwo->weightedFactAvgPrice * $propertyInfoTwo->comparableOverallWeightAdj;
        $propertyInfoThree->totalWeightAdjPrice = $propertyInfoThree->weightedFactAvgPrice * $propertyInfoThree->comparableOverallWeightAdj;

        //Subject Property Weighted Market Value
        $propertyBaseInfo->weightedMrktValue = $propertyInfoOne->totalWeightAdjPrice
            + $propertyInfoTwo->totalWeightAdjPrice
            + $propertyInfoThree->totalWeightAdjPrice;

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

        $comparisonResultData = array();
        $comparisonResultData['apartmentSizeComparison'] = $apartmentSizeComparison;
        $comparisonResultData['noOfBedroomsComparison'] = $noOfBedroomsComparison;
        $comparisonResultData['noOfBathroomsComparison'] = $noOfBathroomsComparison;
        $comparisonResultData['finishingQualityComparison'] = $finishingQualityComparison;
        $comparisonResultData['buildingAmenitiesComparison'] = $buildingAmenitiesComparison;

        $comparisonResultData['currency'] = 'BHD';

        //percentage
        $sizeWeightagePer = '40';
        $comparisonResultData['sizeWeightagePerText'] = $this->sizeWeightagePerText;
        $bedroomsWeightagePer = '20';
        $comparisonResultData['bedroomsWeightagePerText'] = '20%';
        $bathWeightagePer = '10';
        $comparisonResultData['bathWeightagePerText'] = '10%';
        $finishingQualityWeightagePer = '15';
        $comparisonResultData['finishingQualityWeightagePerText'] = '15%';
        $amenitiesWeightagePer = '15';
        $comparisonResultData['amenitiesWeightagePerText'] = '15%';

        $projectId = $request->projectId;
        $comparisonResultData['projectId'] = $projectId;
        $basePropertyId = $request->basePropertyId;
        $comparisonResultData['basePropertyId'] = $basePropertyId;
        $comparePropertyOne = $request->comparePropertyOne;
        $comparisonResultData['comparePropertyOne'] = $comparePropertyOne;
        $comparePropertyTwo = $request->comparePropertyTwo;
        $comparisonResultData['comparePropertyTwo'] = $comparePropertyTwo;
        $comparePropertyThree = $request->comparePropertyThree;
        $comparisonResultData['comparePropertyThree'] = $comparePropertyThree;

        $comparisonResultData['propertyBaseInfo'] = $propertyBaseInfo->toArray();
        unset($comparisonResultData['propertyBaseInfo']['metarelation']);

        $comparisonResultData['propertyInfoOne'] = $propertyInfoOne->toArray();
        unset($comparisonResultData['propertyInfoOne']['metarelation']);

        $comparisonResultData['propertyInfoTwo'] = $propertyInfoTwo->toArray();
        unset($comparisonResultData['propertyInfoTwo']['metarelation']);

        $comparisonResultData['propertyInfoThree'] = $propertyInfoThree->toArray();
        unset($comparisonResultData['propertyInfoThree']['metarelation']);
        $comparisonResultData = (array)json_decode(json_encode($comparisonResultData));
        // $comparisonResultData['comparisonResultData'] = $comparisonResultData;

        // dd($comparisonResultData);
        // Condition
        $saveData = $request->saveData;
        if ($saveData == true) {
            $project = Project::find($projectId);
            $metaData = array();
            $metaData['methodologyResult'] = json_encode($comparisonResultData);
            $project->setMeta($metaData);
        } else {
            return view('admin.projects.ValuationMethodology.ComparisionApartmentRes', $comparisonResultData)->render();
        }
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

        $landSizePropertyBaseCalProOne = ((0 - $recencyOfTansPropertyInfoOne) / $maxRecencyOfTans);
        $propertyInfoOne->recencyOfTansComparison = $landSizePropertyBaseCalProOne;

        $landSizePropertyBaseCalProTwo = ((0 - $recencyOfTansPropertyInfoTwo) / $maxRecencyOfTans);
        $propertyInfoTwo->recencyOfTansComparison = $landSizePropertyBaseCalProTwo;

        $landSizePropertyBaseCalProThree = ((0 - $recencyOfTansPropertyInfoThree) / $maxRecencyOfTans);
        $propertyInfoThree->recencyOfTansComparison = $landSizePropertyBaseCalProThree;

        //Location
        $locationPropertyInfoOne = $propertyInfoOne->recencyOfTansWeightVal;
        $locationOfTansPropertyInfoTwo = $propertyInfoTwo->recencyOfTansWeightVal;
        $locationOfTansPropertyInfoThree = $propertyInfoThree->recencyOfTansWeightVal;
        $maxLocation = 10;

        $locationPropertyBaseCalProOne = (($locationPropertyInfoOne) / $maxLocation);
        $propertyInfoOne->locationComparison = $locationPropertyBaseCalProOne;

        $locationPropertyBaseCalProTwo = (($locationOfTansPropertyInfoTwo) / $maxLocation);
        $propertyInfoTwo->locationComparison = $locationPropertyBaseCalProTwo;

        $locationPropertyBaseCalProThree = (($locationOfTansPropertyInfoThree) / $maxLocation);
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

    public function subjectProperty(&$propertyBaseInfo, &$propertyInfoOne, &$propertyInfoTwo, &$propertyInfoThree)
    {
        // BASE COMPARISION
        $this->estimatedValueBase = 0;
        // 1st COMPARISION
        $this->estimatedValueOne = $propertyInfoOne->getMeta(ValuationProperty::EstimatedValuePropertyInfo);
        $this->estimatedValueOne = (isset($this->estimatedValueOne[0]) && $this->estimatedValueOne[0] != ''  && !empty($this->estimatedValueOne[0])) ? $this->estimatedValueOne[0] : 0;

        $propertyInfoOne->estimated_value = (isset($this->estimatedValueOne) && $this->estimatedValueOne != '') ? $this->estimatedValueOne : 0;
        // 2nd COMPARISION
        $this->estimatedValueTwo = $propertyInfoTwo->getMeta(ValuationProperty::EstimatedValuePropertyInfo);
        $this->estimatedValueTwo = (isset($this->estimatedValueTwo[0]) && $this->estimatedValueTwo[0] != '' && !empty($this->estimatedValueTwo[0])) ? $this->estimatedValueTwo[0] : 0;

        $propertyInfoTwo->estimated_value = (isset($this->estimatedValueTwo) && $this->estimatedValueTwo != '') ? $this->estimatedValueTwo : 0;
        // 3rd COMPARISION
        $this->estimatedValueThree = $propertyInfoThree->getMeta(ValuationProperty::EstimatedValuePropertyInfo);
        $this->estimatedValueThree = (isset($this->estimatedValueThree[0]) && $this->estimatedValueThree[0] != '' && !empty($this->estimatedValueThree[0])) ? $this->estimatedValueThree[0] : 0;

        $propertyInfoThree->estimated_value = (isset($this->estimatedValueThree) && $this->estimatedValueThree != '') ? $this->estimatedValueThree : 0;
    }
    public function apartmentSize(&$propertyBaseInfo, &$propertyInfoOne, &$propertyInfoTwo, &$propertyInfoThree)
    {
        // BASE COMPARISION
        $this->sizeInSquareMeterBase = isset($propertyBaseInfo->sizes_in_meter_sq) ? $propertyBaseInfo->sizes_in_meter_sq : 0;

        $propertyBaseInfo->aptSizeIPMS = (isset($this->sizeInSquareMeterBase) && $this->sizeInSquareMeterBase != '') ? $this->sizeInSquareMeterBase : 0;
        $propertyBaseInfo->aptSizeIPMS = round($propertyBaseInfo->aptSizeIPMS, 3);

        // 1st COMPARISION
        $this->sizeInSquareMeterOne = isset($propertyInfoOne->sizes_in_meter_sq) ? $propertyInfoOne->sizes_in_meter_sq : 0;

        $propertyInfoOne->aptSizeIPMS = (isset($this->sizeInSquareMeterOne) && $this->sizeInSquareMeterOne != '') ? $this->sizeInSquareMeterOne : 0;
        $propertyInfoOne->aptSizeIPMS = round($propertyInfoOne->aptSizeIPMS, 3);

        // 2nd COMPARISION
        $this->sizeInSquareMeterTwo = isset($propertyInfoTwo->sizes_in_meter_sq) ? $propertyInfoTwo->sizes_in_meter_sq : 0;

        $propertyInfoTwo->aptSizeIPMS = (isset($this->sizeInSquareMeterTwo) && $this->sizeInSquareMeterTwo != '') ? $this->sizeInSquareMeterTwo : 0;
        $propertyInfoTwo->aptSizeIPMS = round($propertyInfoTwo->aptSizeIPMS, 3);

        // 3rd COMPARISION
        $this->sizeInSquareMeterThree = isset($propertyInfoThree->sizes_in_meter_sq) ? $propertyInfoThree->sizes_in_meter_sq : 0;

        $propertyInfoThree->aptSizeIPMS = (isset($this->sizeInSquareMeterThree) && $this->sizeInSquareMeterThree != '') ? $this->sizeInSquareMeterThree : 0;
        $propertyInfoThree->aptSizeIPMS = round($propertyInfoThree->aptSizeIPMS, 3);

        // return $propertyBaseInfo->aptSizeIPMS;
    }
    public function noOfBedrooms(&$propertyBaseInfo, &$propertyInfoOne, &$propertyInfoTwo, &$propertyInfoThree)
    {
        // BASE COMPARISION
        $noOfBedroomBase = $propertyBaseInfo->getMeta(ValuationProperty::NoOfBedroomText);
        $noOfBedroomBase = (isset($noOfBedroomBase[0]) && $noOfBedroomBase[0] != '' && !empty($noOfBedroomBase[0])) ? $noOfBedroomBase[0] : 0;
        // echo "<pre>"; print_r($noOfBedroomBase); exit;

        $valuationWeightage = new ValuationPropertyWeightage();
        $weightageIdBedroomBase = $valuationWeightage::find($noOfBedroomBase);

        $this->noOfBedroomBase = (isset($weightageIdBedroomBase) && $weightageIdBedroomBase != '') ? $weightageIdBedroomBase['value']:0;
        $propertyBaseInfo->bedrooms = (isset($this->noOfBedroomBase) && $this->noOfBedroomBase != '') ? $this->noOfBedroomBase : 0;

        // 1st COMPARISION
        $noOfBedroomOne = $propertyInfoOne->getMeta(ValuationProperty::NoOfBedroomText);
        $noOfBedroomOne = (isset($noOfBedroomOne[0]) && $noOfBedroomOne[0] != ''  && !empty($noOfBedroomOne[0])) ? $noOfBedroomOne[0] : 0;

        $weightageIdBedroomOne = $valuationWeightage::find($noOfBedroomOne);

        $this->noOfBedroomOne = (isset($weightageIdBedroomOne) && $weightageIdBedroomOne != '') ? $weightageIdBedroomOne['value']:0;
        $propertyInfoOne->bedrooms = (isset($this->noOfBedroomOne) && $this->noOfBedroomOne != '') ? $this->noOfBedroomOne : 0;

        // 2nd COMPARISION
        $noOfBedroomTwo = $propertyInfoTwo->getMeta(ValuationProperty::NoOfBedroomText);
        $noOfBedroomTwo = (isset($noOfBedroomTwo[0]) && $noOfBedroomTwo[0] != '' && !empty($noOfBedroomTwo[0])) ? $noOfBedroomTwo[0] : 0;

        $weightageIdBedroomTwo = $valuationWeightage::find($noOfBedroomTwo);
        $this->noOfBedroomTwo = (isset($weightageIdBedroomTwo) && $weightageIdBedroomTwo != '') ? $weightageIdBedroomTwo['value']:0;

        $propertyInfoTwo->bedrooms = (isset($this->noOfBedroomTwo) && $this->noOfBedroomTwo != '') ? $this->noOfBedroomTwo : 0;

        // 3rd COMPARISION
        $noOfBedroomThree = $propertyInfoThree->getMeta(ValuationProperty::NoOfBedroomText);
        $noOfBedroomThree = (isset($noOfBedroomThree[0]) && $noOfBedroomThree[0] != '' && !empty($noOfBedroomThree[0])) ? $noOfBedroomThree[0] : 0;

        $weightageIdBedroomThree = $valuationWeightage::find($noOfBedroomThree);

        $this->noOfBedroomThree = (isset($weightageIdBedroomThree) && $weightageIdBedroomThree != '') ? $weightageIdBedroomThree['value']:0;
        $propertyInfoThree->bedrooms = (isset($this->noOfBedroomThree) && $this->noOfBedroomThree != '') ? $this->noOfBedroomThree : 0;
    }
    public function noOfBathrooms(&$propertyBaseInfo, &$propertyInfoOne, &$propertyInfoTwo, &$propertyInfoThree)
    {
        // BASE COMPARISION
        $noOfBathroomBase = $propertyBaseInfo->getMeta(ValuationProperty::NoOfBathoomsText);
        $noOfBathroomBase = (isset($noOfBathroomBase[0]) && $noOfBathroomBase[0] != '' && !empty($noOfBathroomBase[0])) ? $noOfBathroomBase[0] : 0;

        $valuationWeightage = new ValuationPropertyWeightage();
        $weightageIdBathroomBase = $valuationWeightage::find($noOfBathroomBase);

        $this->noOfBathroomBase = (isset($weightageIdBathroomBase) && $weightageIdBathroomBase != '') ? $weightageIdBathroomBase['value']:0;
        $propertyBaseInfo->bathrooms = (isset($this->noOfBathroomBase) && $this->noOfBathroomBase != '') ? $this->noOfBathroomBase : 0;

        // 1st COMPARISION
        $noOfBathroomOne = $propertyInfoOne->getMeta(ValuationProperty::NoOfBathoomsText);
        $noOfBathroomOne = (isset($noOfBathroomOne[0]) && $noOfBathroomOne[0] != ''  && !empty($noOfBathroomOne[0])) ? $noOfBathroomOne[0] : 0;

        $weightageIdBathroomOne = $valuationWeightage::find($noOfBathroomOne);

        $this->noOfBathroomOne = (isset($weightageIdBathroomOne) && $weightageIdBathroomOne != '') ? $weightageIdBathroomOne['value']:0;
        $propertyInfoOne->bathrooms = (isset($this->noOfBathroomOne) && $this->noOfBathroomOne != '') ? $this->noOfBathroomOne : 0;

        // 2nd COMPARISION
        $noOfBathroomTwo = $propertyInfoTwo->getMeta(ValuationProperty::NoOfBathoomsText);
        $noOfBathroomTwo = (isset($noOfBathroomTwo[0]) && $noOfBathroomTwo[0] != '' && !empty($noOfBathroomTwo[0])) ? $noOfBathroomTwo[0] : 0;

        $weightageIdBathroomTwo = $valuationWeightage::find($noOfBathroomTwo);
        $this->noOfBathroomTwo = (isset($weightageIdBathroomTwo) && $weightageIdBathroomTwo != '') ? $weightageIdBathroomTwo['value']:0;

        $propertyInfoTwo->bathrooms = (isset($this->noOfBathroomTwo) && $this->noOfBathroomTwo != '') ? $this->noOfBathroomTwo : 0;

        // 3rd COMPARISION
        $noOfBathroomThree = $propertyInfoThree->getMeta(ValuationProperty::NoOfBathoomsText);
        $noOfBathroomThree = (isset($noOfBathroomThree[0]) && $noOfBathroomThree[0] != '' && !empty($noOfBathroomThree[0])) ? $noOfBathroomThree[0] : 0;

        $weightageIdBathroomThree = $valuationWeightage::find($noOfBathroomThree);
        $this->noOfBathroomThree = (isset($weightageIdBathroomThree) && $weightageIdBathroomThree != '') ? $weightageIdBathroomThree['value']:0;

        $propertyInfoThree->bathrooms = (isset($this->noOfBathroomThree) && $this->noOfBathroomThree != '') ? $this->noOfBathroomThree : 0;
    }
    public function finishingQuality(&$propertyBaseInfo, &$propertyInfoOne, &$propertyInfoTwo, &$propertyInfoThree)
    {
        // BASE COMPARISION

        $finishingQualityBase = $propertyBaseInfo->getMeta(ValuationProperty::FinishingQualityText);
        $finishingQualityBase = (isset($finishingQualityBase[0]) && $finishingQualityBase[0] != '' && !empty($finishingQualityBase[0])) ? $finishingQualityBase[0] : 0;

        $maintenanceBase = $propertyBaseInfo->getMeta(ValuationProperty::MaintenanceText);
        $maintenanceBase = (isset($maintenanceBase[0]) && $maintenanceBase[0] != '' && !empty($maintenanceBase[0])) ? $maintenanceBase[0] : 0;

        $valuationWeightage = new ValuationPropertyWeightage();
        $weightageIdFinishingBase = $valuationWeightage::find($finishingQualityBase);
        $weightageIdMaintenanceBase = $valuationWeightage::find($maintenanceBase);

        $this->finishingQualityBase = (isset($weightageIdFinishingBase) && $weightageIdFinishingBase != '') ? $weightageIdFinishingBase['value']:0;
        $this->finishingQualityBaseTitle = (isset($weightageIdFinishingBase) && $weightageIdFinishingBase != '') ? $weightageIdFinishingBase['title']:0;
        $this->maintenanceBase = (isset($weightageIdMaintenanceBase) && $weightageIdMaintenanceBase != '') ? $weightageIdMaintenanceBase['value']:0;
        $this->maintenanceBaseTitle = (isset($weightageIdMaintenanceBase) && $weightageIdMaintenanceBase != '') ? $weightageIdMaintenanceBase['title']:0;
        

        $propertyBaseInfo->finishingQuality = (isset($this->finishingQualityBase) && $this->finishingQualityBase != '') ? $this->finishingQualityBase : 0;
        $propertyBaseInfo->finishingQualityTitle = (isset($this->finishingQualityBaseTitle) && $this->finishingQualityBaseTitle != '') ? $this->finishingQualityBaseTitle : "";
        $propertyBaseInfo->maintenance = (isset($this->maintenanceBase) && $this->maintenanceBase != '') ? $this->maintenanceBase : 0;
        $propertyBaseInfo->maintenanceTitle = (isset($this->maintenanceBaseTitle) && $this->maintenanceBaseTitle != '') ? $this->maintenanceBaseTitle : "";

        // 1st COMPARISION

        $finishingQualityOne = $propertyInfoOne->getMeta(ValuationProperty::FinishingQualityText);
        $finishingQualityOne = (isset($finishingQualityOne[0]) && $finishingQualityOne[0] != ''  && !empty($finishingQualityOne[0])) ? $finishingQualityOne[0] : 0;

        $maintenanceOne = $propertyInfoOne->getMeta(ValuationProperty::MaintenanceText);
        $maintenanceOne = (isset($maintenanceOne[0]) && $maintenanceOne[0] != ''  && !empty($maintenanceOne[0])) ? $maintenanceOne[0] : 0;

        $weightageIdFinishingOne = $valuationWeightage::find($finishingQualityOne);
        $weightageIdMaintenanceOne = $valuationWeightage::find($maintenanceOne);

        $this->finishingQualityOne = (isset($weightageIdFinishingOne) && $weightageIdFinishingOne != '') ? $weightageIdFinishingOne['value']:0;
        $this->finishingQualityOneTitle = (isset($weightageIdFinishingOne) && $weightageIdFinishingOne != '') ? $weightageIdFinishingOne['title']:0;
        $this->maintenanceOne = (isset($weightageIdMaintenanceOne) && $weightageIdMaintenanceOne != '') ? $weightageIdMaintenanceOne['value']:0;
        $this->maintenanceOneTitle = (isset($weightageIdMaintenanceOne) && $weightageIdMaintenanceOne != '') ? $weightageIdMaintenanceOne['title']:0;
        

        $propertyInfoOne->finishingQuality = (isset($this->finishingQualityOne) && $this->finishingQualityOne != '') ? $this->finishingQualityOne : 0;
        $propertyInfoOne->finishingQualityOneTitle = (isset($this->finishingQualityOneTitle) && $this->finishingQualityOneTitle != '') ? $this->finishingQualityOneTitle : 0;
        $propertyInfoOne->maintenance = (isset($this->maintenanceOne) && $this->maintenanceOne != '') ? $this->maintenanceOne : 0;
        $propertyInfoOne->maintenanceOneTitle = (isset($this->maintenanceOneTitle) && $this->maintenanceOneTitle != '') ? $this->maintenanceOneTitle : 0;

        // 2nd COMPARISION

        $finishingQualityTwo = $propertyInfoTwo->getMeta(ValuationProperty::FinishingQualityText);
        $finishingQualityTwo = (isset($finishingQualityTwo[0]) && $finishingQualityTwo[0] != '' && !empty($finishingQualityTwo[0])) ? $finishingQualityTwo[0] : 0;

        $maintenanceTwo = $propertyInfoTwo->getMeta(ValuationProperty::MaintenanceText);
        $maintenanceTwo = (isset($maintenanceTwo[0]) && $maintenanceTwo[0] != '' && !empty($maintenanceTwo[0])) ? $maintenanceTwo[0] : 0;

        $weightageIdFinishingTwo = $valuationWeightage::find($finishingQualityTwo);
        $weightageIdMaintenanceTwo = $valuationWeightage::find($maintenanceTwo);

        $this->finishingQualityTwo = (isset($weightageIdFinishingTwo) && $weightageIdFinishingTwo != '') ? $weightageIdFinishingTwo['value']:0;
        $this->finishingQualityTwoTitle = (isset($weightageIdFinishingTwo) && $weightageIdFinishingTwo != '') ? $weightageIdFinishingTwo['title']:0;
        $this->maintenanceTwo = (isset($weightageIdMaintenanceTwo) && $weightageIdMaintenanceTwo != '') ? $weightageIdMaintenanceTwo['value']:0;
        $this->maintenanceTwoTitle = (isset($weightageIdMaintenanceTwo) && $weightageIdMaintenanceTwo != '') ? $weightageIdMaintenanceTwo['title']:0;
        

        $propertyInfoTwo->finishingQuality = (isset($this->finishingQualityTwo) && $this->finishingQualityTwo != '') ? $this->finishingQualityTwo : 0;
        $propertyInfoOne->finishingQualityTwoTitle = (isset($this->finishingQualityTwoTitle) && $this->finishingQualityTwoTitle != '') ? $this->finishingQualityTwoTitle : 0;
        $propertyInfoTwo->maintenance = (isset($this->maintenanceTwo) && $this->maintenanceTwo != '') ? $this->maintenanceTwo : 0;
        $propertyInfoOne->maintenanceTwoTitle = (isset($this->maintenanceTwoTitle) && $this->maintenanceTwoTitle != '') ? $this->maintenanceTwoTitle : 0;

        // 3rd COMPARISION

        $finishingQualityThree = $propertyInfoThree->getMeta(ValuationProperty::FinishingQualityText);
        $finishingQualityThree = (isset($finishingQualityThree[0]) && $finishingQualityThree[0] != '' && !empty($finishingQualityThree[0])) ? $finishingQualityThree[0] : 0;

        $maintenanceThree = $propertyInfoThree->getMeta(ValuationProperty::MaintenanceText);
        $maintenanceThree = (isset($maintenanceThree[0]) && $maintenanceThree[0] != '' && !empty($maintenanceThree[0])) ? $maintenanceThree[0] : 0;

        $weightageIdFinishingThree = $valuationWeightage::find($finishingQualityThree);
        $weightageIdMaintenanceThree = $valuationWeightage::find($maintenanceThree);

        $this->finishingQualityThree = (isset($weightageIdFinishingThree) && $weightageIdFinishingThree != '') ? $weightageIdFinishingThree['value']:0;
        $this->finishingQualityThreeTitle = (isset($weightageIdFinishingThree) && $weightageIdFinishingThree != '') ? $weightageIdFinishingThree['title']:0;
        $this->maintenanceThree = (isset($weightageIdMaintenanceThree) && $weightageIdMaintenanceThree != '') ? $weightageIdMaintenanceThree['value']:0;
        $this->maintenanceThreeTitle = (isset($weightageIdMaintenanceThree) && $weightageIdMaintenanceThree != '') ? $weightageIdMaintenanceThree['title']:0;
        

        $propertyInfoThree->finishingQuality = (isset($this->finishingQualityThree) && $this->finishingQualityThree != '') ? $this->finishingQualityThree : 0;
        $propertyInfoThree->finishingQualityThreeTitle = (isset($this->finishingQualityThreeTitle) && $this->finishingQualityThreeTitle != '') ? $this->finishingQualityThreeTitle : 0;
        $propertyInfoThree->maintenance = (isset($this->maintenanceThree) && $this->maintenanceThree != '') ? $this->maintenanceThree : 0;
        $propertyInfoThree->maintenanceThreeTitle = (isset($this->maintenanceThreeTitle) && $this->maintenanceThreeTitle != '') ? $this->maintenanceThreeTitle : 0;
    }
    public function buildingAmenities(&$propertyBaseInfo, &$propertyInfoOne, &$propertyInfoTwo, &$propertyInfoThree)
    {
        // BASE COMPARISION

        $amenitiesBase = $propertyBaseInfo->getMeta(ValuationProperty::AmenitiesText);
        $amenitiesBase = (isset($amenitiesBase[0]) && $amenitiesBase[0] != '' && !empty($amenitiesBase[0])) ? $amenitiesBase[0] : 0;

        $valuationWeightage = new ValuationPropertyWeightage();
        $weightageIdAmenitiesBase = $valuationWeightage::find($amenitiesBase);

        $this->amenitiesBase = (isset($weightageIdAmenitiesBase) && $weightageIdAmenitiesBase != '') ? $weightageIdAmenitiesBase['value']:0;
        $this->amenitiesBaseTitle = (isset($weightageIdAmenitiesBase) && $weightageIdAmenitiesBase != '') ? $weightageIdAmenitiesBase['title']:0;
        

        $propertyBaseInfo->amenities = (isset($this->amenitiesBase) && $this->amenitiesBase != '') ? $this->amenitiesBase : 0;
        $propertyBaseInfo->amenitiesTitle = (isset($this->amenitiesBaseTitle) && $this->amenitiesBaseTitle != '') ? $this->amenitiesBaseTitle : 0;

        // 1st COMPARISION

        $amenitiesOne = $propertyInfoOne->getMeta(ValuationProperty::AmenitiesText);
        $amenitiesOne = (isset($amenitiesOne[0]) && $amenitiesOne[0] != ''  && !empty($amenitiesOne[0])) ? $amenitiesOne[0] : 0;

        $weightageIdAmenitiesOne = $valuationWeightage::find($amenitiesOne);

        $this->amenitiesOne = (isset($weightageIdAmenitiesOne) && $weightageIdAmenitiesOne != '') ? $weightageIdAmenitiesOne['value']:0;
        $this->amenitiesOneTitle = (isset($weightageIdAmenitiesOne) && $weightageIdAmenitiesOne != '') ? $weightageIdAmenitiesOne['title']:0;
        

        $propertyInfoOne->amenities = (isset($this->amenitiesOne) && $this->amenitiesOne != '') ? $this->amenitiesOne : 0;
        $propertyInfoOne->amenitiesOneTitle = (isset($this->amenitiesOneTitle) && $this->amenitiesOneTitle != '') ? $this->amenitiesOneTitle : 0;

        // 2nd COMPARISION

        $amenitiesTwo = $propertyInfoTwo->getMeta(ValuationProperty::AmenitiesText);
        $amenitiesTwo = (isset($amenitiesTwo[0]) && $amenitiesTwo[0] != '' && !empty($amenitiesTwo[0])) ? $amenitiesTwo[0] : 0;

        $weightageIdAmenitiesTwo = $valuationWeightage::find($amenitiesTwo);

        $this->amenitiesTwo = (isset($weightageIdAmenitiesTwo) && $weightageIdAmenitiesTwo != '') ? $weightageIdAmenitiesTwo['value']:0;
        $this->amenitiesTwoTitle = (isset($weightageIdAmenitiesTwo) && $weightageIdAmenitiesTwo != '') ? $weightageIdAmenitiesTwo['title']:0;
        
        $propertyInfoTwo->amenities = (isset($this->amenitiesTwo) && $this->amenitiesTwo != '') ? $this->amenitiesTwo : 0;
        $propertyInfoTwo->amenitiesTwoTitle = (isset($this->amenitiesTwoTitle) && $this->amenitiesTwoTitle != '') ? $this->amenitiesTwoTitle : 0;

        // 3rd COMPARISION

        $amenitiesThree = $propertyInfoThree->getMeta(ValuationProperty::AmenitiesText);
        $amenitiesThree = (isset($amenitiesThree[0]) && $amenitiesThree[0] != '' && !empty($amenitiesThree[0])) ? $amenitiesThree[0] : 0;

        $weightageIdAmenitiesThree = $valuationWeightage::find($amenitiesThree);

        $this->amenitiesThree = (isset($weightageIdAmenitiesThree) && $weightageIdAmenitiesThree != '') ? $weightageIdAmenitiesThree['value']:0;
        $this->amenitiesThreeTitle = (isset($weightageIdAmenitiesThree) && $weightageIdAmenitiesThree != '') ? $weightageIdAmenitiesThree['title']:0;
        
        $propertyInfoThree->amenities = (isset($this->amenitiesThree) && $this->amenitiesThree != '') ? $this->amenitiesThree : 0;
        $propertyInfoThree->amenitiesThreeTitle = (isset($this->amenitiesThreeTitle) && $this->amenitiesThreeTitle != '') ? $this->amenitiesThreeTitle : 0;
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
