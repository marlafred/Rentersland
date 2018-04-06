<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingAmenties extends Model
{
    protected $fillable = array('name');
     public function listing()
    {
	 return $this->belongsTo('App\Listing');
    }
}
