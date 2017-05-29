<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App\Models
 */
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'enable'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token',];

    /**
     * @param $date
     * @return string|static
     */
//    public function getCreatedAtAttribute($date)
//    {
//        if (Carbon::now() > Carbon::parse($date)->addDays(10)) {
//            return Carbon::parse($date);
//        }
//        return Carbon::parse($date)->diffForHumans();
//    }

    /**
     * @param $date
     * @return string|static
     */
//    public function getUpdatedAtAttribute($date)
//    {
//        if (Carbon::now() > Carbon::parse($date)->addDays(10)) {
//            return Carbon::parse($date);
//        }
//        return Carbon::parse($date)->diffForHumans();
//    }

    /**
     * @param $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }
}
