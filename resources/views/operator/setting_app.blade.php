@extends('layouts.app_sneat', ['title' => 'Setelan'])

@section('content')
@include('operator.setting_menu')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open([
                'route' => 'settingapp.store',
                'method' => 'POST',
                'files' => true,
                ]) !!}
                <div class="divider">
                    <div class="divider-text fw-bold fs-5"><i class="fa fa-info-circle"></i> PENGATURAN APLIKASI</div>
                </div>
                <div class="form-group mb-2">
                    <label for="app_pagination">Data Per Halaman</label>
                    {!! Form::number('app_pagination', settings()->get('app_pagination'), ['class' => 'form-control', 'placeholder' => 'Alamat Lembaga']) !!}
                    <span class="text-danger">{{ $errors->first('app_pagination')}}</span>
                </div>
                {!! Form::submit('UPDATE', ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
