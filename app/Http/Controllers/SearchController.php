<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

use App\Http\Controllers\Controller;

use App\Models\Meeting;
use App\Models\LostFound;
use App\Models\Visitor;
use App\Models\User;
use App\Models\Drop;
use App\Models\Deliver;

class SearchController extends Controller
{

    /**
     * Display a listing of the resource Meetings.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMeeting(Request $request)
    {
        $user= User::all()->load('meetingHost');
        $visitor= Visitor::all()->load('meeting');

        if (!$request->q) {

            return redirect('/');
        }


        $meetings = Meeting::search($request->q)->take(3)->get();

        return view('search.indexMeeting', compact('meetings','user','visitor'));
    }


/**
     * Display a listing of the resource Deliver.
     *
     * @return \Illuminate\Http\Response
     */
     public function indexDeliver(Request $request)
    {
   
        $type= Deliver::all()->load('type');

        if (!$request->q) {

            return redirect('/');
        }


        $delivers = Deliver::search($request->q)->take(3)->get();

        return view('search.indexDeliver', compact('delivers','type'));
    }



    /**
     * Display a listing of the resource Drop.
     *
     * @return \Illuminate\Http\Response
     */

     public function indexDrop(Request $request)
    {
  

        if (!$request->q) {

            return redirect('/');
        }


        $drops = Drop::search($request->q)->take(3)->get();

        return view('search.indexDrop', compact('drops'));
    }



        /**
     * Display a listing of the resource Drop.
     *
     * @return \Illuminate\Http\Response
     */

     public function indexLostItem(Request $request)
    {
  

        if (!$request->q) {

            return redirect('/');
        }


        $lostItems = LostFound::search($request->q)->take(3)->get();

        return view('search.indexLostItem', compact('lostItems'));
    }






public function autocomplete(Request $request, $id)
{

    if ($id=='vn') {
          $data = Visitor::select("visitorName as name")->where("visitorName","LIKE","%{$request->input('query')}%")->get();
        return response()->json($data);}
       elseif ($id=='vE') {
      $data = Visitor::select("visitorEmail as name")->where("visitorEmail","LIKE","%{$request->input('query')}%")->get();

        return response()->json($data);
        }elseif ($id=='vC') {
          $data = Visitor::select("visitorCompanyName as name")->where("visitorCompanyName","LIKE","%{$request->input('query')}%")->get();
            return response()->json($data);
        }elseif ($id=='vP') {
            $data = Visitor::select("visitorNPhone as name")->where("visitorNPhone","LIKE","%{$request->input('query')}%")->get();
            return response()->json($data);
        }elseif ($id=='mT') {

             $data = Meeting::select("meetingName as name")->where("meetingName","LIKE","%{$request->input('query')}%")->get();
             
             return response()->json($data);
   
    }elseif ($id=='mP') {
             $data = Meeting::select("visitReason as name")->where("visitReason","LIKE","%{$request->input('query')}%")->get();

             return response()->json($data);
    }elseif ($id=='driverN') {
             $data = Deliver::select("deDriverName as name")->where("deDriverName","LIKE","%{$request->input('query')}%")->get();

             return response()->json($data);
    }elseif ($id=='firm') {
             $data = Deliver::select("deFirmSupplier as name")->where("deFirmSupplier","LIKE","%{$request->input('query')}%")->get();

             return response()->json($data);
    }elseif ($id=='vehiclePlate') {
             $data = Deliver::select("vehicleRegistry as name")->where("vehicleRegistry","LIKE","%{$request->input('query')}%")->get();

             return response()->json($data);
    }elseif ($id=='dropC') {
             $data = Drop::select("dropperCompanyName as name")->where("dropperCompanyName","LIKE","%{$request->input('query')}%")->get();

             return response()->json($data);
    }elseif ($id=='dropN') {
             $data = Drop::select("dropperName as name")->where("dropperName","LIKE","%{$request->input('query')}%")->get();

             return response()->json($data);
    }elseif ($id=='dropR') {
             $data = User::select("username as name")->where("username","LIKE","%{$request->input('query')}%")->get();

             return response()->json($data);
    }


}
       




        
}