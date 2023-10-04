<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Tagihan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class KartuSppController extends Controller
{
    public function index(Request $request)
    {
        $santri = Santri::with('tagihan')->whereHas('tagihan', function ($q) {
            $q->where('jenis', 'spp');
        })->where('id', $request->santri_id);

        if (Auth::user()->akses == 'wali') {
            $santri = $santri->where('wali_id', Auth::id());
        }
        $santri = $santri->firstOrFail();

        $tahun = $request->tahun;
        $arrayData = [];
        foreach (bulanSPP() as $bulan) {
            //jika bulan = 1 maka tahun + 1
            if ($bulan == 1) {
                $tahun = $tahun + 1;
            }
            //cari tagihan tagihan berdasarkan santri, tahun dan bulan
            $tagihan = $santri->tagihan->filter(function ($value) use ($bulan, $tahun) {
                return $value->tanggal_tagihan->year == $tahun && $value->tanggal_tagihan->month == $bulan;
            })->first();

            $tanggalBayar = '';
            //jika tagihan tidak kosong dan status tidak baru, berarti sudah bayar, ambil tanggal bayar
            if ($tagihan != null && $tagihan->status != 'baru') {
                $tanggalBayar = $tagihan->pembayaran->first()->tanggal_bayar->format('d-m-y');
            }

            $arrayData[] = [
                'bulan' => ubahNamaBulan($bulan),
                'tahun' => $tahun,
                'total_tagihan' => $tagihan->total_tagihan ?? 0,
                'status_tagihan' => ($tagihan == null) ? 'Belum Bayar' :  $tagihan->status,
                'tanggal_bayar' => $tanggalBayar
            ];
        }

        if (request('output') == 'pdf') {
            $pdf = Pdf::loadView('kartuspp_index', [
                'kartuSpp' => collect($arrayData),
                'santri' => $santri
            ]);
            $namaFile = "Kartu SPP " . $santri->nama . ' Tahun ' . $request->tahun . '.pdf';
            return $pdf->download($namaFile);
        }
        return view('kartuspp_index', [
            'kartuSpp' => collect($arrayData),
            'santri' => $santri
        ]);
    }
}
