<?php

namespace Modules\RestAPI\Http\Controllers;

use Froiden\RestAPI\ApiResponse;
use Modules\RestAPI\Entities\Project;
use Modules\RestAPI\Entities\ValuationProperty;
use Modules\RestAPI\Http\Requests\Appointments\IndexRequest;
use Modules\RestAPI\Http\Requests\Appointments\CreateRequest;
use Modules\RestAPI\Http\Requests\Appointments\UpdateRequest;
use Modules\RestAPI\Http\Requests\Appointments\ShowRequest;
use Modules\RestAPI\Http\Requests\Appointments\DeleteRequest;
use Modules\Valuation\Entities\ValuationGeneralSetting;
use App\ProjectAppointment;
use Carbon\Carbon;

class ImageController extends ApiBaseController
{
    protected $model = Project::class;

    protected $indexRequest = IndexRequest::class;
    protected $storeRequest = CreateRequest::class;
    protected $updateRequest = UpdateRequest::class;
    protected $showRequest = ShowRequest::class;
    protected $deleteRequest = DeleteRequest::class;

    public function APIimage(){
        $data= ValuationGeneralSetting::all();
        $user = api_user();
        $company_id= $user->company_id;
        $getImageData = ValuationGeneralSetting::where('company_id', '=', $company_id)->where('meta_key', '=', 'appImage')->first();

        $appImage = (isset($getImageData['meta_value'])?$getImageData['meta_value']:'null');
        $appPathImage = asset('img/'.$appImage);
        
        
        return ApiResponse::make(null, ['appImage'=> $appPathImage]);

    }
    
   
}














