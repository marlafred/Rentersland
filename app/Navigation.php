<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
    */
    
    public function pages()
    {
      return $this->belongsTo('App\Page', 'page_id', 'id');
    }
}
