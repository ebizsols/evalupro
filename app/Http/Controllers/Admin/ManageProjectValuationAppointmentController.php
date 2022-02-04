<?php

namespace App\Http\Controllers\Admin;

use App\EmployeeDetails;
use App\EmployeeTeam;
use App\Helper\Reply;
use App\Http\Requests\ProjectMembers\SaveGroupMembers;
use App\Http\Requests\ProjectMembers\StoreProjectMembers;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\NewProjectMember;
use App\Project;
use App\ProjectMember;
use App\Team;
use App\User;
use App\ProjectAppointment;
use Illuminate\Http\Request;
use Modules\Valuation\Entities\ValuationProperty;

class ManageProjectValuationAppointmentController extends AdminBaseController
{

    private $dataRoute = 'admin.valuation-appointment.data';
    private $showPageRoute = 'admin.valuation-appointment.show';

    public function __construct()
    {
        parent::__construct();
        $this->pageIcon = 'icon-layers';
        $this->pageTitle = 'app.menu.projects';
    }

    public function __customConstruct(&$data)
    {
        //assign routes for views
        $data['dataRoute'] = $this->dataRoute;
        $data['projectId'] = isset(company()->id)?company()->id:0;
    }



    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
  
    public function show($id)
    {
        $this->__customConstruct($this->data);
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

        return view('admin.projects.ValuationAppointment.show', $this->data);
    }




    public function store(Request $request)
    {
        $this->__customConstruct($this->data);

        $store=new ProjectAppointment();

        $store->project_id=isset($request->projectId) ? $request->projectId : 0;
        $store->appointment_date_time=isset($request->appointment_date_time) ? $request->appointment_date_time : 0 ;
        $store->status=isset($request->status) ? $request->status : 'Active' ;
        $store->note=isset($request->description) ? $request->description : '';
        // isNotification Checkbox
        $store->is_notification_send = $request->has('is_notification_send') && $request->is_notification_send == 'true' ? 1 : 0;

        $store->save();
        $projectAppointment = new ProjectAppointment();

        //Inactive all other Appointment
        $projectAppointment->updateStatusActive($store->project_id, $store->id);

        //Update appointment in project
        $project = Project::find( $store->project_id);
        $metaData['appointment_day']=$request->appointment_date_time;
        $project->setMeta($metaData);

        return Reply::redirect(route($this->showPageRoute, $request->projectId) , __('Save Success'));
    }

    public function updateStatus(Request $request)
    {
        $this->__customConstruct($this->data);

        $status = $request->status;
        $appointmentId = $request->appointmentId;
        $projectAppointmentData = ProjectAppointment::find( $appointmentId);
        if(empty($projectAppointmentData)){
            return Reply::error('Date Not Found');
        }
        $projectId = $projectAppointmentData->project_id;
          // isNotification Checkbox
          $projectAppointmentData->is_notification_send = $request->has('is_notification_send') && $request->is_notification_send == 'true' ? 1 : 0;

        //echo "<pre>"; print_r($projectAppointmentData); exit;
        if($status == 'Active'){
            //Inactive all other Appointment
            $projectAppointment = new ProjectAppointment();
            $projectAppointment->updateStatusActive($projectId, $appointmentId);

            //Update appointment in project
            $project = Project::find( $projectId);
            $metaData['appointment_day']=$request->appointment_date_time;
            $project->setMeta($metaData);
 
        }
        else{
            $projectAppointmentData->status  =  $status;
            $projectAppointmentData->save();
        }

        return Reply::redirect(route($this->showPageRoute, $projectId) , __('Save Success'));
        
    }
                    
    public function data()
    {
        $projectAppointments = new ProjectAppointment;        
        $appointments = $projectAppointments->get();
        return DataTables::of($appointments)
            ->addIndexColumn()
            ->editColumn(
                'dateTime',
                function ($row) {
                    return $row->appointment_date_time;
                }
            )
            ->addColumn('action', function ($row) {
                $id = $row->id;
                $status = $row->status;
                ob_start();
                ?>
                <select class="form-control" name="status" onchange="return changeAppointmentStatus('<?php echo $id?>', this)">
                    <option value="Active" <?php echo ($status == 'Active')?'selected':''?> > Active</option>
                    <option value="Inactive"  <?php echo ($status == 'Inactive')?'selected':''?> > Inactive</option>
                    <option value="Cancel"  <?php echo ($status == 'Cancel')?'selected':''?> >Cancel</option>
                </select>
                <?php
                $action = ob_get_clean();
                return $action;
            })
            ->rawColumns(array('dateTime','status', 'action'))
            ->make(true);

            
    }

}
