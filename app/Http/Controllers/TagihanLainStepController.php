<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Santri;
use Illuminate\Http\Request;

class TagihanLainStepController extends Controller
{
    public function create(Request $request)
    {
        if ($request->step == 1) {
            return $this->step1();
        }

        if ($request->step == 2) {
            return $this->step2();
        }

        if ($request->step == 3) {
            return $this->step3();
        }

        if ($request->step == 4) {
            return $this->step4();
        }
    }

    public function step1()
    {
        session()->forget('data_santri');
        session()->forget('tagihan_untuk');
        $data['activeStep1'] = 'active';
        return view('operator.tagihanlain_step1', $data);
    }

    public function step2()
    {
        if (!request()->filled('tagihan_untuk')) {
            flash()->addError('Silahkan pilih tujuan tagihan terlebih dahulu.');
            return redirect()->route('tagihanlainstep.create', ['step' => 2]);
        }

        session(['tagihan_untuk' => request('tagihan_untuk')]);
        if (request('tagihan_untuk') == 'semua') {
            return redirect()->route('tagihanlainstep.create', ['step' => 3]);
        }


        $query = Santri::query();
        if (request()->filled('cari')) {
            //cari data santri berdasarkan query di url
            $query->when(request()->filled('nama'), function ($query) {
                $query->where('nama', 'like', '%' . request()->cari . '%');
            })->when(request()->filled('kelas'), function ($query) {
                $query->where('kelas', request('kelas'));
            })->when(request()->filled('jenis_spp'), function ($query) {
                $query->where('jenis_spp', request('jenis_spp'));
            });
        }
        $data['santri'] = $query->get()->each(function ($q) {
            $q->checked = false;
            if (session('data_santri') != null && session('data_santri')->contains('id', $q->id)) {
                $q->checked = true;
            }
        });

        $data['activeStep2'] = 'active';
        return view('operator.tagihanlain_step2', $data);
    }

    public function step3()
    {
        if (session('tagihan_untuk') == '' || session('data_santri') == null) {
            flash()->addError('Silahkan pilih kategori tagihan terlebih dahulu');
            return redirect()->route('tagihanlainstep.create', ['step' => 1]);
        }
        $data['activeStep3'] = 'active';
        $data['biayaList'] = Biaya::whereNull('parent_id')->get()->pluck('nama', 'id');
        return view('operator.tagihanlain_step3', $data);
    }

    public function step4()
    {
        if (session('tagihan_untuk') == '' && request('biaya_id') != '') {
            flash()->addError('Silahkan pilih biaya tagihan terlebih dahulu');
            return redirect()->route('tagihanlainstep.create', ['step' => 3]);
        }
        session(['biaya_id' => request('biaya_id')]);
        $data['activeStep4'] = 'active';
        $data['biaya'] = Biaya::findOrFail(request('biaya_id'));

        if (session('tagihan_untuk') == 'semua') {
            $data['santri'] = Santri::all();
        } else {
            $data['santri'] = Santri::whereIn('id', session('data_santri')->pluck('id'))->get();
        }
        return view('operator.tagihanlain_step4', $data);
    }
}
