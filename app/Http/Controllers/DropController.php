<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Drop;
use App\Models\DropItem;
use Auth;
use Session;

use Carbon\Carbon;


class DropController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index()
    {
        $drops = Drop::orderBy('idDrop', 'desc')->paginate(10);
        return view('drops.index')->withDrops($drops);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('drops.create');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            
                'dropperName' => 'required|min:1|max:50|string',
                'ReceiverName' => 'required|min:1|max:50|string',
                'dropImportance' => 'required',
                'dropDescription' => 'required|min:2|max:255'
            ]);    
        $drop = new Drop();
    
               $drop->dropperCompanyName=$request->dropperCompany;

        $drop->dropperName=$request->dropperName;

        $drop->droppedWhen=Carbon::now('Europe/Lisbon');

        $drop->dropReceiver=$request->ReceiverName;

        $drop->dropSize=$request->dropSize;

        $drop->dropImportance=$request->dropImportance;
        
        $drop->dropDescr=$request->dropDescription;
        
         //Associate relationship to insert the foreign key of the user that create the new entity.
         Auth::user()->drops()->save($drop);

        if($drop->save())
        {
            Session::flash('success','Drop was successfully created');
            return redirect()->route('drops.index');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkout($id)
    {
        
        $drop = Drop::find($id);
        
        return view('drops.checkOut')->withDrop($drop);
    }
    //    /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $idDrop=$id;
    //     $drop = Drop::find($idDrop);
    //     return view('drops.edit')->withDrop($drop);
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idDrop=$id;
        $drop = Drop::find($idDrop);

        if(empty($drop))
        {
        Session::flash('danger','This object does not exist!');
        return redirect()->back();

        }
        return view('drops.show')->withDrop($drop);
    
    }


    //  /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function updateEdit(Request $request, $id)
    // {
    //     $idDrop=$id;
    //     $drop = Drop::find($idDrop);
        
    //     $drop->dropperCompanyName=$request->dropperCompany;
    //     $drop->dropperName=$request->dropperName;
    //     $drop->dropReceiver=$request->ReceiverName;
    //     $drop->dropSize=$request->dropSize;
    //     $drop->dropImportance=$request->dropImportance;
    //     $drop->dropDescr=$request->dropDescription;
    //     $drop->dropidUser=Auth::user()->idUser;

    //     if($drop->save())
    //     {
    //         Session::flash('success','Drop was successfully edited');
    //         return redirect()->route('drops.show',$drop->idDrop);
            

    //     }
        
    // }

    /**
     * Update the specified resource in storage.
     *
     
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCheckOut($id)
    {
        
        $drop = Drop::find($id);
        
        if (empty($drop->dropReceivedDate)) {
            $drop->dropReceivedDate=Carbon::now('Europe/Lisbon');

       if ($drop->save()) {
        Session::flash('success','Checkout was successfully done');
        return redirect()->route('drops.index');
        }else{
            Session::flash('danger','Checkout was not successfully done');
        return redirect()->route('drops.index');
        } 

      
        }else{

        Session::flash('danger','Checkout was already done!');
        return redirect()->route('drops.index');
        }


        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idDrop = $id;

        $drop = Drop::find($idDrop);
        if ($drop->delete()) {
            
          Session::flash('success','Drop was successfully deleted');
        return redirect()->route('drops.index');
        
        }
        else{
        
         Session::flash('danger','Drop was already deleted');
        return redirect()->route('drops.index');

        }

     
        //
    }

}
