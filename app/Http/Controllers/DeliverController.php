<?php

namespace App\Http\Controllers;

//Requiring the Needed Services
use Illuminate\Http\Request;
use Auth;
use Session;
use Image;
use Carbon\Carbon;

//Requiring the Needed Models
use App\Http\Requests;
use App\Models\Deliver;
use App\Models\DeliverType;




class DeliverController extends Controller
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
        $delivers = Deliver::orderBy('idDeliver', 'desc')->paginate(10);
        return view('delivers.index')->withDelivers($delivers);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('delivers.create');
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //validate data
       $this->validate($request,[
                'driverName' => 'required|min:2|max:50|string',
                'driverID' => 'min:5|max:20|string',
                'vehicleLicensePlate' => 'required|min:1|max:40|string',

                
            ]);    
        

    
        //creating the models
      $deliver=new Deliver;

     

 
     $deliver->deDriverName=$request->driverName;

     $deliver->deDriverID=$request->driverID;
     
     $deliver->vehicleRegistry=$request->vehicleLicensePlate;
   
     $deliver->entryWeight=$request->weight;
     
     $deliver->deFirmSupplier=$request->firm;

     $deliver->deEntryTime=Carbon::now('Europe/Lisbon');
     
   
     $deliver->deIdUser=Auth::user()->idUser;


//Save Photos
     if ($request->hasFile('image')) {
      $image = $request->file('image');
      $filename = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('images/' . $filename);

      Image::make($image)->resize(800, 400)->save($location);

      $deliver->image = $filename;
  }
   
    //store data to delivers table and deliver type table

    $saveDeliver= $deliver->save();
    

    if ($saveDeliver) {

     Session::flash('success', 'The Deliver was created successfully!');
     return redirect()->route('deliveryType.createDeliveryType', $deliver->idDeliver);

    }else{

    Session::flash('danger', 'The Deliver was not created successfully!');

     return redirect()->route('delivers.create');

    }

 
    }



   
  
/**
     * Return the specified resource using JSON
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $deliver = Deliver::findOrFail($id);

        if (empty($deliver)) {
        
        Session::flash('danger','This object does not exist!');
        return redirect()->back();
        }else{

             return view('delivers.show')->withDeliver($deliver);


        }
       
    }



  

  /**
     * Display the specified resource.
     *
  
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCheckOut($id) 
    {
        
        
             $deliver= Deliver::findOrFail($id);



             $type=DeliverType::where('deliver_idDeliver', '=', $id)->first();

            
             return view('delivers.checkout', compact('deliver', 'type'));



        }



        public function checkoutUpdate(Request $request, $id){



        $deliver = Deliver::findOrFail($id);

   
      

        $exittime=$deliver->deExitTime;

        //Get value from the database and check if it's empty or not
        $exitweight=$deliver->exitWeight;

        //CHeck if the field is empty or not
        if (empty($exittime)) {

        $deliver->exitWeight=$request->exitweight;

      //Save it to the model/database
        $deliver->deExitTime=Carbon::now('Europe/Lisbon');     //GEt local Time

        $save=$deliver->save();
        
        if ($save) {
              // set flash data with success message
        Session::flash('success', 'The Check-out process was successfully done.');
           // redirect with flash data to delivers.show
         return view('delivers.show')->withDeliver($deliver);
        }
        else
            { 

             // set flash data with success message
        Session::flash('danger', 'The Check-out process not successfully saved.');
           // redirect with flash data to delivers.show
         return redirect()->route('delivers.index');
            }
        
                                                    }

         else{
         // set flash data with success message
        Session::flash('danger', 'The Check-out process was already done!');
           // redirect with flash data to delivers.show
         return redirect()->route('delivers.index');

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
         $iddeliver = $id;

        $deliver = Deliver::find($iddeliver);
   

        if ($deliver->delete()) {

          foreach ($deliver->type as $item) {
                $item->delete();
          }

      
        Session::flash('success','Deliver was successfully deleted');
        return redirect()->route('delivers.index');
        }else{

             Session::flash('danger','Deleted process failed!');
        return redirect()->route('delivers.index');
        }

        
        
         
    }

   
}
