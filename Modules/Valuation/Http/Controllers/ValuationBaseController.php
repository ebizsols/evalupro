<?php

namespace Modules\Valuation\Http\Controllers;

use App\Company;
use App\EmailNotificationSetting;
use App\Notification;
use App\ProjectTimeLog;
use App\Role;
use App\StickyNote;
use App\ThemeSetting;
use App\Traits\FileSystemSettingTrait;
use App\UserChat;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class ValuationBaseController extends Controller
{

    use FileSystemSettingTrait;
    /**
     * @var array
     */
    public $data = [];

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->data[$name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->data[ $name ]);
    }

    public function __construct()
    {
        $this->emailSetting = EmailNotificationSetting::all();
        $this->employeeTheme = ThemeSetting::where('panel', 'employee')->first();
        Carbon::setUtf8(true);
        $this->setFileSystemConfigs();
        $this->middleware(function ($request, $next) {

            $this->user = auth()->user();
            $this->global = Company::withoutGlobalScope('active')->where('id', Auth::user()->company_id)->first();;
            $this->emailSetting = EmailNotificationSetting::all();
            $this->companyName = $this->global->company_name;
            $this->employeeTheme = ThemeSetting::where('panel', 'employee')->first();

            App::setLocale($this->global->locale);
            Carbon::setUtf8(true);
            Carbon::setLocale($this->global->locale);
            setlocale(LC_TIME,$this->global->locale.'_'.strtoupper($this->global->locale));
            $this->setFileSystemConfigs();

            $this->modules = $this->user->modules;
//            dd($this->modules);

            $userRole = $this->user->role; // Getting users all roles

            if(count($userRole) > 1){ $roleId = $userRole[1]->role_id; } // if single role assign getting role ID
            else{ $roleId = $userRole[0]->role_id; } // if multiple role assign getting role ID

            // Getting role detail by ID that got above according single or multiple roles assigned.
            $this->userRole = Role::where('id', $roleId)->first();

            $this->notifications = $this->user->notifications;
            $this->timer = ProjectTimeLog::memberActiveTimer($this->user->id);
            $this->unreadMessageCount = UserChat::where('to', $this->user->id)->where('message_seen', 'no')->count();
            $this->unreadExpenseCount = Notification::where('notifiable_id', $this->user->id)
                ->where(function($query){
                    $query->where('type', 'App\Notifications\NewExpenseStatus');
                    $query->orWhere('type', 'App\Notifications\NewExpenseMember');
                })
                ->whereNull('read_at')
                ->count();
            $this->unreadProjectCount = Notification::where('notifiable_id', $this->user->id)
                ->where('type', 'App\Notifications\NewProjectMember')
                ->whereNull('read_at')
                ->count();
            $this->stickyNotes = StickyNote::where('user_id', $this->user->id)->orderBy('updated_at', 'desc')->get();
            return $next($request);
        });

    }
}
