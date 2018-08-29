<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeliverType extends Model
{

  use SoftDeletes;

  /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $primaryKey = 'idDeliverType';
    
    protected $table='delivertype';



     protected $dates = [
    
        'deleted_at'
    ];
        /*
  |--------------------------------------------------------------------------
  | FUNCTIONS
  |--------------------------------------------------------------------------
  */

 public function deliver()
  {
    
    return $this->belongsTo('App\Models\Deliver');
  
  }

}
