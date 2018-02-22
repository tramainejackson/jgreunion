<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class reunion_committee extends Model
{
    /**
     * Get the distribution list member for the committee member.
     */
    public function reunion_dl()
    {
        return $this->belongsTo('App\Reunion_dl', 'dl_id');
    }
	
	/**
     * Get the reunion for the committee member.
     */
    public function reunion()
    {
        return $this->belongsTo('App\Reunion');
    }
}
