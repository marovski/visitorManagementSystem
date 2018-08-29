<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Visitor extends Model
{		


  use SoftDeletes;
  /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/


	protected $primaryKey = 'idVisitor';
	
	protected $table='visitors';

	  protected $dates = [
    
        'deleted_at'
    ];
	public $fillable=['idVisitor','visitorName' , 'visitorCompanyName' , 'visitorEmail'];

	  /*
  |--------------------------------------------------------------------------
  | FUNCTIONS
  |--------------------------------------------------------------------------
  */

	public function meeting()
	{
		return $this->belongsToMany('App\Models\Meeting');
	}
}
