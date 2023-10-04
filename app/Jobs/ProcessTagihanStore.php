<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\Santri;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Imtigger\LaravelJobStatus\Trackable;
use App\Notifications\TagihanNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Notification;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class ProcessTagihanStore implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $requestData;
    public function __construct($requestData)
    {
        $this->requestData = $requestData;
        $this->prepareStatus();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $requestData = $this->requestData;
        $requestData['status'] = 'baru';
        $tanggalTagihan = Carbon::parse($requestData['tanggal_tagihan']);
        $bulanTagihan = $tanggalTagihan->format('m');
        $tahunTagihan = $tanggalTagihan->format('Y');
        $santri = Santri::with('biaya', 'tagihan', 'tagihan.tagihanDetails')->currentStatus('aktif');
        if (isset($requestData['santri_id']) && $requestData['santri_id'] != null) {
            $santri = $santri->where('id', $requestData['santri_id']);
        }
        $santri = $santri->get();
        $this->setProgressMax($santri->count());
        $i = 1;
        foreach ($santri as $itemSantri) {
            $this->setProgressNow($i);
            $i++;
            $requestData['santri_id'] = $itemSantri->id;
            $requestData['biaya_id'] = $itemSantri->biaya_id;
            $cekTagihan = $itemSantri->tagihan->filter(function ($value) use ($bulanTagihan, $tahunTagihan) {
                return $value->tanggal_tagihan->year == $tahunTagihan && $value->tanggal_tagihan->month == $bulanTagihan;
            })->first();

            if ($cekTagihan == null) {
                $tagihan = Tagihan::create($requestData);
                if ($tagihan->santri->wali != null) {
                    Notification::send($tagihan->santri->wali, new TagihanNotification($tagihan));
                }
                $biaya = $itemSantri->biaya->children;
                foreach ($biaya as $itemBiaya) {
                    $detail = TagihanDetail::create([
                        'tagihan_id' => $tagihan->id,
                        'nama_biaya' => $itemBiaya->nama,
                        'jumlah_biaya' => $itemBiaya->jumlah,
                    ]);
                }
            }
            sleep(1);
        }
        $this->setOutput(['message' => 'Tagihan bulan ' . ubahNamaBulan($bulanTagihan) . ' ' . $tahunTagihan . ' berhasil dibuat']);
    }
}
