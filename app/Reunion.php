<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reunion extends Model
{
    /**
     * Get the hotel for the reunion.
     */
    public function hotel()
    {
        return $this->hasOne('App\ReunionHotel');
    }
	
	/**
     * Get the committee members for the reunion.
     */
    public function committee()
    {
        return $this->hasMany('App\ReunionCommittee');
    }
	
	/**
     * Get the committee members for the reunion.
     */
    public function events()
    {
        return $this->hasMany('App\Reunion_event');
    }
	
	/**
     * Get the registered members for the reunion.
     */
    public function registrations()
    {
        return $this->hasMany('App\Registration', 'reunion_id')->parents();
    }
	
	/**
     * Get the registered members for the reunion.
     */
    public function images()
    {
        return $this->hasMany('App\ReunionImage');
    }
	
    public function scopeActive($query) {
		return $query->where('reunion_complete', 'N')->get();
	}
	
}
