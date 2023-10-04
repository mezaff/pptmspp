<?php

namespace App\Http\Controllers;

use Hash;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class WaliRegisterController extends Controller
{
    public function register()
    {
        return view('auth.register_sneat');
    }

    public function actionregister(Request $request)
    {
        $wali = User::create([
            'nama' => $request->name,
            'email' => $request->email,
            'nohp' => $request->nohp,
            'password' => Hash::make($request->password),
        ]);
    }
}
