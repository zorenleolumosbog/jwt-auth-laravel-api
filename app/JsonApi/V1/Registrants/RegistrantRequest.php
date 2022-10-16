<?php

namespace App\JsonApi\V1\Registrants;

use Illuminate\Validation\Rule;
use LaravelJsonApi\Laravel\Http\Requests\ResourceRequest;
use LaravelJsonApi\Validation\Rule as JsonApiRule;

class RegistrantRequest extends ResourceRequest
{

    /**
     * Get the validation rules for the resource.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'regFirstname' => ['required', 'string'],
            'regMiddlename' => ['nullable', 'string'],
            'regLastname' => ['required', 'string'],
            'regBirthdate' => ['required', 'string'],
            'regCivilstatus' => ['required', 'string'],
            'regReligion' => ['required', 'string'],
            'regAddrLine1' => ['required', 'string'],
            'regAddrLine2' => ['nullable', 'string'],
            'regAddrTowncity' => ['required', 'string'],
            'regAddrState' => ['required', 'string'],
            'regCountryCode' => ['required', JsonApiRule::number()],
            'regProAddrLine1' => ['required', 'string'],
            'regProAddrLine2' => ['nullable', 'string'],
            'regProAddrTowncity' => ['required', 'string'],
            'regProAddrState' => ['required', 'string'],
            'regProAddrCountry' => ['required', 'string'],
            'regDatecreated' => ['nullable', JsonApiRule::dateTime()],
            'regDatemodified' => ['nullable', JsonApiRule::dateTime()],
            'user' => JsonApiRule::toOne(),
        ];
    }

}
