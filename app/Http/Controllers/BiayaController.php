<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBiayaRequest;
use App\Http\Requests\UpdateBiayaRequest;
use Illuminate\Http\Request;
use \App\Models\Biaya as Model;
use App\Models\Biaya;

class BiayaController extends Controller
{
    private $viewIndex = 'biaya_index';
    private $viewCreate = 'biaya_form';
    private $viewEdit = 'biaya_form';
    private $viewٍShow = 'biaya_show';
    private $routePrefix = 'biaya';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('q')) {
            $models = Model::with('user')->whereNull('parent_id')->search($request->q)->paginate(settings()->get('app_pagination', '50'));
        } else {
            $models = Model::with('user')->whereNull('parent_id')->latest()->paginate(settings()->get('app_pagination', '50'));
        }
        return view('operator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'DATA BIAYA SPP'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $biaya = new Model();
        if ($request->filled('parent_id')) {
            $biaya = Model::findOrFail($request->parent_id);
        }
        $data = [
            'parentData' => $biaya,
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'TAMBAH',
            'title' => 'FORM TAMBAH BIAYA',
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBiayaRequest $request)
    {
        Model::create($request->validated());
        flash('Biaya berhasil ditambahkan')->success();
        return redirect()->route('biaya.index');
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
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UBAH',
            'title' => 'FORM UBAH BIAYA',
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
    public function update(UpdateBiayaRequest $request, $id)
    {
        $model = Model::findOrFail($id);
        $model->fill($request->validated());
        $model->save();
        flash('Biaya berhasil diubah')->success();
        return redirect()->route('biaya.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Model::findOrFail($id);
        //validasi ke children
        if ($model->children->count() >= 1) {
            flash('Biaya tidak bisa dihapus karena masih memiliki item biaya. Hapus item biaya terlebih dahulu')->error();
            return back();
        }
        //validasi relasi ke data santri
        if ($model->santri->count() >= 1) {
            flash('Biaya tidak bisa dihapus karena masih memiliki item biaya')->error();
            return back();
        }

        $model->delete($id);
        Flash('Biaya berhasil dihapus')->success();
        return back();
    }

    public function deleteItem($id)
    {
        $model = Model::findOrFail($id);
        if ($model->parent->santri->count() >= 1) {
            flash('Biaya gagal dihapus karena masih berkaitan dengan data lain')->error();
            return back();
        }
        $model->delete($id);
        Flash('Biaya berhasil dihapus')->success();
        return back();
    }
}
