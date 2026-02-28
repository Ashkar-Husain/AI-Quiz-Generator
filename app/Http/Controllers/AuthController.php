<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AuthController extends Controller
{
    function signup_yourself()
    {
        return view('auth.signup');
    }

    //* Login Page
    function login_yourself()
    {
        return view('auth.login');
    }



    function signup_store(Request $request)
    {
        // 1. Validation
        $request->validate([
            'name'     => 'required|min:3',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        // ===== USER ID GENERATION LOGIC =====

        $lastUser = User::orderBy('id', 'desc')->first();

        if (!$lastUser) {
            $user_id = 'QZ1001';
        } else {
            // QZ1001 → 1001 nikalo
            $lastNumber = (int) substr($lastUser->user_id, 2);
            $user_id = 'QZ' . ($lastNumber + 1);
        }

        // 2. User Create
        $user = User::create([
            'branch_id' => 'Main Branch',
            'user_name' => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'user_id'   => $user_id
        ]);

        // 3. Auto Login (optional)
        // Auth::login($user);

        return redirect('/login')
            ->with('success', 'Account created! Please login.');
    }


    //* Login Credentials
    function login_store(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {

            $request->session()->regenerate();

            // ===== ROLE BASED REDIRECT =====

            if (Auth::user()->role == 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password',
        ]);
    }


    //* Logout
    function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    //* Forgot Password
    function forgot_password_form()
    {
        return view('auth.forgot-password');
    }

    // function forgot_password_send(Request $request)
    // {
    //     $request->validate([
    //         'email' => 'required|email'
    //     ]);

    //     $user = User::where('email', $request->email)->first();

    //     if (!$user) {
    //         return back()->withErrors([
    //             'email' => 'Email does not exist'
    //         ]);
    //     }

    //     //* For now just send simple mail
    //     Mail::raw('Password reset request received.', function ($message) use ($user) {
    //         $message->to($user->email)
    //             ->subject('Forgot Password');
    //     });

    //     return back()->with('status', 'Mail sent successfully');
    // }




    function forgot_password_send(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email does not exist'
            ]);
        }

        // 6 digit OTP
        $otp = rand(100000, 999999);

        // save otp with 5 min expiry
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        // send mail
        Mail::raw("Your OTP is: $otp (valid for 5 minutes)", function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Password Reset OTP');
        });

        return redirect()->route('verify.otp.form', ['email' => $user->email])
            ->with('status', 'OTP sent to your email');
    }

    //* Verify Otp
    function verify_otp_form()
    {
        return view('auth.verify-otp');
    }

    function verify_otp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'otp' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || $user->otp != $request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP']);
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->withErrors(['otp' => 'OTP Expired']);
        }

        // OTP correct → new password page
        return redirect()->route('reset.password.form', [
            'email' => $user->email
        ]);
    }

    //* Reset Password
    function reset_password_form()
    {
        return view('auth.reset-password');
    }

    function reset_password(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect('/login');
        }

        // Update password
        $user->password = Hash::make($request->password);

        // Clear OTP
        $user->otp = null;
        $user->otp_expires_at = null;

        $user->save();

        return redirect('/login')
            ->with('status', 'Password updated! Please login.');
    }



    //!-----------------end class
}
