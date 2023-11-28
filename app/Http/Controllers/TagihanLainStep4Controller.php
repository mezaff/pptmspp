<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessTagihanLainStore;
use App\Models\Biaya;
use App\Models\Santri;
use Illuminate\Http\Request;

class TagihanLainStep4Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $biaya = Biaya::find(session('biaya_id'));
        if (session('tagihan_untuk') == 'semua') {
            $santriId = Santri::all()->pluck('id');
        } else if (session('tagihan_untuk') == 'pilihan') {
            $santriId = session('data_santri')->pluck('id');
        } else {
            flash('Tidak ada data santri yang akan ditagih')->success();
            return back();
        }
        $tanggalTagihan = $request->tanggal_tagihan;
        $tanggalJatuhTempo = $request->tanggal_jatuh_tempo;
        $requestData['biaya_id'] = $biaya->id;
        $requestData['santri_id'] = $santriId;
        $requestData['tanggal_tagihan'] = $tanggalTagihan;
        $requestData['tanggal_jatuh_tempo'] = $tanggalJatuhTempo;
        $process = new ProcessTagihanLainStore($requestData);
        $process->handle();
        // $this->dispatch($process);
        flash('Tagihan berhasil dibuat')->success();
        return redirect()->route('jobstatus.index');
    }
}
