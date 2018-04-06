<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    
    public function navigation()
    {
      return $this->hasMany('App\Navigation', 'page_id', 'id');
    }
    
    /**/
    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($page) { // before delete() method call this
             $page->navigation()->delete();
             // do the rest of the cleanup...
        });
    }
    
}
