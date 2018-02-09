<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class reunion_dl extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
     * Get the committee members for the reunion.
     */
    public function registrations()
    {
        return $this->hasMany('App\Registration', 'dl_id');
    }
}
