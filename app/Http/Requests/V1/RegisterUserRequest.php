<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as RulesPassword;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:tblm_a_onboard_prereg'],
            'password' => [
                'required', 
                'confirmed', 
                RulesPassword::min(8)
                            ->mixedCase()
                            ->letters()
                            ->numbers()
                            ->symbols()
                            ->uncompromised()
            ],
        ];
    }
}
