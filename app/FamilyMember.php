<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FamilyMember extends Model
{
	use SoftDeletes;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'user_id',
    ];
	
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
     * Get the registrations for the family member.
     */
    public function registrations()
    {
        return $this->hasMany('App\Registration');
    }
	
	/**
     * Get the committees that the member is a part of.
     */
    public function committees()
    {
        return $this->hasMany('App\ReunionCommittee');
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
	
	/**
	* Get the user for the family member account.
	*/
    public function full_address()
    {
		return $this->address . ', ' . $this->city . ', ' . $this->state . ' ' . $this->zip;
	}
	
	/**
	* Get the user for the family member account.
	*/
    public function scopeHousehold($query, $family_id)
    {
        return $query->where([
			['family_id', $family_id],
			['family_id', '<>', 'null']
		])->get();
    }
	
	/**
	* Get the user for the family member account.
	*/
    public function scopePotentialHousehold($query, $family_member)
    {
        return $query->where([
			['address', $family_member->address],
			['city', $family_member->city],
			['state', $family_member->state]
		])->get();
    }
	
	/**
	* Check for duplicated
	*/
    public function scopeCheckDuplicates($query)
    {
		return $query->selectRaw('firstname, lastname, city, state')
			->where('duplicate', null)
			->groupBy('firstname')
			->groupBy('lastname')
			->groupBy('city')
			->groupBy('state')
			->havingRaw('COUNT(firstname) > 1 AND COUNT(lastname) > 1 AND COUNT(city) > 1 AND COUNT(state) > 1')
			->get();
    }
	
	/**
	* Get all the duplicates that were found
	*/
    public function scopeGetDuplicates($query, $firstname, $lastname, $city, $state)
    {
		return $query->where([
				['firstname', 'LIKE', '%' . $firstname . '%'],
				['lastname', 'LIKE', '%' . $lastname . '%'],
				['city', 'LIKE', '%' . $city . '%'],
				['state', 'LIKE', '%' . $state . '%'],
				['duplicate', null],
			]);
    }
	
	/**
	* Get all the duplicates that were found
	*/
    public function scopeUsers($query)
    {
		return $query->where('user_id', '<>', null);
    }
	
}
