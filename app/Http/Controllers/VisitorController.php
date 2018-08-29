<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meeting;
use App\Models\Visitor;
use App\Models\User;
use App\Http\Requests;
use Auth;
use Carbon\Carbon;
use Session;
use Mail;
use App\Mail\NewMeetingNotification;

class VisitorController extends Controller
{

     public function __construct() {
        $this->middleware('auth',['except' => ['selfcheckIn', 'show','selfSign']]);
    }
    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    //   public function index()
    // {
    //     // $visitors = Visitor::orderBy('idVisitor', 'desc')->paginate(10);
    //     // return view('visitors.create')->withVisitors($visitors);
    // }



       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $externalVisitor = Visitor::findOrFail($id);
        $user= User::all()->load('meetingHost');    

        return view('externalVisitors.show', compact('externalVisitor') ) ;  
        
    }

       /**
     * Show the form for creating a new externalvisitor.
     *
     * @return \Illuminate\Http\Response
     */
    public function createExternalVisitor($id)
    {
        $meeting = Meeting::findOrFail($id);

        //Get the end date of the meeting

        $meetingDate=date("Y/m/d", strtotime($meeting->meetEndDate));
   
      
        if (!($meetingDate >= date('Y/m/d')) ) {
            # code...
            

            Session::flash('danger', 'The meeting has ended! Cannot add visitor to this meeting');
            return redirect()->route('meetings.show', $id);
        }
        else{
             return view('externalVisitors.create', compact('meeting'));
        }
       


        
        } 

    /**
     * Show the form for creating to add a new internal visitor.
     *
     * @return \Illuminate\Http\Response
     */
    public function addInternalVisitor($id)
    {    
       

        $users= User::where('fk_idSecurity', '!=', 3)->where('idUser', '!=', Auth::user()->idUser)->get();

        $meetingRestricted=Meeting::findOrFail($id);
        $meetingDate=date("Y/m/d", strtotime($meetingRestricted->meetEndDate));



          if (!($meetingDate >= date('Y/m/d')) ) {
            Session::flash('danger', 'The meeting has ended! Cannot add visitor to this meeting');
            return redirect()->route('meetings.show', $id);
        }else{


        return view('internalVisitors.create', compact( 'users', 'meetingRestricted'));

        }

        
        

        
        }  

        /**
     * Add the internal visitor to the meeting.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeInternalVisitor(Request $request)

    {  
        $this->validate($request,[
                'meeting' => 'required',
                'internalVisitor' => 'required',
            
            ]); 


         $user = User::find($request->internalVisitor);

        $meetingData = Meeting::find($request->meeting);

        $meetingDate=date("Y/m/d", strtotime($meetingData->meetEndDate));



          if (!($meetingDate >= date('Y/m/d')) ) {
            Session::flash('danger', 'The meeting has ended! Cannot add visitor to this meeting');
            return redirect()->route('meetings.show', $id);
        }else{



        if($user->meetings->contains($meetingData)){
    
        Session::flash('danger','This visitor could not be assigned. Duplicate entry!');
        return redirect()->back();


        }
        else{

         $save=$meetingData->user()->sync($user, false);

        if($save){

        if($meetingData->email=='1')
        {
           if(Mail::to($user->email)->send(new NewMeetingNotification($meetingData, $user))){
            Session::flash('success','The email was sent!');

           } else{
            Session::flash('danger','The email was not sent!');
           }
        }
            

           
            
        }
        Session::flash('success','The internal visitor was assigned to the meeting, with success!');

        return redirect()->route('meetings.show', $meetingData->idMeeting);

        }
                
}
       

        
        
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
                'visitorName' => 'required|min:1|max:50|string',
                'visitorEmail' => 'required|email|max:255',
            
            ]);  

         $currentM = Meeting::find($request->idMeeting);

          $meetingDate=date("Y/m/d", strtotime($currentM->meetEndDate));



          if (!($meetingDate >= date('Y/m/d')) ) {
            Session::flash('danger', 'The meeting has ended! Cannot add visitor to this meeting');
            return redirect()->route('meetings.show', $request->idMeeting);
        }else{

        if (empty(Visitor::where('visitorCitizenCard', '=', $request->visitorCitizenCard)->where('visitorCitizenCard', '!=', null)->first())) {
            # code...
            $visitors = new Visitor();
            $meet = Meeting::find($request->idMeeting);
    

        $visitors->visitorName=$request->visitorName;


        $visitors->visitorCitizenCard=$request->visitorCitizenCard;


        $visitors->visitorCitizenCardType=$request->visitorCitizenCardType;

        $visitors->visitorNPhone=$request->visitorNPhone;
        
        $visitors->visitorEmail=$request->visitorEmail;
        
        $visitors->visitorDangerousGood=$request->visitorDangerousGood;
        
        $visitors->wifiAcess=$request->wifiAccess;
        
        $visitors->visitorDeclaredGood=$request->visitorDeclaredGood;
        
        $visitors->escorted=$request->escorted;
        
        $visitors->visitorCompanyName=$request->visitorCompanyName;
        
       
       if (!($visitors->meeting->contains($meet))) {
            # code...
             $v=$visitors->save();

        if (!$v)
        {

     
        return redirect()->back()->with('danger', 'This Visitor could not be assigned. Duplicate entry!');

        } else {

            foreach ($meet->visitor as $visitor) {
              

              if ($visitor->visitorEmail==$visitors->visitorEmail) {
                  return redirect()->back()->with('danger', 'This Visitor could not be assigned. Duplicate entry for this meeting!');
              }

            }



        $save=$visitors->meeting()->sync($meet, false);

        if($save){

        if($meet->email=='1')
        {
            Mail::to($visitors->visitorEmail)->send(new NewMeetingNotification($meet, $visitors));


        }
            

       
         return redirect()->route('meetings.show', $meet->idMeeting)->with('success','External Visitor was successfully created');
        } 


         
           
             }

              }else{


            return redirect()->back()->with('danger', 'This Visitor could not be assigned.');

              }   
        }else{

             return redirect()->back()->with('danger', 'This Visitor is already assigned! No duplicate entries allowed!');


        }
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
        
        $externalVisitor = Visitor::findOrFail($id);

     



     if (!empty($externalVisitor->entryTime) ) {
            Session::flash('danger', 'Cannot edit this visitor after the check-in');
            return redirect()->route('meetings.show', $externalVisitor->meeting->first()->idMeeting);
        }else{

        return view('externalVisitors.edit', compact('externalVisitor') ) ;   
        }

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
         // Validate the data
        $visitor = Visitor::find($id);

    if (!empty($visitor->entryTime) ) {
            Session::flash('danger', 'Cannot edit this visitor after the check-in');
            return redirect()->route('meetings.show', $visitor->meeting->first()->idMeeting);
        }else{

        if (empty($request->visitorIDnumber)) {
         


        $visitor->visitorCitizenCard=$request->visitorIDnumber;


        $visitor->visitorCitizenCardType=$request->visitorIDType;
        $visitor->visitorNPhone=$request->visitorNPhone;
      
        $visitor->visitorDangerousGood=$request->visitorDangerousGood;
        $visitor->wifiAcess=$request->wifiAccess;
        $visitor->visitorDeclaredGood=$request->visitorDeclaredGood;
       
     
        
       
       if ($visitor->save()) {
            # code...

             Session::flash('success', 'This visitor information was updated!');
           return redirect()->route('meetings.show', $visitor->meeting->first()->idMeeting);

              }   
        else{

                Session::flash('danger', 'This Visitor is already assigned! No duplicate entries allowed!');
             return redirect()->route('meetings.show', $visitor->meeting->first()->idMeeting);


        }
        }elseif (empty(Visitor::where('visitorCitizenCard', '=', $request->visitorIDnumber)->first())) {
            # code...
        
        $visitor->visitorCitizenCard=$request->visitorIDnumber;


        $visitor->visitorCitizenCardType=$request->visitorIDType;
        
        $visitor->visitorNPhone=$request->visitorNPhone;
           
        $visitor->visitorDeclaredGood=$request->visitorDeclaredGood;

        $visitor->visitorDangerousGood=$request->visitorDangerousGood;
        
        $visitor->wifiAcess=$request->wifiAccess;
     
        
       
        
       
       if ($visitor->save()) {
            # code...

            Session::flash('success', 'This visitor information was updated!');
            return redirect()->route('meetings.show', $visitor->meeting->first()->idMeeting);

              }   
        else{


                Session::flash('danger', 'This Visitor is already assigned! No duplicate entries allowed!');
             return redirect()->route('meetings.show', $visitor->meeting->first()->idMeeting);


        }
         }else{


        $visitor->visitorCitizenCard=$request->visitorIDnumber;


        $visitor->visitorCitizenCardType=$request->visitorIDType;
        $visitor->visitorNPhone=$request->visitorNPhone;

        $visitor->visitorDangerousGood=$request->visitorDangerousGood;
        $visitor->wifiAcess=$request->wifiAccess;
        $visitor->visitorDeclaredGood=$request->visitorDeclaredGood;
        
       
        
       
       if ($visitor->save()) {
            # code...

            Session::flash('success', 'This visitor information was updated!');
            return redirect()->route('meetings.show', $visitor->meeting->first()->idMeeting);

              }   
        else{


                Session::flash('danger', 'This Visitor is already assigned! No duplicate entries allowed!');
             return redirect()->route('meetings.show', $visitor->meeting->first()->idMeeting);


        }

         }

      

    
     


        }
    

    }

  

         


    


  




      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function badge($id)
    {
        
        $externalVisitor = Visitor::findOrFail($id);

        $user= User::all()->load('meetingHost');    

        return view('externalVisitors.badge', compact('externalVisitor','user') ) ;  
        
    }




      public function  selfcheckIn (){

        return view('externalVisitors.selfCheckIn');



      }

       public function  selfSign (Request $request){

             $this->validate($request,[
                'visitorName' => 'required|min:1|max:50|string',
                'visitorEmail' => 'required|email|max:255',
                'visitorCompany' => 'required|string',
            
            ]); 


    $searchVisitor = Visitor::where('visitorEmail', '=', $request->visitorEmail)->where('visitorCompanyName','LIKE','%$request->visitorCompany%')->where('visitorName', 'LIKE', '%$request->visitorName%')->get();
    
    $searchMeeting = $searchVisitor->meeting()->get();

      if ((empty($searchVisitor)) && (empty($searchMeeting))) {


        Session::flash('danger','The visitor is invalid');

        return redirect()->back();

      }
      else{

        
        $visitor=Visitor::where('visitorEmail', '=', $request->visitorEmail)->where('visitorCompanyName', '=', $request->visitorCompany)->first();

        Session::flash('success', 'The visitor is valid!');
        
        return redirect()->route('visitors.show', $visitor->idVisitor);
      }

      }



    /**
    *   CheckIn the external visitor
    *   @param  int  $id
    *   @return \Illuminate\Http\Response

    */

     public function checkin($id){


        $currentVisitor= Visitor::findOrFail($id);


      
       if (empty($currentVisitor->entryTime)) {

           $currentVisitor->entryTime = Carbon::now('Europe/Lisbon');
          
           foreach ($currentVisitor->meeting as $meetings) {
               $meetings->meetStatus=2;
           }

        if ($currentVisitor->save()) {


        Session::flash('success','The visitor check-in was successfully done!');
        
        return redirect()->route('visitors.badge', $currentVisitor->idVisitor);
        
        }else{

        Session::flash('danger','The visitor check-in process found an error!');
        
        return redirect()->back();


        }



         }else{

        Session::flash('danger','The visitor check-in is already done! The meeting as already started!');
        
        return redirect()->back();

         }


    }


    /**
    *   CheckOut the external visitor
    *   @param  int  $id
    *   @return \Illuminate\Http\Response

    */

    public function checkout($id){
        
    

        $currentVisitor= Visitor::findOrFail($id);

         if (empty($currentVisitor->exitTime)) {
           $currentVisitor->exitTime = Carbon::now('Europe/Lisbon');
           $currentVisitor->signOutFlag=1;

         
            foreach ($currentVisitor->meeting as $meetings) {
               

                $meetings->meetStatus=4;

                $meetings->save();
            }
          



        if ($currentVisitor->save()) {


        Session::flash('success','The visitor check-out was successfully done! The meeting is finished!');
        
        return redirect()->back();
        
        }else{

        Session::flash('danger','The visitor check-out process found an error!');
        
        return redirect()->back();


        }



         }else{

        Session::flash('danger','The meeting check-out is already done! The meeting as ended!');
        
        return redirect()->back();

         }

        

    }


    /**
     * Remove the external visitor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
          $visitor = Visitor::find($id);

        if ($visitor->delete()) {

          
        Session::flash('success','This visitor was successfully deleted!');
        return redirect()->back();
        
        }
        else{

             Session::flash('danger','Visitor was already erased!');
        return redirect()->back();
        }


    }



        /**
     * Remove the internal visitor resource from meeting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function removeInternalV($id, $idM){

   


        if (($user= User::findOrFail($id))&&($meeting=Meeting::findOrFail($idM))) {

            $user->meetings()->detach($idM);

            return redirect()->back()->with('success','Successfully removed the internal visitor');

        }else{

            return redirect()->back()->with('danger', 'Failed to remove this internal visitor!');
        }

    }


    

}
