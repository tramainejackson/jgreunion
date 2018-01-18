<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class registration extends Model
{
    /**
     * Get the activities for the trip.
     */
    public function reunion_dl()
    {
        return $this->belongsTo('App\Reunion_dl');
    }
	
	/**
     * Get the activities for the trip.
     */
    public function reunion()
    {
        return $this->belongsTo('App\Reunion');
    }
}
