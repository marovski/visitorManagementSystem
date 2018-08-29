<?php

namespace App\Http\Controllers;
use App\Models\LostFound;
use App\Models\Visitor;
use App\Models\Meeting;
use App\Models\Drop;
use App\Models\Deliver;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Session;
use Mail;

class PagesController extends Controller{

	public function getIndex() {			
		$userId = Auth::id();
        $user = User::find($userId);

		$userPhoto = User::all();
        
		$meetings = Meeting::orderBy('sensibility','desc')->whereDay('meetStartDate','=',date('d'))->paginate(10);

		$hostMeetings = Meeting::orderBy('sensibility','desc')->where('meetIdHost','=', $userId)->paginate(5);

		$delivers = Deliver::orderBy('deEntryTime','asc')->whereRaw('DAY(created_at) = ?',[date('d')])->paginate(5);

		$drops = Drop::orderBy('droppedWhen','asc')->whereRaw('DAY(created_at) = ?',[date('d')])->paginate(5);
		
		
	
		return view('pages.welcome', compact('meetings','user','hostMeetings','userPhoto','delivers','drops'));
	}

	public function getAbout(){
	
		return view('pages.about');
	}


	public function getContact(){
		return view('pages.contact');
	}






}