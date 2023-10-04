<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pembayaran;
use App\Models\Pembayaran as Model;
use Illuminate\Http\Request;
use App\Http\Requests\StorePembayaranRequest;
use App\Http\Requests\UpdatePembayaranRequest;
use App\Notifications\PembayaranKonfirmasiNotification;
use App\Notifications\PembayaranNotification;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = Model::latest();
        if ($request->filled('biaya_id')) {
            $models = $models->where('biaya_id', $request->biaya_id);
        }
        if ($request->filled('bulan')) {
            $models = $models->whereMonth('tanggal_bayar', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $models = $models->whereYear('tanggal_bayar', $request->tahun);
        }

        if ($request->filled('status')) {
            if ($request->status == 'sudah-konfirmasi') {
                $models = $models->whereNotNull('tanggal_konfirmasi');
            }
            if ($request->status == 'belum-konfirmasi') {
                $models = $models->whereNull('tanggal_konfirmasi');
            }
        }

        if ($request->filled('q')) {
            $models = $models->whereHas('tagihan', function ($q) {
                $q->whereHas('santri', function ($q) {
                    $q->where('nama', 'like', '%' . request('q') . '%');
                });
            });
        }

        $data['models'] = $models->orderBy('tanggal_konfirmasi', 'desc')->paginate(settings()->get('app_pagination', '50'));
        return view('operator.pembayaran_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePembayaranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePembayaranRequest $request)
    {
        $requestData = $request->validated();
        $requestData['tanggal_konfirmasi'] = now();
        $requestData['metode_pembayaran'] = 'manual';
        $tagihan = Tagihan::findOrFail($requestData['tagihan_id']);
        $requestData['wali_id'] = $tagihan->santri->wali_id ?? 0;
        //simpan pembayaran
        $pembayaran = Pembayaran::create($requestData);
        //kirim notifikasi pembayaran
        $wali = $pembayaran->wali;
        if ($wali != null) {
            $wali->notify(new PembayaranKonfirmasiNotification($pembayaran));
        }
        flash('Pembayaran berhasil dan sudah otomatis terkonfirmasi.')->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function show(Pembayaran $pembayaran)
    {
        auth()->user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();
        return view('operator.pembayaran_show', [
            'model' => $pembayaran,
            'route' => ['pembayaran.update', $pembayaran->id]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Pembayaran $pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePembayaranRequest  $request
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pembayaran $pembayaran)
    {
        //$pembayaran->status_konfirmasi = 'sudah';
        $wali = $pembayaran->wali;
        $wali->notify(new PembayaranKonfirmasiNotification($pembayaran));
        $pembayaran->tanggal_konfirmasi = now();
        $pembayaran->user_id = auth()->user()->id;
        $pembayaran->save();
        flash('Data pembayaran berhasil dikonfirmasi')->success();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pembayaran  $pembayaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        flash('Data berhasil dihapus')->success();
        return back();
    }
}
