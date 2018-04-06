<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingImages extends Model
{
    protected $fillable = array('image');
     public function listing()
    {
	 return $this->belongsTo('App\Listing');
    }
}
