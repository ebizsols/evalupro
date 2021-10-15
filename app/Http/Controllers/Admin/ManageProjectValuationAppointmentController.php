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
        if(isset($request->id) && $request->id>0)
        {
            $store = ProjectAppointment::find($request->id);
        }
        else
        {
            $store=new ProjectAppointment();
        }

        $store->project_id=isset($this->data['projectId']) ? $this->data['projectId'] : 0;
        $store->appointment_day=isset($request->appointment_day) ? $request->appointment_day : 0 ;
        $store->status=isset($request->status) ? $request->status : 'Inactive' ;
        $store->note=isset($request->description) ? $request->description : '';
        $store->save();
        return Reply::redirect(route($this->showPageRoute, $request->projectId) , __('Save Success'));
    }

    public function updateStatus(Request $request)
    {
        $this->__customConstruct($this->data);

        $status = $request->status;
        $ProjectAppointmentData = ProjectAppointment::find( $request->appointmentId);
        if(emptyt($ProjectAppointmentData)){
            return __('messages.noRecordFound');
        }
        $ProjectAppointment->status  =  $status;
        $ProjectAppointment->save();
        $projectId = $update->project_id;    
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
                    return $row->appointment_day;
                }
            )
            ->editColumn(
                'status',
                function ($row) {
                    return $row->status;
                }
            )
            ->addColumn('action', function ($row) {
                    $action = '
                        <select class="form-control" name="status" onchange="return changeAppointmentStatus('. $row->id.', this)">
                            <option value="active"> Active</option>
                            <option value="inactive"> Inactive</option>
                            <option value="cancel">Cancel</option>
                        </select>
                    ' ;
                return $action;
            })
            ->rawColumns(array('dateTime','status', 'action'))
            ->make(true);

            
    }

}
