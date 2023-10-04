@extends('layouts.app_sneat', ['title' => 'Form Tagihan'])
@section('js')
<script>
    $(document).ready(function() {
        $("#loading-spinner").hide();
    });

</script>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                {!! Form::model($model, [
                'route' => $route,
                'method' => $method,
                'id' => 'form-ajax',
                ]) !!}
                <div class="form-group mb-2">
                    <label for="santri_id">Buat Tagihan Per Santri</label>
                    {!! Form::select('santri_id', $santriList, null, [
                    'class' => 'form-control select2',
                    'placeholder' => '-Pilih Santri-',
                    ]) !!}
                    <span class="text-danger">{{ $errors->first('santri_id')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="tanggal_tagihan">Tanggal Tagihan</label>
                    {!! Form::date('tanggal_tagihan', $model->tanggal_tagihan ?? date('Y-m-') . '01', ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('tanggal_tagihan')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                    {!! Form::date('tanggal_jatuh_tempo', $model->tanggal_jatuh_tempo ?? date('Y-m-') . '10', ['class' => 'form-control']) !!}
                    <span class="text-danger">{{ $errors->first('tanggal_jatuh_tempo')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="keterangan">Keterangan</label>
                    {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'rows' => 3]) !!}
                    <span class="text-danger">{{ $errors->first('keterangan')}}</span>
                </div>
                {{-- {!! Form::submit($button, ['class' => 'btn btn-primary mt-2']) !!} --}}
                <button class="btn btn-primary mt-2" type="submit">
                    <span id="loading-spinner" class="spinner-border spinner-border-sm" aria-hidden="true"></span>
                    <span role="status">{{ $button }}</span>
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
