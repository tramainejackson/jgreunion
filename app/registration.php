<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class registration extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
    /**
     * Get the activities for the trip.
     */
    public function reunion_dl()
    {
        return $this->belongsTo('App\Reunion_dl', 'dl_id');
    }
	
	/**
     * Get the activities for the trip.
     */
    public function reunion()
    {
        return $this->belongsTo('App\Reunion');
    }
	
	/**
     * Get the additional members on this registration.
     */
    public function children_reg()
    {
        return $this->hasMany('\App\Registration', 'parent_reg');
    }
}
