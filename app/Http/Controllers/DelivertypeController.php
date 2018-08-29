<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

use App\Models\Deliver;
use App\Models\DeliverType;

class DelivertypeController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
  
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createDeliveryType($id)
    {


        $deliver=Deliver::findOrFail($id);


        //Return the creating view with the necessary form
        return view('deliveryType.create', compact('deliver'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

         //validate data
       $this->validate($request,[
                'cargo' => 'required|string',
                'quantity' => 'required',
                'danger' => 'required',
              

                
            ]); 


      $deliver= Deliver::findOrFail($request->idDeliver);

      $type=new DeliverType;

      $type->dangerousGood=$request->danger;

      $type->quantity=$request->quantity;

      $type->sensitiveLevel=$request->sensitivity;

      $type->materialDetails=$request->cargo;



      $saveDeliverType=$deliver->type()->save($type);

      if ($saveDeliverType) {

     Session::flash('success', 'The Deliver was created successfully!');

     return redirect()->route('delivers.show', $deliver->idDeliver);

    }else{

    Session::flash('danger', 'The Deliver was not created successfully!');

     return redirect()->route('deliveryType.createDeliveryType', $deliver->idDeliver);

    }
    }

   

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $item= DeliverType::findOrFail($id);

        return view('deliveryType.edit', compact( 'item') ) ;   

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $item=DeliverType::findOrFail($id);
        $deliver=Deliver::where('idDeliver', '=',$item->deliver_idDeliver)->firstOrFail();

        $item->quantity=$request->quantity;
        $item->sensitiveLevel=$request->sensitivity;
        $item->dangerousGood=$request->danger;

        $item->materialDetails=$request->cargo;


        if($item->deliver()->associate($deliver)){

            if ($item->save()) {
              
                Session::flash('success', 'Deliver item successfully edited!');

              return redirect()->route('delivers.show', $item->deliver_idDeliver);
            }
            Session::flash('danger', 'Deliver item was not successfully edited!');
            return redirect()->back();
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
        $item=DeliverType::findOrFail($id);


        if ($item->delete()) {
            Session::flash('success', 'The deliver item was successfully deleted!');
            return redirect()->route('delivers.show', $item->deliver_idDeliver);
        }
        else{

              Session::flash('danger', 'Deliver item was not successfully deleted!');
            return redirect()->back();
        }
    }
}
