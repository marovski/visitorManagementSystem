<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LostFound;
use App\Models\Visitor;
use App\Models\Meeting;
use App\Models\Drop;
use App\Models\Deliver;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDashboard(){

    
    return view('pages.dashboard');
    }
 


    public function getCharts(){

     
  

    return view('charts.chartsmenu');

    }


    public function getBarCharts(){

        return view('charts.bar');
    }


        public function getPieCharts(){

        return view('charts.pie');
    }

    public function barChartShow(Request $request){


    $input=$request->month;
    $date = "$request->month";
    $currentMonth=date("m", strtotime($date));


    $lostItems = LostFound::orderBy('idLostFound','desc')->whereRaw('MONTH(created_at)= ?',  [$currentMonth])->withTrashed()->get();


    $meetings = Meeting::orderBy('idMeeting','desc')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->withTrashed()->get();
    
    $visitors = Visitor::orderBy('idVisitor','desc')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->withTrashed()->get();
    
    $deliveries = Deliver::orderBy('idDeliver','desc')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->withTrashed()->get();
    
    $drops = Drop::orderBy('idDrop','desc')->whereRaw('MONTH(created_at) = ?',[$currentMonth])->withTrashed()->get();
    
    $users = User::orderBy('idUser','desc');

    if ($request->idchart==1) {
        
    return view('charts.bar', compact('drops','visitors','deliveries','meetings','lostItems', 'users', 'input'));
    }
    elseif ($request->idchart==2) {
       
    return view('charts.pie', compact('drops','visitors','deliveries','meetings','lostItems', 'users', 'input'));
    }


    }

    public function getTables(){
    
   
    return view('tables.table');

    }

    public function getDropsTable(){
    
    $drops = Drop::orderBy('idDrop','desc')->withTrashed()->paginate(10);

    return view('tables.drops', compact('drops'));

    }

    public function getDeliversTable(){
    
    $delivers = Deliver::orderBy('idDeliver','desc')->withTrashed()->paginate(10);
    
    return view('tables.delivers', compact('delivers'));

    }

    public function getLostItemsTable(){
    
    $losts = LostFound::orderBy('idLostFound','desc')->withTrashed()->paginate();
    
    return view('tables.lostItems', compact('losts'));

    }

     public function getMeetingsTable(){
     $user= User::all()->load('meetingHost');
     $meetings = Meeting::orderBy('idMeeting','desc')->withTrashed()->paginate();
    
    return view('tables.meetings', compact('meetings', 'user'));

    }
}

