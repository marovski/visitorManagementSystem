<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use Laravel\Scout\Searchable;


class Meeting extends Model
{

  use Searchable;
  use SoftDeletes;
  /*
  |--------------------------------------------------------------------------
  | GLOBAL VARIABLES
  |--------------------------------------------------------------------------
  */


	protected $primaryKey='idMeeting';

	protected $table='meetings';

  protected $dates = [
    
        'deleted_at'
    ];


  public $fillable = ['idMeeting','meetingName','visitReason','meetStatus','room','organization_id'];

    /*
  |--------------------------------------------------------------------------
  | FUNCTIONS
  |--------------------------------------------------------------------------
  */
  
     public function host()
  {
    return $this->belongsTo('App\Models\User');
  }

  
     public function user()
  {
    return $this->belongsToMany('App\Models\User');
  }

 

     public function visitor()
  {
    return $this->belongsToMany('App\Models\Visitor');
  }

  public function organization()
  {
    return $this->belongsTo('App\Models\Organization', 'organization_id');
  }

  public function toSearchableArray()
  {
    return [
      'idMeeting'      => $this->idMeeting,
      'meetingName'    => $this->meetingName,
      'visitReason'    => $this->visitReason,
      'organization_id'=> $this->organization_id,
    ];
  }
}
