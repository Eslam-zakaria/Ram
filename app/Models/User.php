<?php

namespace App\Models;

use App\Constants\Roles;
use App\Constants\Statuses;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active',
    ];

    /**
     * The attributes that are appended.
     *
     * @var array
     */
    protected $appends = [
        'roleLabel', 'statusLabel'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $pass
     */
    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = \Hash::make($pass);
    }


    public function getRoleLabelAttribute()
    {
        return Roles::getLabel($this->role);
    }

    public function getStatusLabelAttribute()
    {
        return Statuses::getLabel($this->active);
    }

    public function setRole($role)
    {
        $this->role = $role;
    }
    public function getRole()
    {
        return $this->role ;
    }
    public function setEmailVerifiedAt($emailVerifiedAt)
    {
        $this->email_verified_at = $emailVerifiedAt;
    }

    public function setActive($active)
    {
        $this->active = $active;
    }

}
