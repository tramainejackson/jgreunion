<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReunionHotel extends Model
{
    /**
     * Get the reunion for the hotel.
     */
    public function reunion()
    {
        return $this->belongsTo('App\Reunion');
    }
	
	/**
     * Get the features for the hotel.
     */
    public function features()
    {
        return $this->hasMany('App\HotelFeature');
    }
}
