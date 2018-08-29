<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
class LostFound extends Model
{


	use Searchable;
	use SoftDeletes;
    /*
	|--------------------------------------------------------------------------
	| GLOBAL VARIABLES
	|--------------------------------------------------------------------------
	*/

	protected $table = 'lostItems';
	protected $primaryKey = 'idLostFound';
	
	 protected $dates = [
    
        'deleted_at'
    ];
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
    
        'itemDescription','idLostFound', 'finderName','receiverName', 'finderPhone','receiverPhone',
    ];


  /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	public function user(){


    return $this->belongsTo('App\Models\User');


	}
}
