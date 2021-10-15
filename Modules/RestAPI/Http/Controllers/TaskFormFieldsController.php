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

    public function index()
    {
        $modelSubTask = new SubTask();
        $taskID = request()->route('task_id');
        $subTasks = $modelSubTask->where('task_id', $taskID)->get();

        $taskLinker = new TaskLinker();
        $returnAraay = $taskLinker->index($subTasks,$taskID);
        $data = [
            'taskFormField'=>$returnAraay,

        ];
       /* $subTaskData = array();
        $subTaskData[0]['id'] = '1';
        $subTaskData[0]['taskId'] = '2';
        $subTaskData[0]['title'] = 'Floor number';
        $subTaskData[0]['fieldType'] = 'text';
        $subTaskData[0]['isRequired'] = 'true';
        $subTaskData[0]['fieldProperties'] = array();
        $subTaskData[0]['fieldProperties']['value'] = '20';
        $subTaskData[0]['fieldProperties']['link_field_with'] = array('table'=>'db_table',  'field'=>'db_field' );
        $subTaskData[0]['fieldProperties']['option'] = array();
        $subTaskData[0]['dueDate'] = '2021-06-28T00:00:00+00:00';
        $subTaskData[0]['startDate'] = null;
        $subTaskData[0]['status'] = 'incomplete';

        $subTaskData[1]['id'] = '1';
        $subTaskData[1]['taskId'] = '2';
        $subTaskData[1]['title'] = 'Description';
        $subTaskData[1]['fieldType'] = 'textArea';
        $subTaskData[1]['isRequired'] = 'false';
        $subTaskData[1]['fieldProperties'] = array();
        $subTaskData[1]['fieldProperties']['value'] = '';
        $subTaskData[1]['fieldProperties']['linkFieldWith'] = array('table'=>'db_table',  'field'=>'db_field' );
        $subTaskData[1]['fieldProperties']['option'] = array();
        $subTaskData[1]['dueDate'] = '2021-06-28T00:00:00+00:00';
        $subTaskData[1]['startDate'] = null;
        $subTaskData[1]['status'] = 'incomplete';

        $selectOptionArray = array();
        $selectOptionArray[0]['title'] = 'Option One';
        $selectOptionArray[0]['value'] = 'option1';

        $selectOptionArray[1]['title'] = 'Option two';
        $selectOptionArray[1]['value'] = 'option2';

        $selectOptionArray[2]['title'] = 'Option three';
        $selectOptionArray[2]['value'] = 'option3';

        $subTaskData[2]['id'] = '1';
        $subTaskData[2]['taskId'] = '2';
        $subTaskData[2]['title'] = 'Select Option';
        $subTaskData[2]['fieldType'] = 'select';
        $subTaskData[2]['isRequired'] = 'true';
        $subTaskData[2]['fieldProperties'] = array();
        $subTaskData[2]['fieldProperties']['value'] = 'option2';
        $subTaskData[2]['fieldProperties']['linkFieldWith'] = array('table'=>'db_table',  'field'=>'db_field' );
        $subTaskData[2]['fieldProperties']['option'] = $selectOptionArray;
        $subTaskData[2]['dueDate'] = '2021-06-28T00:00:00+00:00';
        $subTaskData[2]['startDate'] = null;
        $subTaskData[2]['status'] = 'incomplete';

        $checkChildArray = array();
        $checkChildArray[0]['title'] = 'Option One';
        $checkChildArray[0]['value'] = 'option1';
        $checkChildArray[0]['isChecked'] = 'false';

        $checkChildArray[1]['title'] = 'Option two';
        $checkChildArray[1]['value'] = 'option2';
        $checkChildArray[1]['isChecked'] = 'true';

        $checkChildArray[2]['title'] = 'Option three';
        $checkChildArray[2]['value'] = 'option3';
        $checkChildArray[2]['isChecked'] = 'true';

        $subTaskData[3]['id'] = '1';
        $subTaskData[3]['taskId'] = '2';
        $subTaskData[3]['title'] = 'Check following';
        $subTaskData[3]['fieldType'] = 'checkBox';
        $subTaskData[3]['isRequired'] = 'true';
        $subTaskData[3]['fieldProperties'] = array();
        $subTaskData[3]['fieldProperties']['value'] = '';
        $subTaskData[3]['fieldProperties']['linkFieldWith'] = array('table'=>'db_table',  'field'=>'db_field' );
        $subTaskData[3]['fieldProperties']['option'] = array();
        $subTaskData[3]['fieldProperties']['child'] = $checkChildArray;
        $subTaskData[3]['dueDate'] = '2021-06-28T00:00:00+00:00';
        $subTaskData[3]['startDate'] = null;
        $subTaskData[3]['status'] = 'incomplete';

        $radioChildArray = array();
        $radioChildArray[0]['title'] = 'Option One';
        $radioChildArray[0]['value'] = 'option1';

        $radioChildArray[1]['title'] = 'Option two';
        $radioChildArray[1]['value'] = 'option2';


        $radioChildArray[2]['title'] = 'Option three';
        $radioChildArray[2]['value'] = 'option3';

        $subTaskData[4]['id'] = '1';
        $subTaskData[4]['taskId'] = '2';
        $subTaskData[4]['title'] = 'Select one';
        $subTaskData[4]['fieldType'] = 'radioButton';
        $subTaskData[4]['isRequired'] = 'true';
        $subTaskData[4]['fieldProperties'] = array();
        $subTaskData[4]['fieldProperties']['value'] = 'option3';
        $subTaskData[4]['fieldProperties']['linkFieldWith'] = array('table'=>'db_table',  'field'=>'db_field' );
        $subTaskData[4]['fieldProperties']['option'] = array();
        $subTaskData[4]['fieldProperties']['child'] = $radioChildArray;
        $subTaskData[4]['dueDate'] = '2021-06-28T00:00:00+00:00';
        $subTaskData[4]['startDate'] = null;
        $subTaskData[4]['status'] = 'incomplete';
*/

       // echo "<pre>"; print_r($subTaskData); exit;
        //$meta = array();

        $meta = parent::getMetaData(true);
        return ApiResponse::make(null, $data,$meta);
        echo "<pre>"; print_r("var"); exit;
    }

    public function saveSubTask(Request $request)
    {

        $taskID = request()->route('task_id');
        $content = $request->getContent();
        $formFieldsData = json_decode($content, true);

        $formFields = isset($formFieldsData['data']['taskFormField'])?$formFieldsData['data']['taskFormField']:array();

        if(empty($formFieldsData['data']['taskFormField'])){
            return ApiResponse::make('Data not found');
        }

        //get projectId
        $taskId = isset($formFields['0']['taskId'])?$formFields['0']['taskId']:0;
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
            foreach ($formFields as $formField) {
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
            $taskLinker->index($subTasks, $taskID);

            return ApiResponse::make('Data has been submitted successfully');
        }

        return ApiResponse::make('Date not save');
    }
}
