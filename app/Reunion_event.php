<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class reunion_event extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
     * Get the formatted date.
     */
    public function formatted_date()
    {
		$newDate = new Carbon($this->event_date);
		
        return $newDate->format('m/d/Y');
    }
}
