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
    protected $table = 'users';

    /**
     * The column used to store the password hash.
     * Required by Illuminate\Auth\SessionGuard when calling Auth::login().
     */
    public function getAuthPassword()
    {
        return $this->password;
    }
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'organization_id',
        'fk_idSecurity', 'department', 'photo', 'is_org_admin', 'remember_token',
    ];

    protected $hidden = [
        'password',
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
        $security = Security::find($this->fk_idSecurity);
        return $security && $security->meetingPermission == '2';
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

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization', 'organization_id');
    }

    public function isOrgAdmin()
    {
        return (bool) $this->is_org_admin;
    }

  }