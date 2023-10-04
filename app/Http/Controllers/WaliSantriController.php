<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaliSantriController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'wali_id' => 'required|exists:users,id',
            'santri_id' => 'required'
        ]);
        $santri = \App\Models\Santri::find($request->santri_id);
        $santri->wali_id = $request->wali_id;
        $santri->wali_status = 'ok';
        $santri->save();
        flash('Santri berhasil ditambahkan')->success();
        return back();
    }

    public function update(Request $request, $id)
    {
        $santri = \App\Models\Santri::findOrFail($id);
        $santri->wali_id = null;
        $santri->wali_status = null;
        $santri->save();
        flash('Santri berhasil dihapus')->success();
        return back();
    }
}
