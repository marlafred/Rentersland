<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','status', 'last_name', 'email','username', 'password', 'phone_number', 'company', 'market_type', 'user_type','bedrooms','towns','pets'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function listing()
    {
      return $this->hasMany('App\Listing', 'user_id', 'id');
    }
    
    public function about()
    {
      return $this->hasOne('App\TenantAbout', 'user_id', 'id');
    }
    
    public function residence()
    {
      return $this->hasOne('App\TenantResidence', 'user_id', 'id');
    }
    public function occupation()
    {
       return $this->hasOne('App\TenantOccupation', 'user_id', 'id');
    }
    public function info()
    {
       return $this->hasOne('App\TenantInfo', 'user_id', 'id');
    }
    public function reference()
    {
       return $this->hasOne('App\TenantReference', 'user_id', 'id');
    }
    public function finance()
    {
       return $this->hasMany('App\TenantFinance', 'user_id', 'id');
    }
    public function loan()
    {
       return $this->hasMany('App\TenantLoan', 'user_id', 'id');
    }
    
    public function applications()
    {
       return $this->hasMany('App\ApplyListing', 'tenant_id', 'id');
    }
    
    public function files()
    {
      return $this->hasMany('App\DocFile', 'user_id', 'id');
    }
    
    

    /**/
    // this is a recommended way to declare event handlers
    protected static function boot() {
        parent::boot();

        static::deleting(function($user) { // before delete() method call this
             //$user->listing()->delete();
             // do the rest of the cleanup...
        });
        
        static::deleting(function($user) { // before delete() method call this
             $user->files()->delete();
             // do the rest of the cleanup...
        });
        
        static::deleting(function($user) { // before delete() method call this
             $user->about()->delete();
             // do the rest of the cleanup...
        });
        
        static::deleting(function($user) { // before delete() method call this
             $user->residence()->delete();
             // do the rest of the cleanup...
        });
        
        static::deleting(function($user) { // before delete() method call this
             $user->occupation()->delete();
             // do the rest of the cleanup...
        });
        
        static::deleting(function($user) { // before delete() method call this
             $user->info()->delete();
             // do the rest of the cleanup...
        });
        
        static::deleting(function($user) { // before delete() method call this
             $user->reference()->delete();
             // do the rest of the cleanup...
        });
        
        static::deleting(function($user) { // before delete() method call this
             $user->finance()->delete();
             // do the rest of the cleanup...
        });
        
        static::deleting(function($user) { // before delete() method call this
             $user->loan()->delete();
             // do the rest of the cleanup...
        });
        
        static::deleting(function($user) { // before delete() method call this
             $user->applications()->delete();
             // do the rest of the cleanup...
        });
        
        
    }
}
