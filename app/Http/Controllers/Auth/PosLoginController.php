<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PosLoginController extends Controller
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

    /**
     * Where to redirect user after login
     * 
     * @var String
     */
    protected $redirectTo = RouteServiceProvider::PosView;

    /**
     * Show pos view login
     * @return \Illuminate\Http\Response
     */
    public function showPosLogin(){
        return view('pos/auth/open');
    }

    /**
     * Handle an incoming authentication request.
     *  
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function posLogin(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $userCredentials = $request->only('username', 'password');

        // check user using auth function
        if (Auth::attempt($userCredentials)) {
            return redirect()->intended(RouteServiceProvider::PosView);
        }
        else {
            return back()->with('error', 'Whoops! invalid email or password.');
        }
    }

        /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function posDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('pos-login');
    }

}
