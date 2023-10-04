<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use Illuminate\Http\Request;

class LaporanPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $pembayaran = Pembayaran::query();
        if ($request->filled('bulan')) {
            $pembayaran = $pembayaran->whereMonth('tanggal_bayar', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $pembayaran = $pembayaran->whereYear('tanggal_bayar', $request->tahun);
        }

        if ($request->filled('status')) {
            $pembayaran = $pembayaran->where('status', $request->status);
        }

        if ($request->filled('biaya_id')) {
            $pembayaran = $pembayaran->whereHas('tagihan', function ($q) use ($request) {
                $q->where('biaya_id', $request->biaya_id);
            });
        }

        if ($request->filled('kelas')) {
            $pembayaran = $pembayaran->whereHas('tagihan', function ($q) use ($request) {
                $q->whereHas('santri', function ($q) use ($request) {
                    $q->where('kelas', $request->kelas);
                });
            });
        }
        $pembayaran = $pembayaran->get();
        return view('operator.laporanpembayaran_index', compact('pembayaran'));
    }
}
