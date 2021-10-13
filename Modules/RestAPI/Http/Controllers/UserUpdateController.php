<?php

namespace Modules\RestAPI\Http\Controllers;

use Froiden\RestAPI\ApiController;
use Froiden\RestAPI\ApiResponse;
use Froiden\RestAPI\Exceptions\ApiException;
use Modules\RestAPI\Entities\User;
use App\User as AppUser;
use Modules\RestAPI\Http\Requests\UserUpdate\UpdateProfileRequest;
use Illuminate\Http\Request;

class UserUpdateController extends ApiController
{
    protected $model = User::class;
    protected $indexRequest = UpdateProfileRequest::class;

    public function updateProfile(UpdateProfileRequest $request)
    {
        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $number = $request->number;

        //email validation
        $userByEmail = AppUser::where('email', $email)->where('id','!=', $id)->first();
        if(!empty($userByEmail)){
            throw new ApiException('Email already exist', null, 422, 422, 2001);
        }

        //updating user
        $user = AppUser::where('id', $id)->first();
        if(empty($user)){
            throw new ApiException('User not exist', null, 422, 422, 2001);
        }
        $user->name = $name;
        $user->email = $email;
        $user->mobile = $number;
        $user->save();

        return ApiResponse::make('User record updated', $user);
    }
}
