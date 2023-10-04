<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Biaya;
use App\Models\Santri;
use App\Models\Tagihan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use App\Models\TagihanDetail;
use App\Models\Tagihan as Model;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;
use App\Jobs\ProcessTagihanStore;
use App\Notifications\TagihanNotification;
use Notification;

class TagihanController extends Controller
{
    private $viewIndex = 'tagihan_index';
    private $viewCreate = 'tagihan_form';
    private $viewEdit = 'tagihan_form';
    private $viewٍShow = 'tagihan_show';
    private $routePrefix = 'tagihan';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = Model::latest();
        if ($request->filled('bulan')) {
            $models = $models->whereMonth('tanggal_tagihan', $request->bulan);
        }

        if ($request->filled('tahun')) {
            $models = $models->whereYear('tanggal_tagihan', $request->tahun);
        }

        if ($request->filled('biaya_id')) {
            $models = $models->where('biaya_id', $request->biaya_id);
        }
        if ($request->filled('status')) {
            $models = $models->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $models = $models->search($request->q, null, true);
        }

        return view('operator.' . $this->viewIndex, [
            'models' => $models->paginate(settings()->get('app_pagination', '50')),
            'routePrefix' => $this->routePrefix,
            'title' => 'DATA TAGIHAN',
            'biayaList' => Biaya::whereNull('parent_id')->pluck('nama', 'id'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'BUAT',
            'title' => 'FORM PEMBUATAN TAGIHAN',
            'santriList' => Santri::pluck('nama', 'id'),
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTagihanRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagihanRequest $request)
    {
        $requestData = array_merge($request->validated(), ['user_id' => auth()->user()->id]);
        $processTagihan = new ProcessTagihanStore($requestData);
        $this->dispatch($processTagihan);
        return redirect(route('jobstatus.index', ['job_status_id' => $processTagihan->getJobStatusId()]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Model  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $santri = Santri::findOrFail($request->santri_id);
        $tahun = $request->tahun;
        $arrayData = [];
        foreach (bulanSPP() as $bulan) {
            if ($bulan == 1) {
                $tahun = $tahun + 1;
            }
            $tagihan = Tagihan::where('santri_id', $request->santri_id)
                ->whereYear('tanggal_tagihan', $tahun)
                ->whereMonth('tanggal_tagihan', $bulan)
                ->first();

            $tanggalBayar = '';
            if ($tagihan != null && $tagihan->status != 'baru') {
                $tanggalBayar = $tagihan->pembayaran->first()->tanggal_bayar->translatedFormat('d-M-y');
            }

            $arrayData[] = [
                'bulan' => ubahNamaBulan($bulan),
                'tahun' => $tahun,
                'total_tagihan' => $tagihan->total_tagihan ?? 0,
                'status_tagihan' => ($tagihan == null) ? 'Belum Bayar' :  $tagihan->status,
                'tanggal_bayar' => $tanggalBayar
            ];
        }

        $data['kartuSpp'] = collect($arrayData);
        $tagihan = Model::with('pembayaran')->findOrFail($id);
        $data['tagihan'] = $tagihan;
        $data['santri'] = $tagihan->santri;
        $data['periode'] = Carbon::parse($tagihan->tanggal_tagihan)->translatedFormat('F Y');
        $data['model'] = new Pembayaran();
        return view('operator.' . $this->viewٍShow, $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        if ($tagihan->status == 'lunas') {
            flash('Tagihan tidak bisa dihapus karena sudah Lunas')->error();
            return back();
        }
        TagihanDetail::where('tagihan_id', $id)->delete();
        Tagihan::destroy($id);
        Pembayaran::where('tagihan_id', $id)->delete();
        flash('Tagihan berhasil dihapus')->success();
        return back();
    }
}
