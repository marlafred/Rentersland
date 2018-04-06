<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Amenities extends Model
{
    protected $fillable = array('name');
    public function listing()
    {
	return $this->belongsTo('App\Listing');
    }
}
