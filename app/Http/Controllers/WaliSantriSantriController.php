<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaliSantriSantriController extends Controller
{
    public function index()
    {
        $data['models'] = Auth::user()->santri;
        return view('wali.santri_index', $data);
    }

    public function show($id)
    {
        $data['title'] = "Detail Data Santri";
        $data['model'] = \App\Models\Santri::with('biaya', 'biaya.children')
            ->where('id', $id)
            ->where('wali_id', Auth::user()->id)
            ->firstOrFail();
        return view('wali.santri_show', $data);
    }
}
