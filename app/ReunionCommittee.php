<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReunionCommittee extends Model
{
    /**
     * Get the distribution list member for the committee member.
     */
    public function family_member()
    {
        return $this->belongsTo('App\Family_Member');
    }
	
	/**
     * Get the reunion for the committee member.
     */
    public function reunion()
    {
        return $this->belongsTo('App\Reunion');
    }
	
	/**
     * Get the president for the committee member.
     */
    public function scopePresident($query)
    {
        return $query->where('member_title', 'president')->first();
    }
}
