<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Session;
use Auth;
use Redirect;

class LoginController extends Controller
{
      /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
      */

      use AuthenticatesUsers;


      /**
       * Where to redirect users after login.
       *
       * @var string
       */
      protected $redirectTo = '/';
      

      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
        $this->middleware('guest')->except('logout');
      }

      protected function validator(array $data)
      {
        return Validator::make($data, [
          'username' => 'required|max:255',
          'email' => 'required|email|max:255|unique:users'
          ]);
      }

      public function username()
      {
        return 'username';
      }



      //LOgin Function with UserName and Email

      public function login(Request $request){

       $match=['email' => $request->email, 'username'=>$request->username];


       $loguser= User::where($match) -> first();

       if(empty($loguser))  {

        Session::flash('danger', 'Incorrect user, please insert the correct username and email!');

       return redirect()->back();

      }

      else{

        Auth::loginUsingId($loguser->idUser);
        Session::flash('success', 'The login was successfull!');
        return Redirect::to('/');
      }
      
    }

    //Logout Function for our users
    
    public function logout(){
  ;
      if (!(Auth::logout())) {

       Session::flash('success', 'The logout was successfull!');


      return Redirect::to('/');
      }else{

         Session::flash('danger', 'The logout was unsuccessfull!');


      return redirect()->back();

      }


    }


  }
