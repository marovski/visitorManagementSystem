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
use App\Http\Controllers\Traits\ScopesToOrganization;

class SearchController extends Controller
{
    use ScopesToOrganization;

    /**
     * Display a listing of the resource Meetings.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexMeeting(Request $request)
    {
        $orgId = $this->currentOrgId();
        $user = User::where('organization_id', $orgId)->get()->load('meetingHost');
        $visitor = Visitor::where('organization_id', $orgId)->get()->load('meeting');

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
    $orgId = $this->currentOrgId();
    $q = $request->input('query');

    if ($id=='vn') {
          $data = Visitor::select("visitorName as name")->where('organization_id',$orgId)->where("visitorName","LIKE","%{$q}%")->get();
        return response()->json($data);}
       elseif ($id=='vE') {
      $data = Visitor::select("visitorEmail as name")->where('organization_id',$orgId)->where("visitorEmail","LIKE","%{$q}%")->get();
        return response()->json($data);
        }elseif ($id=='vC') {
          $data = Visitor::select("visitorCompanyName as name")->where('organization_id',$orgId)->where("visitorCompanyName","LIKE","%{$q}%")->get();
            return response()->json($data);
        }elseif ($id=='vP') {
            $data = Visitor::select("visitorNPhone as name")->where('organization_id',$orgId)->where("visitorNPhone","LIKE","%{$q}%")->get();
            return response()->json($data);
        }elseif ($id=='mT') {
             $data = Meeting::select("meetingName as name")->where('organization_id',$orgId)->where("meetingName","LIKE","%{$q}%")->get();
             return response()->json($data);
    }elseif ($id=='mP') {
             $data = Meeting::select("visitReason as name")->where('organization_id',$orgId)->where("visitReason","LIKE","%{$q}%")->get();
             return response()->json($data);
    }elseif ($id=='driverN') {
             $data = Deliver::select("deDriverName as name")->where('organization_id',$orgId)->where("deDriverName","LIKE","%{$q}%")->get();
             return response()->json($data);
    }elseif ($id=='firm') {
             $data = Deliver::select("deFirmSupplier as name")->where('organization_id',$orgId)->where("deFirmSupplier","LIKE","%{$q}%")->get();
             return response()->json($data);
    }elseif ($id=='vehiclePlate') {
             $data = Deliver::select("vehicleRegistry as name")->where('organization_id',$orgId)->where("vehicleRegistry","LIKE","%{$q}%")->get();
             return response()->json($data);
    }elseif ($id=='dropC') {
             $data = Drop::select("dropperCompanyName as name")->where('organization_id',$orgId)->where("dropperCompanyName","LIKE","%{$q}%")->get();
             return response()->json($data);
    }elseif ($id=='dropN') {
             $data = Drop::select("dropperName as name")->where('organization_id',$orgId)->where("dropperName","LIKE","%{$q}%")->get();
             return response()->json($data);
    }elseif ($id=='dropR') {
             $data = User::select("username as name")->where('organization_id',$orgId)->where("username","LIKE","%{$q}%")->get();
             return response()->json($data);
    }
}
       




        
}