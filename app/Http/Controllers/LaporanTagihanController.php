<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use Illuminate\Http\Request;

class LaporanTagihanController extends Controller
{
    public function index(Request $request)
    {
        $tagihan = Tagihan::query();
        if ($request->filled('bulan')) {
            $tagihan = $tagihan->whereMonth('tanggal_tagihan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $tagihan = $tagihan->whereYear('tanggal_tagihan', $request->tahun);
        }

        if ($request->filled('biaya_id')) {
            $tagihan = $tagihan->where('biaya_id', $request->biaya_id);
        }

        if ($request->filled('status')) {
            $tagihan = $tagihan->where('status', $request->status);
        }

        if ($request->filled('kelas')) {
            $tagihan = $tagihan->whereHas('santri', function ($q) use ($request) {
                $q->where('kelas', $request->kelas);
            });
        }
        $tagihan = $tagihan->get();
        return view('operator.laporantagihan_index', compact('tagihan'));
    }
}
