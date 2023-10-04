@extends('layouts.app_sneat', ['title' => 'Setelan'])

@section('content')
@include('operator.setting_menu')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                {!! Form::open([
                'route' => 'settingpj.store',
                'method' => 'POST',
                'files' => true,
                ]) !!}
                {{-- <div class="divider">
                    <div class="divider-text fw-bold fs-5"><i class="fa fa-info-circle"></i> PENGATURAN LEMBAGA</div>
                </div>
                <div class="form-group mb-2">
                    <div class="text-center">
                        <img class="mt-3" src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="Logo" width="200">
            </div>
            <label for="app_logo">Logo</label>
            {!! Form::file('app_logo', ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('app_logo')}}</span>
        </div>
        <div class="form-group mb-2">
            <label for="app_name">Nama Lembaga</label>
            {!! Form::text('app_name', settings()->get('app_name'), ['class' => 'form-control', 'placeholder' => 'Nama', 'autofocus']) !!}
            <span class="text-danger">{{ $errors->first('app_name')}}</span>
        </div>
        <div class="form-group mb-2">
            <label for="app_email">Email Lembaga</label>
            {!! Form::text('app_email', settings()->get('app_email'), ['class' => 'form-control', 'placeholder' => 'lembaga@mail.com']) !!}
            <span class="text-danger">{{ $errors->first('app_email')}}</span>
        </div>
        <div class="form-group mb-2">
            <label for="app_phone">No Telp. Lembaga</label>
            {!! Form::text('app_phone', settings()->get('app_phone'), ['class' => 'form-control', 'placeholder' => 'No Telp. Lembaga']) !!}
            <span class="text-danger">{{ $errors->first('app_phone')}}</span>
        </div>
        <div class="form-group mb-2">
            <label for="app_address">Alamat Lembaga</label>
            {!! Form::textarea('app_address', settings()->get('app_address'), [
            'class' => 'form-control',
            'rows' => 3,
            ]) !!}
            <span class="text-danger">{{ $errors->first('app_address')}}</span>
        </div>
        {!! Form::submit('UPDATE', ['class' => 'btn btn-primary mt-2']) !!} --}}
        <div class="divider">
            <div class="divider-text fw-bold fs-5"><i class="fa fa-info-circle"></i> PENGATURAN PENANGGUNG JAWAB</div>
        </div>
        <div class="form-group mb-2">
            <label for="pj_nama">Nama Penanggung Jawab</label>
            {!! Form::text('pj_nama', settings()->get('pj_nama'), ['class' => 'form-control', 'placeholder' => 'Nama Lengkap']) !!}
            <span class="text-danger">{{ $errors->first('pj_nama')}}</span>
        </div>
        <div class="form-group mb-2">
            <label for="pj_jabatan">Jabatan (ex:bendahara)</label>
            {!! Form::text('pj_jabatan', settings()->get('pj_jabatan'), ['class' => 'form-control', 'placeholder' => 'Jabatan']) !!}
            <span class="text-danger">{{ $errors->first('pj_jabatan')}}</span>
        </div>
        <div class="form-group mb-2">
            <label for="pj_ttd">Upload Gambar Tanda Tangan (format: jpg, png. Max: 5mb)</label>
            {!! Form::file('pj_ttd', ['class' => 'form-control']) !!}
            <span class="text-danger">{{ $errors->first('pj_ttd')}}</span>
            <img class="mt-3" src="{{ \Storage::url(settings()->get('pj_ttd')) }}" alt="Ttd" width="200">
        </div>
        {!! Form::submit('UPDATE', ['class' => 'btn btn-primary mt-2']) !!}
        {{-- <div class="divider">
                    <div class="divider-text fw-bold fs-5"><i class="fa fa-info-circle"></i> PENGATURAN APLIKASI</div>
                </div>
                <div class="form-group mb-2">
                    <label for="app_pagination">Data Per Halaman</label>
                    {!! Form::number('app_pagination', settings()->get('app_pagination'), ['class' => 'form-control', 'placeholder' => 'Alamat Lembaga']) !!}
                    <span class="text-danger">{{ $errors->first('app_pagination')}}</span>
    </div>
    {!! Form::submit('UPDATE', ['class' => 'btn btn-primary mt-2']) !!} --}}
    {!! Form::close() !!}
</div>
</div>
</div>
</div>
@endsection
