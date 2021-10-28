<?php

namespace Modules\RestAPI\Http\Controllers;

use App\Http\Controllers\Classes\TaskLinker;
use Froiden\RestAPI\ApiResponse;
use Modules\RestAPI\Entities\SubTask;
use Modules\RestAPI\Entities\Task;
use Modules\RestAPI\Http\Requests\TaskFormFields\IndexRequest;
use Modules\RestAPI\Http\Requests\TaskFormFields\CreateRequest;
use Modules\RestAPI\Http\Requests\TaskFormFields\ShowRequest;
use Modules\RestAPI\Http\Requests\TaskFormFields\UpdateRequest;
use Modules\RestAPI\Http\Requests\TaskFormFields\DeleteRequest;
use Illuminate\Http\Request;
use App\ValuationInspection;
use App\ValuationInspectionField;
use Froiden\RestAPI\Exceptions\ApiException;



class TaskFormFieldsController extends ApiBaseController
{
    protected $model =  SubTask::class;

    protected $indexRequest = IndexRequest::class;
    protected $storeRequest = CreateRequest::class;
    protected $updateRequest = UpdateRequest::class;
    protected $showRequest = ShowRequest::class;
    protected $deleteRequest = DeleteRequest::class;

    protected function modifyShow($query)
    {
        return $query->where('task_id', request()->route('task_id'));
    }

    public function storing(SubTask $subTask)
    {
        $subTask->task_id = request()->route('task_id');
        return $subTask;
    }
    protected function modifyUpdate($query)
    {
        return $query->where('task_id', request()->route('task_id'));
    }

   /* protected function modifyIndex($query)
    {
        //$subTaskData = $query->where('task_id', request()->route('task_id'))->get();
        $data = [
            'propertyData'=>'test',

        ];
        //$meta = array();
        return ApiResponse::make(null, $data);

        $dummyData = $subTaskData;
        echo "<pre>"; print_r($dummyData); exit;
        //return $query->where('task_id', request()->route('task_id'));
    }*/

    public function index($taskId = 0)
    {
        $taskId = request()->route('task_id');
        $data = $this->getSubTaskByTaskId($taskId);

        $meta = parent::getMetaData(true);
        return ApiResponse::make(null, $data,$meta);
    }

    public function getSubTaskByTaskId($taskId)
    {
        $modelSubTask = new SubTask();
        $subTasks = $modelSubTask->where('task_id', $taskId)->get();

        $taskLinker = new TaskLinker();
        $returnAraay = $taskLinker->index($subTasks,$taskId);
        $data = [
            'taskFormField'=>$returnAraay,
        ];
        return $data;
    }

    public function saveSubTask(Request $request)
    {
        $content = $request->getContent();
        $requestData = json_decode($content, true);

        if(empty($requestData)){
            $apiException = new ApiException('Request is empty',  null, -1, 404);
            return ApiResponse::exception($apiException);
        }

        $taskId = request()->route('task_id');
        $formFieldsData = $this->getSubTaskByTaskId($taskId);

        $formFields = isset($formFieldsData['taskFormField'])?$formFieldsData['taskFormField']:array();

        if(empty($formFieldsData['taskFormField'])){
            $apiException = new ApiException('Data not found',  null, -1, 404);
            return ApiResponse::exception($apiException);
        }

        //get projectId
        $taskModel = new Task();
        $taskData = $taskModel->where('id', $taskId)->first();
        $projectData = isset($taskData->project)?$taskData->project: new \stdClass();
        $projectId = isset($projectData->id)?$projectData->id:0;

        //save data in inspection
        $valuationInspectionModel = new ValuationInspection();
        $valuationInspectionModel->project_id = $projectId;
        $valuationInspectionModel->valuator_id = 1; // will change later
        $valuationInspectionModel->status = 'Active';
        $valuationInspectionModel->save();
        $valuationInspectionId = $valuationInspectionModel->id?$valuationInspectionModel->id:0;
        if($valuationInspectionId > 0){

            //save inspection Field data
            foreach ($formFields as $key => $formField) {

                $fieldId = isset($formField['id'])?$formField['id']:'-';

                foreach ($requestData as $requestDataIn){

                    $requestFieldId = $requestDataIn['id'];
                    $requestFieldValue = $requestDataIn['value'];

                    if($fieldId == $requestFieldId){
                        $formFields[$key]['fieldProperties']['value'] = $requestFieldValue;
                    }

                }

                $fieldTitle = isset($formField['title'])?$formField['title']:'-';
                $fieldValue = isset($formField['fieldProperties']['value'])?$formField['fieldProperties']['value']:'-';

                $valuationInspectionFieldsModel = new ValuationInspectionField();
                $valuationInspectionFieldsModel->valuation_inspection_id = $valuationInspectionId;
                $valuationInspectionFieldsModel->field_title = $fieldTitle;
                $valuationInspectionFieldsModel->field_value = $fieldValue;
                $valuationInspectionFieldsModel->field_data = json_encode($formField);
                $valuationInspectionFieldsModel->save();
            }

            //save data in fields
            $subTasks = array();
            foreach ($formFields as $formField) {

                $filedIdentifier = $formField['fieldProperties']['link_field_with']['functionIdentifier'];
                $updatedFormFieldData = $formField;
                $subTasks[] = array('formFieldKey' => $filedIdentifier, 'updatedFormFieldData' => $updatedFormFieldData);
            }

            $taskLinker = new TaskLinker();
            $taskLinker->index($subTasks, $taskId);

            return ApiResponse::make('Data has been submitted successfully');
        }

        $apiException = new ApiException('Date not save',  null, -1, 400);
        return ApiResponse::exception($apiException);
    }
}
