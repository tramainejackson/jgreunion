<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMember extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
     * Get the committee members for the reunion.
     */
    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }
	
	/**
	* Get the post for the user.
	*/
    public function post()
    {
        return $this->hasMany('App\ProfilePost');
    }
	
	/**
	* Get the user for the family member account.
	*/
    public function user()
    {
        return $this->belongsTo('App\User');
    }
	
	/**
	* Get the user for the family member account.
	*/
    public function full_name()
    {
        return $this->firstname . ' ' . $this->lastname;
    }
}
