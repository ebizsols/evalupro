<?php

namespace Modules\RestAPI\Http\Requests\UserUpdate;

use Modules\RestAPI\Http\Requests\BaseRequest;

class UpdateProfileRequest extends BaseRequest
{

    public function authorize()
    {
        $user = api_user();
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:users,id',
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required'
        ];
    }
}
