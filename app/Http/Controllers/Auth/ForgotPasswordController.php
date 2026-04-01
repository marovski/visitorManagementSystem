<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request, ['email' => 'required|string']);

        // Accept email or username — resolve to the actual email address
        $input = $request->input('email');
        if (!filter_var($input, FILTER_VALIDATE_EMAIL)) {
            // Treat as username — look up the real email
            $user = \App\Models\User::where('username', $input)->first();
            if ($user && $user->email) {
                $input = $user->email;
            }
        }

        $response = Password::broker()->sendResetLink(['email' => $input]);

        if ($response === Password::RESET_LINK_SENT) {
            return back()->with('status', trans($response));
        }

        return back()->withErrors(['email' => trans($response)]);
    }
}
