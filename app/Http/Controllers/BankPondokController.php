<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\BankPondok as Model;
use App\Http\Requests\StoreBankPondokRequest;
use App\Http\Requests\UpdateBankPondokRequest;

class BankPondokController extends Controller
{
    private $viewIndex = 'bankpondok_index';
    private $viewCreate = 'bankpondok_form';
    private $viewEdit = 'bankpondok_form';
    private $viewٍShow = 'bankpondok_show';
    private $routePrefix = 'bankpondok';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->filled('q')) {
            $models = Model::with('user')->search($request->q)->paginate(settings()->get('app_pagination', '50'));
        } else {
            $models = Model::with('user')->latest()->paginate(settings()->get('app_pagination', '50'));
        }
        return view('operator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'DATA REKENING PONDOK'
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
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SIMPAN',
            'title' => 'FORM DATA REKENING',
            'listBank' => \App\Models\Bank::pluck('nama_bank', 'id')
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBankPondokRequest $request)
    {
        $requestData = $request->validated();
        $bank = \App\Models\Bank::find($request['bank_id']);
        unset($requestData['bank_id']);
        $requestData['kode'] = $bank->sandi_bank;
        $requestData['nama_bank'] = $bank->nama_bank;
        Model::create($requestData);
        flash('Data berhasil disimpan');
        return redirect()->route('bankpondok.index');
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
            'button' => 'UPDATE',
            'title' => 'FORM DATA BIAYA',
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
    public function update(UpdateBankPondokRequest $request, $id)
    {
        $model = Model::findOrFail($id);
        $model->fill($request->validated());
        $model->save();
        flash('Data berhasil diubah');
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
        $model->delete($id);
        Flash('Data berhasil dihapus');
        return back();
    }
}
