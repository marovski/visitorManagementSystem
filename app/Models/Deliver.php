<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Laravel\Scout\Searchable;
class Deliver extends Model
{
  
    use Searchable;
    use SoftDeletes;

  /*

  |--------------------------------------------------------------------------
  | GLOBAL VARIABLES
  |--------------------------------------------------------------------------
  */


      /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */

    protected $dates = [
    
       
        'deleted_at'
    ];
    
   

	  protected $primaryKey = 'idDeliver';
  
  	protected $table='delivers';

      /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
    
        'deFirmSupplier','idDeliver', 'deDriverName','deDriverID',
    ];

    /*
  |--------------------------------------------------------------------------
  | FUNCTIONS
  |--------------------------------------------------------------------------
  */
   	public function user()
  {
    return $this->belongsTo('App\Models\User');
  }

 public function type()
  {
    return $this->hasMany('App\Models\DeliverType');
  }

 public function setExitWeightAttribute($value)
    {
        $this->attributes['exitWeight'] = ($value);
    }

}
