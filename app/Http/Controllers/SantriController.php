<?php

namespace App\Http\Controllers;

use App\Charts\SantriKelasChart;
use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use \App\Models\Santri as Model;
use App\Http\Requests\StoreSantriRequest;
use App\Http\Requests\UpdateSantriRequest;
use App\Models\Biaya;

class SantriController extends Controller
{
    private $viewIndex = 'santri_index';
    private $viewCreate = 'santri_form';
    private $viewEdit = 'santri_form';
    private $viewٍShow = 'santri_show';
    private $routePrefix = 'santri';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = Model::with('wali', 'user')->latest();
        if ($request->filled('q')) {
            $models = $models->search($request->q);
        }

        if ($request->wantsJson()) {
            return response()->json($models->get(), 200);
        }

        return view('operator.' . $this->viewIndex, [
            'models' => $models->paginate(settings()->get('app_pagination', '50')),
            'routePrefix' => $this->routePrefix,
            'title' => 'DATA SANTRI',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'listBiaya' => Biaya::has('children')->whereNull('parent_id')->pluck('nama', 'id'),
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'FORM DATA SANTRI',
            'wali' => User::where('akses', 'wali')->pluck('name', 'id')
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSantriRequest $request)
    {
        $requestData = $request->validated();
        if ($request->filled('wali_id')) {
            $requestData['wali_status'] = 'ok';
        }
        Model::create($requestData);
        flash('Data berhasil disimpan')->success();
        return redirect()->route('santri.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('operator.' . $this->viewٍShow, [
            'model' => Model::findOrFail($id),
            'title' => 'DATA SANTRI'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'listBiaya' => Biaya::has('children')->whereNull('parent_id')->pluck('nama', 'id'),
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'FORM DATA SANTRI',
            'wali' => User::where('akses', 'wali')->pluck('name', 'id')
        ];
        return view('operator.' . $this->viewEdit, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSantriRequest $request, $id)
    {
        $requestData = $request->validated();
        $model = Model::findOrFail($id);
        if ($request->filled('wali_id')) {
            $requestData['wali_status'] = 'ok';
        }
        $model->fill($requestData);
        $model->save();
        flash('Data berhasil diubah')->success();
        return redirect()->route('santri.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $santri = Model::findOrFail($id);
        if ($santri->tagihan->count() >= 1) {
            Flash('Data tidak bisa dihapus karena masih memiliki relasi data tagihan')->error();
            return back();
        }
        $santri->delete($id);
        flash('Data berhasil dihapus')->success();
        return back();
    }
}
