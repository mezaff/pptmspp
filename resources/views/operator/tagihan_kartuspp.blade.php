<div class="card">
    <div class="card-body mt-n4">
        <div class="row">
            <div class="col-md-6 text-start">
                <h5 class="card-header fw-bold mb-n3">KARTU SPP</h5>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('kartuspp.index', [
                    'santri_id' => $santri->id,
                    'tahun' => getTahunAjaran(),
                ]) }}" class="btn btn-primary btn-sm mt-3" target="blank"><i class="fa fa-print"> </i> Cetak Kartu SPP
                </a>
            </div>
        </div>
        <table class="{{ config('app.table_style') }}">
            <thead class="{{ config('app.thead_style') }}">
                <tr>
                    <th class="text-center text-white">No</th>
                    <th class="text-center text-white">Bulan</th>
                    <th class="text-center text-white">jml Tagihan</th>
                    <th class="text-center text-white">Tgl Bayar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kartuSpp as $item)
                <tr class="item">
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item['bulan'].' '.$item['tahun'] }}</td>
                    <td class="text-end">{{ formatRupiah($item['total_tagihan']) }}</td>
                    <td>{{ $item['tanggal_bayar'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
