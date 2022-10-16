<?php

namespace App\Http\Resources\V1;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserRegisterTokenResource extends JsonResource
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
                'emailPasswdConf' => $this->email_passwd_conf,
                'ipAddr' => $this->ip_addr,
                'dateSubmitted' => $this->date_submitted,
                'authorisation' => [
                    'token' => Auth::login(User::find($this->id)),
                    'type' => 'bearer',
                ]
            ]
        ];
    }
}
