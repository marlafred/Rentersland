<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    //protected $fillable = ['name'];
	
	public function amenities(){
            return $this->hasMany('App\Amenities', 'listing_id', 'id');
	}
        public function buildingamenties(){
            return $this->hasMany('App\BuildingAmenties', 'listing_id', 'id');
	}
        public function listingimages(){
            return $this->hasMany('App\ListingImages', 'listing_id', 'id');
        }
        public function applylistings(){
            return $this->hasMany('App\ApplyListing', 'listing_id', 'id');
        }
        public function listingplans(){
            return $this->hasMany('App\TourRequest', 'listing_id', 'id');
        }
	public function users()
        {
          return $this->belongsTo('App\User', 'user_id', 'id');
        }
        
        
        /**/
        // this is a recommended way to declare event handlers
        protected static function boot() {
            parent::boot();

            static::deleting(function($listing) { // before delete() method call this
                 $listing->amenities()->delete();
                 $listing->buildingamenties()->delete();
                 $listing->listingimages()->delete();
                 $listing->listingplans()->delete();
                 $listing->applylistings()->delete();
                 // do the rest of the cleanup...
            });
        }
}
