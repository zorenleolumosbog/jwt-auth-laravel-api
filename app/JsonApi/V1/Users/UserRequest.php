<?php

namespace App\JsonApi\V1\Users;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;
use Illuminate\Validation\Rules\Password;

class UserRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'email', 'unique:tblm_a_onboard_prereg'],
            'password' => [
                'required', 
                'confirmed', 
                Password::min(8)
                        ->mixedCase()
                        ->letters()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
            ],
            'emailPasswdConf' => ['nulled', 'string'],
            'ipAddr' => ['nulled', 'string'],
            'dateSubmitted' => ['nulled', JsonApiRule::number()],
            'isVerified' => ['nulled', 'boolean'],
            'dateVerified' => ['nulled', JsonApiRule::number()],
            'maxdaysUnverified' => ['nulled', 'number'],
            'isExpired' => ['nulled', 'boolean'],
            'dateExpired' => ['nulled', JsonApiRule::number()],
        ];
    }

}
