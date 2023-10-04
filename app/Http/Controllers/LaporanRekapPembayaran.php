<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class LaporanRekapPembayaran extends Controller
{
    public function index(Request $request)
    {
        $santri = Santri::with('tagihan')->orderBy('nama', 'asc');
        if ($request->filled('kelas_id')) {
            $santri->where('kelas_id', $request->kelas_id);
        }
        $santri = $santri->get();
        // Perulangan data santri
        foreach ($santri as $itemSantri) {
            // Jika bulan = 1 maka tahun ditambah 1 karena tagihan dimulai dari bulan juli
            $dataTagihan = [];
            $tahun = $request->tahun;
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
                $dataTagihan[] = [
                    'bulan' => ubahNamaBulan($bulan),
                    'tahun' => $tahun,
                    'tanggal_lunas' => $tagihan->tanggal_lunas ?? '-',
                ];
            }
            $dataRekap[] = [
                'santri' => $itemSantri,
                'dataTagihan' => $dataTagihan
            ];
        }
        $data['header'] = bulanSPP();
        $data['dataRekap'] = $dataRekap;
        return view('operator.laporanrekappembayaran_index', $data);
    }
}
