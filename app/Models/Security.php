<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    /*
  |--------------------------------------------------------------------------
  | GLOBAL VARIABLES
  |--------------------------------------------------------------------------
  */
	protected $primaryKey='idSecurity';
	protected $table='securities';


    /*
  |--------------------------------------------------------------------------
  | FUNCTIONS
  |--------------------------------------------------------------------------
  */
    public function users()
    {
        return $this->hasMany('App\Models\User',  'fk_idSecurity');
    }




}
