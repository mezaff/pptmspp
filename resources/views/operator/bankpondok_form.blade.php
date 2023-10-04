@extends('layouts.app_sneat', ['title' => 'Form Rekening'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                {!! Form::model($model, [
                'route' => $route,
                'method' => $method,
                ]) !!}
                <div class="form-group mb-2">
                    <label for="bank_id">Nama Bank</label>
                    {!! Form::select('bank_id', $listBank, null, ['class' => 'form-control select2', 'placeholder' => '-Pilih Nama Bank-']) !!}
                    <span class="text-danger">{{ $errors->first('bank_id')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="nama_rekening">Pemilik Rekening</label>
                    {!! Form::text('nama_rekening', null, ['class' => 'form-control', 'placeholder' => 'Nama Pemilik Rekening']) !!}
                    <span class="text-danger">{{ $errors->first('nama_rekening')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="nomor_rekening">Nomor Rekening</label>
                    {!! Form::text('nomor_rekening', null, ['class' => 'form-control', 'placeholder' => 'Nama Pemilik Rekening']) !!}
                    <span class="text-danger">{{ $errors->first('nomor_rekening')}}</span>
                </div>
                {!! Form::submit($button, ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
