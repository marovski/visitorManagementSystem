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
	public $fillable=['idVisitor','visitorName' , 'visitorCompanyName' , 'visitorEmail', 'organization_id'];

	  /*
  |--------------------------------------------------------------------------
  | FUNCTIONS
  |--------------------------------------------------------------------------
  */

	public function meeting()
	{
		return $this->belongsToMany('App\Models\Meeting');
	}

	public function organization()
	{
		return $this->belongsTo('App\Models\Organization', 'organization_id');
	}
}
