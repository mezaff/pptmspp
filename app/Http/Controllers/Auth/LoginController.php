<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function loginUrl(Request $request)
    {
        if (!$request->hasValidSignature()) {
            abort(401);
        }
        $user = Auth::loginUsingId($request->user_id);
        return redirect($request->url);
    }

    public function showLoginForm()
    {
        return view('auth.login_sneat');
    }

    public function showLoginFormWali()
    {
        return view('auth.login_sneat_wali');
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->akses == 'operator' || $user->akses == 'admin') {
            activity()->causedBy(Auth::user())
                ->event('login')
                ->log('user operator ' . auth()->user()->name . ' melakukan login');
            return redirect()->route('operator.beranda');
        } elseif ($user->akses == 'wali') {
            activity()->causedBy(Auth::user())
                ->event('login')
                ->log('user wali ' . auth()->user()->name . ' melakukan login');
            return redirect()->route('wali.beranda');
        } else {
            Auth::logout();
            flash('Anda tidak memiliki hak akses')->error();
            return redirect()->route('login');
        }
    }

    protected function loginApi(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($loginData)) {
            $token = Auth::user()->createToken('authToken')->plainTextToken;
            return response()->json(['data' => Auth::user(), 'token' => $token], 200);
        }
        return response()->json(['messages' => 'Invalid credentials', 401]);
    }
}
