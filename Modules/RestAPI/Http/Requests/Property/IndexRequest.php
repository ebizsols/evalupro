<?php namespace Modules\RestAPI\Http\Requests\Property;

use Modules\RestAPI\Http\Requests\BaseRequest;

class IndexRequest extends BaseRequest
{

    /**
     * @return bool
     * @throws \Froiden\RestAPI\Exceptions\UnauthorizedException
     */
    public function authorize()
    {
        $user = api_user();

        // Either user has role admin or has permission view_projects
        // Plus he needs to have projects module enabled from settings

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }
}
