<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaWaliController extends Controller
{
    public function index()
    {
        $santri = Santri::with('tagihan')->where('wali_id', Auth::id())
            ->whereHas('tagihan', function ($q) {
                $q->where('jenis', 'spp');
            })->orderBy('nama', 'asc')->get();
        // Perulangan data santri
        $dataRekap = [];
        foreach ($santri as $itemSantri) {
            // Jika bulan = 1 maka tahun ditambah 1 karena tagihan dimulai dari bulan juli
            $dataTagihan = [];
            $tahun = date('Y');
            // Perulangan berdasarkan bulan SPP
            foreach (bulanSPP() as $bulan) {
                if ($bulan == 1) {
                    $tahun = $tahun + 1;
                }
                // Mencari tagihan berdasarkan santri, tahun dan bulan
                $tagihan = $itemSantri->tagihan->filter(function ($value) use ($bulan, $tahun) {
                    return $value->tanggal_tagihan->year == $tahun && $value->tanggal_tagihan->month == $bulan;
                })->first();

                // Masukkan data ke dalam array
                $statusBayarTeks = "baru";
                if ($tagihan == null) {
                    $statusBayarTeks = '-';
                } else if ($tagihan->status != '') {
                    $statusBayarTeks = $tagihan->status;
                    $pembayaran = $tagihan->pembayaran->whereNull('tanggal_konfirmasi');
                    if ($pembayaran->count() >= 1) {
                        $statusBayarTeks = "Belum Dikonfirmasi";
                    }
                }

                $dataTagihan[] = [
                    'bulan' => ubahNamaBulan($bulan),
                    'tahun' => $tahun,
                    'tagihan' => $tagihan,
                    'tanggal_lunas' => $tagihan?->tanggal_lunas ?? '-',
                    'status_bayar' => $tagihan?->status == 'baru' ? false : true,
                    'status_bayar_teks' => $statusBayarTeks,
                ];
            }

            $dataRekap[] = [
                'santri' => $itemSantri,
                'dataTagihan' => $dataTagihan
            ];
        }
        $data['header'] = bulanSPP();
        $data['dataRekap'] = $dataRekap;

        if (request()->wantsJson()) {
            return response()->json($data);
        }

        return view('wali.beranda_index', $data);
    }

    public function indexApi()
    {
        $santri = Santri::with('tagihan')->where('wali_id', auth()->user()->id)->orderBy('nama', 'asc')->first();
        return $this->createdResponse("Data berhasil disimpan");
    }
}
