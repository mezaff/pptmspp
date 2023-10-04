<?php

namespace App\Http\Controllers;

use App\Imports\SantriImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SantriImportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'template' => 'required|mimes:xlsx,xls'
        ]);
        Excel::import(new SantriImport, $request->file('template')->store('temp'));
        return back();
    }
}
