<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotelFeature extends Model
{
    /**
     * Get the features for the hotel.
     */
    public function hotel()
    {
        return $this->belongsTo('App\ReunionHotel');
    }
}
