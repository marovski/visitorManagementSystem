<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;
use App\Models\Security;
use App\Models\Meeting;



class User extends Authenticatable
{
  use Notifiable;
  

      /*
  |--------------------------------------------------------------------------
  | GLOBAL VARIABLES
  |--------------------------------------------------------------------------
  */



    protected $primaryKey = 'idUser';
    protected $table='users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    
        'username', 'email', 
    ];

    // *
    //  * The attributes that should be hidden for arrays.
    //  *
    //  * @var array
     
    protected $hidden = [
     'remember_token',
     ];


      /*
  |--------------------------------------------------------------------------
  | FUNCTIONS
  |--------------------------------------------------------------------------
  */

    public function isSuperAdmin()
    {
        foreach ($this->securities()->get() as $role)
        {
            if ($role->superAdmin == '1')
            {
                return true;
            }
        }

        return false;
    }


     public function role()
    {
      $n=2;
      $sec = Security::whereHas('users', function ($query) {
      $query->where('meetingPermission', '=', '2'); 


     })->get();

     

        foreach ($sec as $role)
        {


            if ($role->idSecurity == Auth::user()->fk_idSecurity){


              return true;

            }

                
             return false;
          
        }
       
          
    }
    
    

      //One to Many Relationships

    public function delivers()
    {
      return $this->hasMany('App\Models\Deliver','deIdUser');
    }
   public function drops()
    {
      return $this->hasMany('App\Models\Drop', 'dropIdUser');
    }

      public function meetingHost()
    {
      return $this->hasMany('App\Models\Meeting', 'meetIdHost');
    }

     public function losts(){


    return $this->hasMany('App\Models\LostFound', 'idUser');


    }


    //MAny to Many Relationships

    public function meetings()
    {
      return $this->belongsToMany('App\Models\Meeting');
    }


    //Many to One Relationships

    public function securities()
    {
      return $this->belongsTo('App\Models\Security');
    }


   
  

  }