<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReunionImage extends Model
{
	/**
     * Get the reunion for the images.
     */
    public function reunion()
    {
        return $this->belongsTo('App\Reunion');
    }
}
