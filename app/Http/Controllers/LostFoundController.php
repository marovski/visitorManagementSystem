<?php

namespace App\Http\Controllers;

//Requiring the Needed Services
use Illuminate\Http\Request;
use Auth;
use Session;
use Image;
use Carbon\Carbon;


use App\Models\LostFound;

class LostFoundController extends Controller
{

    
    public function __construct() {
        $this->middleware('auth', ['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $losts = LostFound::orderBy('idLostFound', 'desc')->paginate(10);
        return view('losts.index')->withLosts($losts);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('losts.create');
        //calling the view
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
                'finderName' => 'required|min:1|max:50|string',
                'finderPhone' => 'min:1|max:25!string',
                'itemCategory' => 'required',
                'lostFoundDescription' => 'required|min:1|max:255',
                
            ]);
        $lost = new LostFound();

        $lost->foundDate=Carbon::now('Europe/Lisbon');
        $lost->finderName=$request->finderName;
        $lost->finderPhone=$request->finderPhone;

        $lost->itemSize=$request->lostFoundItemSize;
        $lost->itemCategory=$request->itemCategory;
        $lost->itemImportance=$request->lostFoundImportance;
        $lost->itemDescription=$request->lostFoundDescription;
        

        //Save Photos
     if ($request->hasFile('image')) {
      $image = $request->file('image');
      $filename = time() . '.' . $image->getClientOriginalExtension();
      $location = public_path('images/' . $filename);

      Image::make($image)->resize(600, 300)->save($location);

      $lost->photo = $filename;
  }
       
        
        //Associate relationship to insert the foreign key of the user that create the new entity.
         Auth::user()->losts()->save($lost);

        if($lost->save())
        {   
            
            Session::flash('success','Lost and Found report was successfully registed!');
            return redirect()->route('losts.index');

        }
        else{
         
             Session::flash('danger', 'The registration failed!');
            return redirect()->route('losts.index');
        }
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function checkout($id)
    {
        $idLostFound=$id;
        $lost = LostFound::find($idLostFound);

         return view('losts.checkout')->withLost($lost);
       
        //
    }

    // *
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\LostFound  $lostFound
    //  * @return \Illuminate\Http\Response
     
    // public function edit(LostFound $lostFound)
    // {
    //     //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idLostFound=$id;
        $lost = lostFound::find($idLostFound);

        if (empty($lost)) {
                
        Session::flash('danger','This object does not exist!');
        return redirect()->back();
     
      
        }else{

        return view('losts.show')->withLost($lost);          
        }
      
    }

    /**
     * Update the checkout of the lost item resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCheckOut(Request $request, $id)
    {
        $idLostFound=$id;
        $lost = LostFound::find($idLostFound);     
        
          $this->validate($request,[
                'receiverName' => 'required|min:1|max:50|string',
                'receiverPhone' => 'min:1|max:25!string',
               
                
            ]);

//CHeck if claimed date is empty

         if(!empty($lost->claimedDate))
        {   
            
            Session::flash('danger','Lost and Found item was already claimed!');
            return redirect()->route('losts.index');
            
        }
        else{

            if ($request->receiverName==$lost->finderName || $request->receiverPhone==$lost->finderPhone) {

                 Session::flash('danger','The receiver might be the same as the finder!Security issues!');
                 return redirect()->route('losts.index');
            }
            else{



                    //Getting the new input values for the receiver
            $lost->receiverName=$request->receiverName;
            $lost->receiverPhone=$request->receiverPhone;
         
         //Getting the local time
             $lost->claimedDate=Carbon::now('Europe/Lisbon');


             //Save the model with the new values in the database
            if ($lost->save()) {

            
            Session::flash('success','Lost item was successfully claimed!');
            return redirect()->route('losts.index');
        }else{


          
             Session::flash('danger', 'The claiming process failed!');
            return redirect()->route('losts.index');
        }
            }
        
        }
        
       


           
        

       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LostFound  $lostFound
     * @return \Illuminate\Http\Response
     */
   

        public function destroy($id)
    {
        $idLostFound = $id;

    
        if ($lost = LostFound::find($idLostFound)) {
             $delete=$lost->delete();

      
        if ($delete) {
             Session::flash('success','Lost object report was successfully deleted');
        return redirect()->route('losts.index');
        }else{

             Session::flash('danger','Deleted process failed!');
        return redirect()->route('losts.index');
        }
        
        }
        else{
             Session::flash('danger','Lost object report was already deleted');
        return redirect()->route('losts.index');

        }

     
        //
    }

}
