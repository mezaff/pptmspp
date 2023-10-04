<?php

namespace App\Http\Controllers;

use App\Charts\PembayaranStatusChart;
use App\Charts\SantriKelasChart;
use App\Charts\TagihanBulananChart;
use App\Charts\TagihanStatusChart;
use App\Models\Pembayaran;
use App\Models\Santri;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class BerandaOperatorController extends Controller
{
    public function index(
        TagihanBulananChart $tagihanBulananChart,
        TagihanStatusChart $tagihanStatusChart,
        PembayaranStatusChart $pembayaranStatusChart,
        SantriKelasChart $santriKelasChart
    ) {
        $tahun = date('Y');
        $bulan = date('m');
        $data['santri'] = Santri::count();
        $pembayaran = Pembayaran::whereYear('tanggal_bayar', $tahun)
            ->whereMonth('tanggal_bayar', $bulan)->get();

        $data['totalPembayaran'] = $pembayaran->sum('jumlah_dibayar');
        $data['totalSantriSudahBayar'] = $pembayaran->count();

        $tagihan = Tagihan::with('santri')->whereYear('tanggal_tagihan', $tahun)->whereMonth('tanggal_tagihan', $bulan)->get();
        $tagihanPerKelas = $tagihan->groupBy('santri.kelas')->sortKeys();

        $tagihanBelumBayar = $tagihan->where('status', '<>', 'lunas');
        $tagihanSudahBayar = $tagihan->where('lunas');

        $data['tagihanPerKelas'] = $tagihanPerKelas;
        $data['totalTagihan'] = $tagihan->count();
        $data['tagihanBelumBayar'] = $tagihanBelumBayar;
        $data['tagihanSudahBayar'] = $tagihanSudahBayar;

        $data['tahun'] = $tahun;
        $data['bulan'] = $bulan;
        $data['bulanTeks'] = ubahNamaBulan($bulan);
        $data['dataPembayaranBelumKonfirmasi'] = Pembayaran::whereNull('tanggal_konfirmasi')->get();

        $data['tagihanChart'] = $tagihanBulananChart->build([
            $tagihanBelumBayar->count(),
            $tagihanSudahBayar->count()
        ]);
        //chart tagihan berdasarkan status
        $labelTagihanStatusChart = ['lunas', 'angsur', 'baru'];
        $dataTagihanStatusChart = [
            $tagihan->where('status', 'lunas')->count(),
            $tagihan->where('status', 'angsur')->count(),
            $tagihan->where('status', 'baru')->count(),
        ];
        $data['tagihanStatusChart'] = $tagihanStatusChart->build($labelTagihanStatusChart, $dataTagihanStatusChart);

        //chart pembayaran berdasarkan status
        $labelPembayaranChart = ['Sudah Dikonfirmasi', 'Belum Dikonfirmasi'];
        $dataPembayaranChart = [
            $pembayaran->whereNotNull('tanggal_konfirmasi')->count(),
            $pembayaran->whereNull('tanggal_konfirmasi')->count(),
        ];
        $data['pembayaranStatusChart'] = $pembayaranStatusChart->build($labelPembayaranChart, $dataPembayaranChart);
        return view('operator.beranda_index', $data);
    }
}
