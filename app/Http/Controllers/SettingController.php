<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function create()
    {
        return view('operator.setting_form');
    }

    public function store(Request $request)
    {
        $dataSettings = $request->except('_token');
        if ($request->hasFile('app_logo')) {
            $request->validate([
                'app_logo' => 'required|mimes:jpeg,png,jpg|max:5000'
            ]);
            $dataSettings['app_logo'] = $request->file('app_logo')->store('public/logo');
        }
        if ($request->hasFile('pj_ttd')) {
            $request->validate([
                'pj_ttd' => 'required|mimes:jpeg,png,jpg|max:5000'
            ]);
            $dataSettings['pj_ttd'] = $request->file('pj_ttd')->store('public/ttd');
        }
        settings()->set($dataSettings);
        flash('Pengaturan berhasil diubah')->success();
        return back();
    }
}
