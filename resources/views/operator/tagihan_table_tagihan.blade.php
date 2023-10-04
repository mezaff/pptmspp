<h5 class="card-header fw-bold mb-2 ">RINCIAN TAGIHAN | {{ $periode }}</h5>
<div class="card-body mt-n4 mb-n4">
    <table class="{{ config('app.table_style') }}">
        <thead class="{{ config('app.thead_style') }}">
            <tr>
                <th width="2%" class="text-center text-white">No</th>
                <th class="text-center text-white">Nama Tagihan</th>
                <th class="text-center text-white">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tagihan->tagihanDetails as $item)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $item->nama_biaya }}</td>
                <td class="text-end">{{ formatRupiah($item->jumlah_biaya)}}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2" class="fw-bold">Total Tagihan</td>
                <td class="text-end fw-bold">{{ formatRupiah($tagihan->total_tagihan) }}</td>
            </tr>
        </tfoot>
    </table>
    <a href="{{ route('invoice.show', $tagihan->id) }}" target="_blank" class="btn btn-primary btn-sm text-white mt-2">
        <i class="fa fa-file-pdf"></i> Lihat Invoice
    </a>
</div>
