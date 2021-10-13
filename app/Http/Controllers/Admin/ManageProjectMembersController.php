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
use Illuminate\Support\Facades\DB;
use Modules\Valuation\Entities\ValuationIntendedUser;

class ManageProjectMembersController extends AdminBaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->pageIcon = 'icon-layers';
        $this->pageTitle = 'app.menu.projects';
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectMembers $request)
    {
        $users = $request->user_id;

        foreach ($users as $user) {
            $member = new ProjectMember();
            $member->user_id = $user;
            $member->project_id = $request->project_id;
            $member->save();

            $this->logProjectActivity($request->project_id, ucwords($member->user->name) . ' ' . __('messages.isAddedAsProjectMember'));
        }

        return Reply::success(__('messages.membersAddedSuccessfully'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->project = Project::findOrFail($id);

        $this->employees = User::doesntHave('member', 'and', function ($query) use ($id) {
            $query->where('project_id', $id);
        })
            ->join('role_user', 'role_user.user_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->select('users.id', 'users.name', 'users.email', 'users.created_at')
            ->where('roles.name', 'employee')
            ->groupBy('users.id')
            ->distinct('users.id')
            ->get();
        $meta = $this->project->getMeta('intendedUsers', array());
        $this->groups = Team::all();
        $this->intendedUsers = DB::table('valuation_intended_users')
            ->whereNotIn('id', $meta)->select('id','title')->get();
        $this->projectIntendedUsers = DB::table('valuation_intended_users')
                                        ->whereIn('id', $meta)->select('id','title')->get();

        return view('admin.projects.project-member.create', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
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
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
     * @param  int  $id
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
            public function destroyIntendedUser(Request $request)
    {

        $project = Project::findOrFail($request->project);
       $dataArray = $project->getMeta('intendedUsers','null' , 'array');
        $pos = array_search($request->id, $dataArray);
                unset($dataArray[$pos]);
                $metaData['intendedUsers']=$dataArray;
                $project->setMeta($metaData);

        return Reply::success(__('messages.memberRemovedFromProject'));
    }

    public function storeIntendedUser(Request $request){

        $project = Project::find($request->project_id);

        if($project->getMeta('intendedUsers',null,array())){
            $get = $project->getMeta('intendedUsers',null,'array');
            $new = array_merge($request->user_id,$get);
            $metaData['intendedUsers']  = $new;
            $project->setMeta($metaData);
        }else{
            $metaData['intendedUsers'] = $request->user_id;
            $project->setMeta($metaData);
        }
        return Reply::success(__('messages.intendedUsersAddedSuccessfully'));

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
}
