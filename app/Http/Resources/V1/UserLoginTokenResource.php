<?php

namespace App\Http\Resources\V1;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserLoginTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'users',
            'attributes' => [
                'email' => $this->email,
                'ipAddr' => $this->ip_addr,
                'dateSubmitted' => $this->date_submitted,
                'authorisation' => [
                    'token' => Auth::attempt($request->only('email', 'password')),
                    'type' => 'bearer',
                ]
            ]
        ];
    }
}
