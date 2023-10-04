@extends('layouts.app_sneat_wali', ['title' => 'Detail Tagihan'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">DATA PEMBAYARAN</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td colspan="2" class="bg-primary text-white fw-bold">INFORMASI SANTRI</td>
                            </tr>
                            <tr>
                                <td>Nama Santri</td>
                                <td class="text-capitalize">: {{ $model->tagihan->santri->nama }}</td>
                            </tr>
                            <tr>
                                <td>Nama Wali</td>
                                <td class="text-capitalize">: {{ $model->wali->name }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="bg-primary text-white fw-bold">INFORMASI TAGIHAN</td>
                            </tr>
                            <tr>
                                <td>ID Tagihan</td>
                                <td>: {{ $model->tagihan_id }}</td>
                            </tr>
                            <tr>
                                <td>Invoice Tagihan</td>
                                <td>
                                    <a href="{{ route('invoice.show', $model->tagihan_id) }}" target="blank">
                                        : <i class="fa fa-file-pdf"></i> Cetak Invoice
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Total Tagihan</td>
                                <td>: {{ formatRupiah($model->tagihan->tagihanDetails->sum('jumlah_biaya')) }}</td>
                            </tr>
                            @if ($model->metode_pembayaran != "manual")
                            <tr>
                                <td colspan="2" class="bg-primary text-white fw-bold">INFORMASI REKENING PENGIRIM</td>
                            </tr>
                            <tr>
                                <td>Nama Bank</td>
                                <td>: {{ $model->waliBank->nama_bank }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Rekening</td>
                                <td>: {{ $model->waliBank->nomor_rekening }}</td>
                            </tr>
                            <tr>
                                <td>Nama Rekening</td>
                                <td class="text-uppercase">: {{ $model->waliBank->nama_rekening }}</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="bg-primary text-white fw-bold">INFORMASI REKENING PONDOK</td>
                            </tr>
                            <tr>
                                <td>Nama Bank</td>
                                <td>: {{ $model->bankPondok->nama_bank }}</td>
                            </tr>
                            <tr>
                                <td>Nomor Rekening</td>
                                <td>: {{ $model->bankPondok->nomor_rekening }}</td>
                            </tr>
                            <tr>
                                <td>Nama Rekening</td>
                                <td class="text-uppercase">: {{ $model->bankPondok->nama_rekening }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="2" class="bg-primary text-white fw-bold">INFORMASI PEMBAYARAN</td>
                            </tr>
                            <tr>
                                <td width="20%">Tanggal Pembayaran</td>
                                <td>: {{ $model->tanggal_bayar->translatedFormat('l, d F Y') }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Yang Ditagihakan</td>
                                <td>: {{ formatRupiah($model->tagihan->tagihanDetails->sum('jumlah_biaya')) }}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Yang Dibayarkan</td>
                                <td>: {{ formatRupiah($model->jumlah_dibayar) }}</td>
                            </tr>
                            <tr>
                                <td>Status Konfirmasi</td>
                                <td class="text-uppercase">: {{ $model->status_konfirmasi }}</td>
                            </tr>
                            <tr>
                                <td>Tanggal Konfirmasi</td>
                                <td>: {{ optional($model->tanggal_konfirmasi)->translatedFormat('l, d F Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>Status Pembayaran</td>
                                <td>: {{ $model->tagihan->getStatusTagihanWali() }}</td>
                            </tr>
                            <tr>
                                <td>Bukti Pembayaran</td>
                                <td>:
                                    <a href="javascript:void[0]" onclick="popupCenter({url: '{{ \Storage::url($model->bukti_bayar) }}', title: 'Bukti Pembayaran', w: 1000, h: 700});">
                                        <i class="fa fa-eye"></i> Lihat Bukti Pembayaran
                                    </a>
                                </td>
                            </tr>
                        </thead>
                    </table>
                    @if ($model->tanggal_konfirmasi == null)
                    <div class="alert alert-warning mt-2" role="alert">
                        <strong>MENUNGGU KONFIRMASI</strong>
                    </div>
                    {!! Form::open([
                    'route' => ['wali.pembayaran.destroy', $model->id],
                    'method' => 'DELETE',
                    'onsubmit' => 'return confirm("Apakah anda yakin ingin membatalkan pembayaran?")'
                    ]) !!}
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash me-1"> </i> Batalkan Pembayaran
                    </button>
                    {!! Form::close() !!}
                    @else
                    <div class="alert alert-primary mt-2" role="alert">
                        <h4 class="text-black fw-bold">TAGIHAN SUDAH DIKONFIRMASI</h4>
                    </div>
                    <div class="btn btn-primary">
                        <a href="{{ route('kwitansipembayaran.show', $model->id) }}" target="blank" class="text-white">
                            <i class="fa fa-file-pdf"></i> Download Kwitansi
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
