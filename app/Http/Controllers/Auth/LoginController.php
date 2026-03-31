<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
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
            'login'    => 'required|string',
            'password' => 'required|string',
        ]);

        $login    = $request->input('login');
        $password = $request->input('password');

        // Determine whether the user typed an email address or a username
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        // Find the user record
        $user = User::where($field, $login)->first();

        if ($user && $user->password && Hash::check($password, $user->password)) {
            Auth::login($user, $request->has('remember'));
            Session::flash('success', 'Login successful!');
            return redirect()->intended('/');
        }

        Session::flash('danger', 'Incorrect email/username or password.');
        return redirect()->back()->withInput($request->only('login'));
    }

    public function logout()
    {
        Auth::logout();
        Session::flash('success', 'Logout successful!');
        return Redirect::to('/auth/login');
    }
}
