<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileAvatar extends Model
{
    /**
	* Get the family member account for the avatar.
	*/
    public function family_member()
    {
        return $this->belongsTo('App\FamilyMember');
    }
}
