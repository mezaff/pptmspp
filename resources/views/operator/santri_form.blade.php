@extends('layouts.app_sneat', ['title' => 'Form Santri'])

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
                    <label for="nama">Nama</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('nama')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="biaya_id">Biaya SPP</label>
                    {!! Form::select('biaya_id', $listBiaya, null, ['class' => 'form-control', 'placeholder' => '-Pilih Jenis Biaya-']) !!}
                    <span class="text-danger">{{ $errors->first('biaya_id')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="nis">NIS</label>
                    {!! Form::text('nis', null, ['class' => 'form-control', 'placeholder' => 'Nomor Induk Santri']) !!}
                    <span class="text-danger">{{ $errors->first('nis')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="wali_id">Wali Santri (Optional)</label>
                    {!! Form::select('wali_id', $wali, null, ['class' => 'form-control select2', 'placeholder' => '-Pilih Nama Wali-']) !!}
                    <span class="text-danger">{{ $errors->first('wali_id')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="kelas">Kelas</label>
                    {!! Form::select('kelas', getKelas(),
                    null,
                    ['class' => 'form-control', 'placeholder' => '-Pilih Kelas-']) !!}
                    <span class="text-danger">{{ $errors->first('kelas')}}</span>
                </div>
                {!! Form::submit($button, ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
