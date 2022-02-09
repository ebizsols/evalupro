<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Classes\TaskLinker;
use App\Http\Requests\TemplateTasks\SubTaskStoreRequest;
use App\Http\Requests\TemplateTasks\StoreTask;
use App\ProjectTemplate;
use App\ProjectTemplateSubTask;
use App\ProjectTemplateTask;
use App\ProjectTemplateTaskUser;
use App\TaskCategory;
use App\Traits\ProjectProgress;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ProjectTemplateSubTaskController extends AdminBaseController
{

    use ProjectProgress;

    public function __construct() {
        parent::__construct();
        $this->pageIcon = 'icon-layers';
        $this->pageTitle = 'app.menu.projectTemplateSubTask';
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
    public function create(Request $request)
    {
        $this->taskID = $request->task_id;
        $this->subTaskFormElements = TaskLinker::$subTaskFormElement;

        return view('admin.project-template.sub-task.create-edit', $this->data);
    }

    /**
     * @param StoreTask $request
     * @return array
     */
    public function store(SubTaskStoreRequest $request)
    {
        $subTask = new ProjectTemplateSubTask();
        $subTask->title = $request->name[0];
        $subTask->project_template_task_id = $request->taskID;
        $subTask->formFieldKey = $request->formFieldKey;
        $subTask->due_date = Carbon::createFromFormat($this->global->date_format, $request->due_date)->format('Y-m-d');
        $subTask->save();
        // dd($request->taskID,$request->due_date,$request->name[0],$request->formFieldKey);
        // $formFieldKey = $request->formFieldKey;
        // $dueDate =
        // Carbon::createFromFormat($this->global->date_format, $request->due_date)->toDateString();
        // // dd($dueDate);
        // foreach ($request->name as $value) {
        //     if ($value){
        //         ProjectTemplateSubTask::firstOrCreate([
        //             'title' => $value,
        //             'project_template_task_id' => $request->taskID,
        //             'due_date' => $dueDate,
        //             'formFieldKey' => $formFieldKey,
        //         ]);
        //     }
        // }
        return Reply::success(__('messages.templateSubTaskCreatedSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function taskDetail($id)
    {
//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->subTask = ProjectTemplateSubTask::findOrFail($id);
        $this->subTaskID = $id;
        $this->taskID = $this->subTask->project_template_task_id;
        $this->title = $this->subTask->title;
        $dueDate = Carbon::parse($this->subTask->due_date)->format('d-m-Y');
        $this->dueDate = $dueDate;
        $this->subTaskFormFieldKey = $this->subTask->formFieldKey;
        $this->subTaskFormElements = TaskLinker::$subTaskFormElement;
        // dd("Here in Edit",$this->taskID,$this->title,$this->dueDate,$this->subTaskFormFieldKey);
        return view('admin.project-template.sub-task.edit', $this->data);
    }

    /**
     * @param StoreTask $request
     * @param $id
     * @return array
     */
    public function update(SubTaskStoreRequest $request, $id)
    {
        $subTask = ProjectTemplateSubTask::findOrFail($id);
        $taskID = $request->taskID;
        $subTask->project_template_task_id = $taskID;
        $subTask->title = $request->name[0];
        $subTask->formFieldKey = $request->formFieldKey;
        $subTask->due_date = Carbon::parse($request->due_date)->toDateTimeString();
        $subTask->save();

        // return Reply::redirect(route('admin.project-template-task.show'), __('Updated Success'));

        return Reply::success(__('messages.templateTaskUpdatedSuccessfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete task
        ProjectTemplateSubTask::destroy($id);

        return Reply::success(__('messages.templateSubTaskDeletedSuccessfully'));
    }

}
