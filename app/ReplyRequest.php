<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReplyRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public function replies()
    {
	 return $this->belongsTo('App\TourRequest');
    }
    
}
