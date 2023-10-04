@extends('layouts.app_sneat_wali')
@section('js')
<script>
    $(function() {
        $("#checkboxtoggle").click(function() {
            if ($(this).is(":checked")) {
                $("#pilihan_bank").hide('slow');
                $("#form_bank_pengirim").show('slow');
            } else {
                $("#pilihan_bank").show('slow');
                $("#form_bank_pengirim").hide('slow');
            }
        });
    });

    $(document).ready(function() {
        @if(count($listWaliBank) >= 1)
        $("#form_bank_pengirim").hide();
        @else
        $("#form_bank_pengirim").show();
        @endif

        $("#pilih_bank").change(function(e) {
            var bankId = $(this).find(":selected").val();
            window.location.href = "{!! $url !!}&bank_pondok_id=" + bankId;
        })
    });

</script>
@endsection
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">KONFIRMASI PEMBAYARAN</h5>
            <div class="card-body">
                {!! Form::model('model', ['route' => $route, 'method' => $method, 'files' => true]) !!}
                {!! Form::hidden('tagihan_id', request('tagihan_id'), []) !!}
                <div class="divider">
                    <div class="divider-text fs-5"><i class="fa fa-info-circle"></i> INFORMASI REKENING PENGIRIM</div>
                </div>
                @if (count($listWaliBank) >= 1)
                <div class="form-group mb-2" id="pilihan_bank">
                    <label for="wali_bank_id">Pilih Bank Pengirim</label>
                    {!! Form::select('wali_bank_id', $listWaliBank, null, [
                    'class' => 'form-control select2',
                    'placeholder' => '-Pilih Nomor Rekening Tersimpan-'
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('wali_bank_id') }}</span>
                </div>
                <div class="form-check">
                    {!! Form::checkbox('pilihan_bank', 1, false, [
                    'class' => 'form-check-input',
                    'id' => 'checkboxtoggle',
                    ]) !!}
                    <label class="form-check-label" for="checkboxtoggle">
                        Gunakan Rekening Baru.
                    </label>
                </div>
                @endif
                <div class="informasi-pengirim mb-5" id="form_bank_pengirim">
                    <div class="alert alert-danger" role="alert">
                        Informasi ini dibutuhkan agar operator dapat melakukan konfirmasi pembayaran
                    </div>
                    <div class="form-group mb-2">
                        <label for="nama_bank_pengirim">Nama Bank Pengirim</label>
                        {!! Form::select('bank_id', $listBank, null, [
                        'class' => 'form-control',
                        'placeholder' => '-Pilih Bank Yang Anda Gunakan-',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('bank_id') }}</span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="nama_rekening">Nama Rekening Pengirim</label>
                        {!! Form::text('nama_rekening', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Nama Rekening Pengirim',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('nama_rekening') }}</span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="nomor_rekening">Nomor Rekening Pengirim</label>
                        {!! Form::text('nomor_rekening', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Masukkan Nama Rekening Pengirim',
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('nomor_rekening') }}</span>
                    </div>
                    <div class="form-check">
                        {!! Form::checkbox('simpan_data_rekening', 1, true, [
                        'class' => 'form-check-input',
                        'id' => 'defaultCheck3',
                        ]) !!}
                        <label class="form-check-label" for="defaultCheck3">
                            Simpan Rekening Ini Untuk Memudahkan Transaksi Selanjutnya.
                        </label>
                    </div>
                </div>
                <div class="divider">
                    <div class="divider-text fs-5"><i class="fa fa-info-circle"></i> INFORMASI REKENING TUJUAN</div>
                </div>
                <div class="informasi-bank-tujuan mb-5">
                    <div class="form-group mb-2">
                        <label for="bank_pondok_id">Bank Tujuan
                            <span class="fw-bold">(Bank pondok yang anda pilih.)</span>
                        </label>
                        {!! Form::select('bank_pondok_id', $listBankPondok, request('bank_pondok_id'), [
                        'class' => 'form-control',
                        'placeholder' => '-Pilih Bank Yang Telah Anda Gunakan-',
                        'id' => 'pilih_bank'
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('bank_pondok_id') }}</span>
                    </div>
                    @if (request('bank_pondok_id') != '')
                    <div class="alert alert-dark" role="alert">
                        <table width="100%" class="mb-2">
                            <tbody>
                                <tr>
                                    <td width="30%">Nama Bank </td>
                                    <td>: {{ $bankYangDipilih->nama_bank }}</td>
                                </tr>
                                <tr>
                                    <td>Nomor Rekening </td>
                                    <td>: {{ $bankYangDipilih->nomor_rekening }}</td>
                                </tr>
                                <tr>
                                    <td>Atas Nama </td>
                                    <td>: {{ $bankYangDipilih->nama_rekening }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
                <div class="divider">
                    <div class="divider-text fs-5"><i class="fa fa-info-circle"></i> INFORMASI PEMBAYARAN</div>
                </div>
                <div class="informasi-pembayaran">
                    <div class="form-group mb-2">
                        <label for="tanggal_bayar">Tanggal Bayar</label>
                        {!! Form::date('tanggal_bayar', $model->tanggal_bayar ?? date('Y-m-d'), ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_bayar') }}</span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="jumlah_dibayar">Jumlah Yang Dibayarkan</label>
                        {!! Form::text('jumlah_dibayar', $tagihan->tagihanDetails->sum('jumlah_biaya'),
                        [
                        'class' => 'form-control rupiah'
                        ]) !!}
                        <span class="text-danger">{{ $errors->first('jumlah_dibayar') }}</span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="bukti_bayar">Upload Bukti Pembayaran
                            <span class="fw-bold">(jpeg, jpg, png. max : 5MB)</span>
                        </label>
                        {!! Form::file('bukti_bayar', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        <span class="text-danger">{{ $errors->first('bukti_bayar') }}</span>
                    </div>
                    {!! Form::submit('BAYAR', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
