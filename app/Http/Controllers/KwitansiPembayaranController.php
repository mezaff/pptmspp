<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class KwitansiPembayaranController extends Controller
{
    public function show($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $data['pembayaran'] = $pembayaran;
        $data['title'] = 'Kwitansi Pembayaran NO #' . $pembayaran->tagihan->id;
        if (request('output') == 'pdf') {
            $pdf = Pdf::loadView('kwitansi_pembayaran', $data);
            $namaFile = "Kwitansi Pembayaran SPP " . $pembayaran->tagihan->santri->nama . ' Bulan ' . $pembayaran->tagihan->tanggal_tagihan->translatedFormat('F') . '.pdf';
            return $pdf->download($namaFile);
        }
        return view('kwitansi_pembayaran', $data);
    }
}
