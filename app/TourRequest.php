<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TourRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    public function listing()
    {
	return $this->belongsTo('App\Listing');
    }
    public function requests(){
        return $this->hasMany('App\ReplyRequest', 'req_id', 'id');
    }
    
    /**/
    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($tour) { // before delete() method call this
            $tour->requests()->delete();
            // do the rest of the cleanup...
        });
    }
}
