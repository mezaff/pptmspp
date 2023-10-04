<?php

namespace App\Http\Controllers;

use Notification;
use App\Models\Bank;
use App\Models\User;
use App\Models\Tagihan;
use App\Models\WaliBank;
use App\Models\BankPondok;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\PembayaranNotification;

class WaliSantriPembayaranController extends Controller
{
    public function index()
    {
        $pembayaran = Pembayaran::where('wali_id', auth()->user()->id)
            ->latest()
            ->orderBy('tanggal_konfirmasi', 'desc')
            ->paginate(50);
        $data['models'] = $pembayaran;
        return view('wali.pembayaran_index', $data);
    }

    public function show(Pembayaran $pembayaran)
    {
        auth()->user()->unreadNotifications->where('id', request('id'))->first()?->markAsRead();
        return view('wali.pembayaran_show', [
            'model' => $pembayaran,
        ]);
    }

    public function create(Request $request)
    {
        $data['listWaliBank'] = WaliBank::where('wali_id', Auth::user()->id)->get()->pluck('nama_bank_full', 'id');
        $data['tagihan'] = Tagihan::waliSantri()->findOrFail($request->tagihan_id);
        $data['model'] = new Pembayaran();
        $data['method'] = 'POST';
        $data['route'] = 'wali.pembayaran.store';
        $data['listBankPondok'] = BankPondok::pluck('nama_bank', 'id');
        $data['listBank'] = Bank::pluck('nama_bank', 'id');
        if ($request->bank_pondok_id != '') {
            $data['bankYangDipilih'] = BankPondok::findOrFail($request->bank_pondok_id);
        }
        $data['url'] = route('wali.pembayaran.create', [
            'tagihan_id' => $request->tagihan_id
        ]);

        return view('wali.pembayaran_form', $data);
    }

    public function store(Request $request)
    {

        if ($request->wali_bank_id == '' && $request->nomor_rekening == '') {
            flash('Silahkan pilih bank pengirim')->error();
            return back();
        }
        if ($request->nama_rekening != '' && $request->nomor_rekening != '') {
            //wali create rekening baru
            $bankId = $request->bank_id;
            $bank = Bank::findOrFail($bankId);
            if ($request->filled('simpan_data_rekening')) {
                $requestDataBank = $request->validate([
                    'nama_rekening' => 'required',
                    'nomor_rekening' => 'required',
                ]);
                $waliBank = WaliBank::firstOrCreate(
                    $requestDataBank,
                    [
                        'nama_rekening' => $requestDataBank['nama_rekening'],
                        'wali_id' => Auth::user()->id,
                        'kode' => $bank->sandi_bank,
                        'nama_bank' => $bank->nama_bank,
                    ]
                );
            }
        } else {
            //ambil data wali bank
            $waliBankId = $request->wali_bank_id;
            $waliBank = WaliBank::findOrFail($waliBankId);
        }

        $jumlahDibayar = str_replace('.', '', $request->jumlah_dibayar);

        $validasiPembayaran = Pembayaran::where('jumlah_dibayar', $jumlahDibayar)
            ->where('tagihan_id', $request->tagihan_id)
            ->first();
        if ($validasiPembayaran != null) {
            flash('Data pembayaran ini sudah ada dan akan segera dikonfirmasi oleh operator.')->error();
            return back();
        }

        $request->validate([
            'tanggal_bayar' => 'required',
            'jumlah_dibayar' => 'required',
            'bukti_bayar' => 'required|image|mimes:png,jpg,jpeg|max:5048'
        ]);
        $buktiBayar = $request->file('bukti_bayar')->store('public/bukti-pembayaran');
        $dataPembayaran = [
            'bank_pondok_id' => $request->bank_pondok_id,
            'wali_bank_id' => $waliBank->id,
            'tagihan_id' => $request->tagihan_id,
            'wali_id' => auth()->user()->id,
            'tanggal_bayar' => $request->tanggal_bayar . ' ' . date('H:i:s'),
            'jumlah_dibayar' => $jumlahDibayar,
            'bukti_bayar' => $buktiBayar,
            'metode_pembayaran' => 'transfer',
            'user_id' => 0,
        ];
        //validasi tagihan harus lunas
        $tagihan = Tagihan::findOrFail($request->tagihan_id);
        if ($jumlahDibayar >= $tagihan->total_tagihan) {
            DB::beginTransaction();
            try {
                //$pembayaran = Pembayaran::create($dataPembayaran);
                $pembayaran = new Pembayaran();
                $pembayaran->fill($dataPembayaran);
                $pembayaran->saveQuietly();

                $userOperator = User::where('akses', 'operator')->get();
                Notification::send($userOperator, new PembayaranNotification($pembayaran));
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                flash('Gagal melakukan pembayaran' + $th->getMessage())->error();
                return back();
            }
        } else {
            flash('Jumlah pembayaran tidak boleh kurang dari total tagihan')->error();
            return back();
        }

        flash('Pembayaran berhasil dan akan segera dikonfirmasi oleh operator')->success();
        return back();
    }

    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        if ($pembayaran->tanggal_konfirmasi != null) {
            flash('Pembayaran tidak bisa dibatalkan karena sudah dikonfirmasi')->error();
            return back();
        }
        \Storage::delete($pembayaran->bukti_bayar);
        $pembayaran->delete();
        flash('Pembayaran berhasil dibatalkan')->success();
        return redirect()->route('wali.pembayaran.index');
    }
}
