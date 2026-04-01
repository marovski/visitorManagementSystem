<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LostFound extends Model
{

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
        'itemDescription','idLostFound', 'finderName','receiverName', 'finderPhone','receiverPhone','organization_id',
    ];


  /*
	|--------------------------------------------------------------------------
	| FUNCTIONS
	|--------------------------------------------------------------------------
	*/

	public function user(){
    return $this->belongsTo('App\Models\User');
	}

	public function organization()
	{
		return $this->belongsTo('App\Models\Organization', 'organization_id');
	}

}

