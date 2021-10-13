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

class AppointmentController extends ApiBaseController
{
    protected $model = Project::class;

    protected $indexRequest = IndexRequest::class;
    protected $storeRequest = CreateRequest::class;
    protected $updateRequest = UpdateRequest::class;
    protected $showRequest = ShowRequest::class;
    protected $deleteRequest = DeleteRequest::class;

    public function modifyIndex($query)
    {
        $query->visibility();
        if (request()->has('filters') && str_contains(request()->filters, 'project_member_id')) {
            $query->join(
                \DB::raw(
                    '(SELECT `project_id` as `pr_project_id`, 
                    `user_id` as `project_member_id` FROM `project_members`) as `pr`'
                ),
                'pr.pr_project_id',
                '=',
                'projects.id'
            )->groupBy('projects.id');
        }
        return $query;
    }

    public function updating(Project $project)
    {
        if (request()->has('without_deadline')) {
            $project->deadline = null;
        }
        return $project;
    }

    public function members($projectId)
    {
        $project =  Project::find($projectId);
        if (request()->get('members')) {
            $ids = array_column(request()->get('members'), 'id');
            $project->members_many()->sync($ids);
        }

        return ApiResponse::make('Project member added successfully');
    }

    public function memberRemove($projectId, $id)
    {
        $project =  Project::find($projectId);
        $project->members_many()->detach($id);

        return ApiResponse::make('Member removed');
    }

    public function me()
    {
        app()->make($this->indexRequest);

        $query = $this->parseRequest()
            ->addIncludes()
            ->addFilters()
            ->addOrdering()
            ->addPaging()
            ->getQuery();

        $user = api_user();

       $query->whereIn('projects.id', function ($query) use ($user) {
            $query->select(\DB::raw('DISTINCT(`projects`.`id`)'))
                ->from('projects')
                ->join('project_members', 'project_members.project_id', '=', 'projects.id')
                ->where('project_members.user_id', $user->id);
        });
        // Load employees relation, if not loaded
        $relations = $query->getEagerLoads();
        $relationRequested = true;

        if (!array_key_exists('members_many', $relations)) {
            $relationRequested = false;
            $relations['members_many'] = function ($query) {
                return $query;
            };
        }
        // Load employees relation, if not loaded*/
        $relations = $query->getEagerLoads();
        $relationRequested = true;

        $query->setEagerLoads($relations);

        /** @var Collection $results */
        $results = $this->getResults();
//        echo '<pre>'; print_r($query);
//dd($results);
        $results = $results->toArray();

        $meta = $this->getMetaData();
        $totalProjects = Project::select('projects.id','projects.project_name','projects.start_date','projects.deadline','valuation_properties.ref_id')
            ->join('project_members', 'project_members.project_id', '=', 'projects.id')
            ->join('valuation_properties', 'valuation_properties.id', '=', 'projects.property_id')
            ->where('project_members.user_id', '=', api_user()->id)
            ->get();

//        $totalProjects = Project::select('valuation_properties.ref_id')
//            ->join('valuation_properties', 'valuation_properties.id', '=', 'projects.property_id')
//            ->where('projects.property_id', '=', 'valuation_properties.id')
//            ->get();
        return ApiResponse::make(null, ['project'=>$totalProjects], $meta);
//        return ApiResponse::make(null, $results, $meta);
    }

    public function list()
    {
        app()->make($this->indexRequest);

        $query = $this->parseRequest()
            ->addIncludes()
            ->addFilters()
            ->addOrdering()
            ->addPaging()
            ->getQuery();

        $user = api_user();

        $query->whereIn('projects.id', function ($query) use ($user) {
            $query->select(\DB::raw('DISTINCT(`projects`.`id`)'))
                ->from('projects')
                ->join('project_members', 'project_members.project_id', '=', 'projects.id')
                ->where('project_members.user_id', $user->id);
        });

        // Load employees relation, if not loaded
        $relations = $query->getEagerLoads();
        $relationRequested = true;

        if (!array_key_exists('members_many', $relations)) {
            $relationRequested = false;
            $relations['members_many'] = function ($query) {
                return $query;
            };
        }

        $query->setEagerLoads($relations);

        /** @var Collection $results */
        $results = $this->getResults();


        $results = $results->toArray();

        //making appointment array
        $appointments = array();
        if($results){
            foreach ($results as $resultsIn){
                $projectId = $resultsIn['id'];
                $projectObj = Project::find($projectId);

                $appointmentDateObj = $projectObj->start_date;
                if(!empty($appointmentDateObj)){
                    $appointmentDate = $appointmentDateObj->format('Y-m-d');
                    $appointmentTime = $appointmentDateObj->format('h:i A');

                    $tempArray = array();
                    $tempArray['projectId'] = $projectId;
                    $tempArray['eventName'] = 'House Inspection';
                    $tempArray['eventTime'] = $appointmentTime;
                    $tempArray['eventDate'] = $appointmentDate;
                    $appointments[$appointmentDate][] = $tempArray;
                }
            }
        }

        // format appointment array
        $formatAppointmentArray = array();
        $count = 0;
        foreach ( $appointments as $key => $appointment){
            $formatAppointmentArray[$count] = array('events'=>$appointment);
            $count++;
        }

        $meta = $this->getMetaData();

        return ApiResponse::make(null, $formatAppointmentArray, $meta);
    }
}
