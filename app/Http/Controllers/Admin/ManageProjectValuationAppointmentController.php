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

class ManageProjectValuationAppointmentController extends AdminBaseController
{

    private $dataRoute = 'admin.valuation-appointment.data';

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
//        echo "<pre>"; print_r("var"); exit;

    }

    public function data()
    {

        echo "<pre>"; print_r("var data"); exit;
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

}
