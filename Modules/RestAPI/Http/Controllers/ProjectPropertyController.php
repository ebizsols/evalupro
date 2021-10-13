<?php

namespace Modules\RestAPI\Http\Controllers;

use App\Helper\Files;
use Froiden\RestAPI\ApiResponse;
use Froiden\RestAPI\Exceptions\ApiException;
use Modules\RestAPI\Entities\Project;
use Illuminate\Http\Request;
use Modules\RestAPI\Http\Requests\File\FileStoreRequest;
use Carbon\Carbon;

class ProjectPropertyController extends ApiBaseController
{
    protected $model = Project::class;


    public function saveImage(FileStoreRequest $request)
    {

        $projectId = $request->projectId;
        $projectData =  Project::find($projectId);
        $propertyId = isset($projectData->property_id)?$projectData->property_id:0;
        $propertyId = 2;
        if($propertyId <= 0){
            throw new ApiException('Property not assign to project', null, 422, 422, 2001);
        }

        $propertyImage = $request->propertyImage;

        $currentDate = Carbon::now();
        $currentDateFormat =  $currentDate->format('Y-m-d');

        $folder = 'properties/'.$propertyId.'/'.$currentDateFormat;

        try {
            $newName = Files::uploadLocalOrS3($propertyImage, $folder);
        } catch (\Exception $e) {
            ApiResponse::make(null, [
                'name' => $e,
            ]);
        }

        return ApiResponse::make('Image uploaded successfully', [
            'name' => $newName,
            'url' => asset_url($folder . '/' . $newName),
        ]);
    }

}
