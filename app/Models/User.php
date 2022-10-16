<?php

namespace App\Models;

use App\Notifications\V1\ResetPasswordNotification;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail, JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tblm_a_onboard_prereg';

    /**
     * The table associated with the model.
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'ip_addr',
        'date_submitted',
        'is_verified',
        'date_verified',
        'maxdays_unverified',
        'is_expired',
        'date_expired'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'email_passwd_conf',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_submitted' => 'datetime',
        'is_verified' => 'boolean',
        'date_verified' => 'datetime',
        'is_expired' => 'boolean',
        'date_expired' => 'datetime'
    ];

    /**
     * @return HasOne
     */
    public function registrant(): HasOne
    {
        return $this->hasOne(Registrant::class, 'reg_link_preregid');
    }

    /**
    * Get the identifier that will be stored in the subject claim of the JWT.
    *
    * @return mixed
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
        * Return a key value array, containing any custom claims to be added to the JWT.
        *
        * @return array
        */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token)
    {
        $baseURL = config('app.url');
        $url = $baseURL . '?reset-password?token=' . $token;

        $this->notify(new ResetPasswordNotification($url));
    }
}
