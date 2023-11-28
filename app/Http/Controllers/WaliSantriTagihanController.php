<?php

namespace App\Http\Controllers;

use App\Models\BankPondok;
use App\Models\Tagihan;
use Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaliSantriTagihanController extends Controller
{
    public function index()
    {
        $tagihan = Tagihan::waliSantri()->latest();
        if (request()->filled('q')) {
            $tagihan = $tagihan->search(request('q'));
        }
        $data['tagihan'] = $tagihan->get();
        return view('wali.tagihan_index', $data);
    }

    public function show($id)
    {
        auth()->user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();
        $tagihan = Tagihan::waliSantri()->findOrFail($id);
        if ($tagihan->status == 'lunas') {
            $pembayaranId = $tagihan->pembayaran->last()->id;
            return redirect()->route('wali.pembayaran.show', $pembayaranId);
        }

        $data['bankPondok'] = BankPondok::all();
        $data['tagihan'] = $tagihan;
        $data['santri'] = $tagihan->santri;
        return view('wali.tagihan_show', $data);
    }
}
