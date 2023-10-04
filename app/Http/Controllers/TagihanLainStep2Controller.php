<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class TagihanLainStep2Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ($request->action == 'delete') {
            $santriSession = session('data_santri');
            $santriData = $santriSession->reject(function ($value) use ($request) {
                return $value->id == $request->id;
            });
            session(['data_santri' => $santriData]);
            flash()->addSuccess('Data sudah dihapus dari daftar pilihan');
            return back();
        }
        if ($request->action == 'deleteall') {
            session()->forget('data_santri');
            flash()->addSuccess('Data berhasil dihapus dari daftar pilihan');
            return back();
        }

        $santriIdArray = $request->santri_id;
        $santri = Santri::whereIn('id', $santriIdArray)->get();
        session(['data_santri' => $santri]);
        return back();
    }
}
