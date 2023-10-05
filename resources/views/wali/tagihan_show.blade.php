@extends('layouts.app_sneat_wali', ['title' => 'Bayar Tagihan'])
@section('js')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    $(document).ready(function() {
        $("#pay-button").click(function(e) {
            var orderId = $("#order_id").val();
            var total = $("#total").val();
            var url = "/wali/walipayment?tagihan_id={{ $tagihan->id }}";
            $.getJSON(url
                , function(data, textStatus, jqXHR) {
                    snap.pay(data.snapToken, {
                        onSuccess: function(result) {
                            window.location.href = window.location.href + "?check=true";
                        }
                        , onPending: function(result) {
                            window.location.href = window.location.href + "?check=true";
                        }
                        , onError: function(result) {
                            window.location.href = window.location.href + "?check=true";
                        }
                    });
                }
            );
        });
    });

</script>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold" style="color: black">DETAIL TAGIHAN</h5>
            <div class="card-body mt-n3">
                <div class="row justify-content-between">
                    <div class="col-md-6 col-sm-12">
                        <table class="mb-3">
                            <tr>
                                <td width="40%" class="fw-bold">NIS</td>
                                <td class="fw-bold"> : {{ $santri->nis }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">NAMA</td>
                                <td class="fw-bold text-capitalize"> : {{ $santri->nama }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">KELAS</td>
                                <td class="fw-bold"> : {{ $santri->kelas }}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <table class="mb-3">
                            <tr>
                                <td width="55%" class="fw-bold">ID Tagihan</td>
                                <td class="fw-bold"> : {{ $tagihan->getNomorTagihan() }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Tagihan</td>
                                <td class="fw-bold"> : {{ $tagihan->tanggal_tagihan->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Tanggal Jatuh Tempo</td>
                                <td class="fw-bold"> : {{ $tagihan->tanggal_jatuh_tempo->translatedFormat('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold">Invoice</td>
                                <td class="fw-bold">: <span class="ms-1"><a target="blank" href="{{ route('invoice.show', $tagihan->id) }}"><i class="fa fa-eye"></i> Lihat Invoice</a></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="1%" class="fs-6 text-center text-white">No</th>
                                <th class="fs-6 text-center text-white">Nama Tagihan</th>
                                <th class="fs-6 text-center text-white">Jumlah</th>
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
                                <th colspan="2" class="fs-6 text-center">Total Pembayaran</th>
                                <th class="fs-6 text-end">{{ formatRupiah($tagihan->tagihanDetails->sum('jumlah_biaya')) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="alert alert-primary mt-2" role="alert" style="color: black">
                    <h5 class="text-primary fw-bold">METODE PEMBAYARAN</h5>
                    <ul>
                        <li>
                            <strong>MANUAL dengan cara datang langsung ke kantor pondok.</strong>
                        </li>
                        <li>
                            <strong>TRANSFER dengan cara kilik tombol "BAYAR" dibawah.</strong>
                            <ul>
                                <li class="list-unstyled">Nb: Metode TRANSFER akan dikenakan biaya admin sebesar Rp. 5000,-.</li>
                            </ul>
                        </li>
                    </ul>
                    <button class="btn btn-primary mt-2" id="pay-button">Bayar</button>
                </div>
                {{-- <div class="row">
                    @foreach ($bankPondok as $itemBank)
                    <div class="col-md-6">
                        <div class="alert alert-primary" role="alert">
                            <table width="100%" class="mb-2">
                                <tbody>
                                    <tr>
                                        <td width="30%">Nama Bank </td>
                                        <td>: {{ $itemBank->nama_bank }}</td>
                </tr>
                <tr>
                    <td>Nomor Rekening </td>
                    <td>: {{ $itemBank->nomor_rekening }}</td>
                </tr>
                <tr>
                    <td>Atas Nama </td>
                    <td>: {{ $itemBank->nama_rekening }}</td>
                </tr>
                </tbody>
                </table>
                <a href="{{ route('wali.pembayaran.create', [
                                'tagihan_id' => $tagihan->id,
                                'bank_pondok_id' => $itemBank->id,
                            ]) }}" class="btn btn-primary">Bayar Sekarang</a>
            </div>
        </div>
        @endforeach
    </div> --}}
</div>
</div>
</div>
</div>
@endsection
