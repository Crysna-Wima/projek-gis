<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index(Request $request)
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
            // Hide 'g-recaptcha-response' => 'recaptcha',
        ]);

        $credentials                  = $request->all('username', 'password');
        $emailCredentials['email']    = $request['username'];
        $emailCredentials['password'] = $request['password'];
        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        } elseif (Auth::attempt($emailCredentials)) {   
            return redirect('/dashboard');
        }else{
            $response=[
                'username' => [trans("username salah")],
                'password' => [trans("password salah")],
            ];
            return redirect('/login')->withErrors($response);
        }
    }

    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/login');   
    }
}
