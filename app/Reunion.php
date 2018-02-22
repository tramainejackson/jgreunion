<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reunion extends Model
{
    /**
     * Get the committee members for the reunion.
     */
    public function committee()
    {
        return $this->hasMany('App\Reunion_committee');
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
        return $this->hasMany('App\Registration', 'reunion_id');
    }
}
