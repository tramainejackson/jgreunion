<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
	* Get the family member account for the user.
	*/
    public function member()
    {
        return $this->hasOne('App\FamilyMember');
    }
	
	/**
	* Check the user is admin.
	*/
    public function is_admin()
    {
        return $this->administrator == 'Y' ? true : false;
    }
}
