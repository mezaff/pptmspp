@extends('layouts.app_sneat', ['title' => 'Detail Tagihan'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        @include('operator.tagihan_datasantri')
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-5">
        <div class="card">
            {{-- tabel tagihan --}}
            @include('operator.tagihan_table_tagihan')
            {{-- tabel pembayaran --}}
            @include('operator.tagihan_table_pembayaran')
            {{-- form pembayaran --}}
            @include('operator.tagihan_form_pembayaran')
        </div>
    </div>
    <div class="col-md-7">
        <div class="card">
            {{-- kartu spp --}}
            @include('operator.tagihan_kartuspp')
        </div>
    </div>
</div>

@endsection
