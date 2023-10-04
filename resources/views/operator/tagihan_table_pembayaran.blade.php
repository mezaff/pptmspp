<h5 class="card-header fw-bold">DATA PEMBAYARAN</h5>
<div class="card-body mt-n3 mb-n4">
    <table class="{{ config('app.table_style') }}">
        <thead class="{{config('app.thead_style')}}">
            <tr>
                <th class="text-center text-white">Tanggal</th>
                <th class="text-center text-white">Metode</th>
                <th width="30%" class="text-center text-white">Jumlah</th>
                <th class="text-center text-white">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tagihan->pembayaran as $item)
            <tr>
                <td>{{ $item->tanggal_bayar->translatedFormat('d/m/Y') }}</td>
                <td class="text-capitalize">{{ $item->metode_pembayaran }}</td>
                <td class="text-end">{{ formatRupiah($item->jumlah_dibayar) }}</td>
                <td class="text-center">
                    {!! Form::open([
                    'route' => ['pembayaran.destroy', $item->id],
                    'method' => 'DELETE',
                    'onsubmit' => 'return confirm("Yakin ingin menghapus data?")'
                    ]) !!}
                    <a href="{{ route('kwitansipembayaran.show', $item->id) }}" target="blank" class="m-0 p-0"><i class="fa fa-print"></i></a>
                    <button type="submit" class="btn text-primary m-0 p-0 ms-2">
                        <i class="fa fa-trash"></i>
                    </button>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td class="fw-bold" colspan="2">Total Pembayaran</td>
                <td class="text-end fw-bold">{{ formatRupiah($tagihan->total_pembayaran) }}</td>
                <td>&nbsp;</td>
            </tr>
        </tfoot>
    </table>
    <h5 class="mt-2">Status Pembayaran : {{ strtoupper($tagihan->status) }}</h5>
</div>
