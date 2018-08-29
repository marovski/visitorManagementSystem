<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
class Drop extends Model
{  
  use Searchable;
  use SoftDeletes;
  /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

  protected $primaryKey = 'idDrop';
  
  protected $table='drops';	

      protected $dates = [
    
        'deleted_at'
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
    
        'dropperCompanyName','idDrop', 'dropReceiver','dropperName', 'dropDescr','receiverPhone',
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




}
