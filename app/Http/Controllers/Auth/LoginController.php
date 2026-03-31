<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use Auth;
use Redirect;

class LoginController extends Controller
{
    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = [
            'email'    => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->has('remember'))) {
            Session::flash('success', 'Login successful!');
            return redirect()->intended('/');
        }

        Session::flash('danger', 'Incorrect email or password.');
        return redirect()->back()->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('success', 'Logout successful!');
        return Redirect::to('/auth/login');
    }
}
