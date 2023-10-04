@extends('layouts.app_sneat', ['title' => 'Laporan'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold text-uppercase mb-n4">Form Laporan</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="divider">
                            <div class="divider-text fw-bold fs-5"><i class="fa fa-info-circle"></i> LAPORAN TAGIHAN</div>
                        </div>
                        @include('operator.laporanform_tagihan')
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="divider">
                            <div class="divider-text fw-bold fs-5"><i class="fa fa-info-circle"></i> LAPORAN PEMBAYARAN</div>
                        </div>
                        @include('operator.laporanform_pembayaran')
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-12">
                        <div class="divider">
                            <div class="divider-text fw-bold fs-5"><i class="fa fa-info-circle"></i> REKAP PEMBAYARAN</div>
                        </div>
                        @include('operator.laporanform_rekappembayaran')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
