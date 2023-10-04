<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function update(Request $request)
    {
        if ($request->model == 'santri') {
            $model = Santri::findOrFail($request->id);
            $model->setStatus($request->status);
            $model->save();
            flash()->addSuccess('Status berhasil diubah');
            return back();
        }
    }
}
