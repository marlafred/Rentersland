<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TenantAbout extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    
    public function user()
    {
      return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
    
}
