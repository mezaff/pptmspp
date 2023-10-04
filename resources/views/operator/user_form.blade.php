@extends('layouts.app_sneat', ['title' => 'Form User'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                {!! Form::model($model, ['route' => $route, 'method' => $method]) !!}
                <div class="form-group mb-2">
                    <label for="name">Nama</label>
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nama', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('name')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="email">Email</label>
                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'someone@mail.com']) !!}
                    <span class="text-danger">{{ $errors->first('email')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="nohp">No. HP</label>
                    {!! Form::text('nohp', null, ['class' => 'form-control', 'placeholder' => 'Nomor HP']) !!}
                    <span class="text-danger">{{ $errors->first('nohp')}}</span>
                </div>
                @if (\Route::is('user.create', 'user.edit'))
                <div class="form-group mb-2">
                    <label for="akses">Hak Akses</label>
                    {!! Form::select('akses',[
                    'operator' => 'Operator Pondok',
                    'admin' => 'Admin Pondok'
                    ],
                    null,
                    ['class' => 'form-control', 'placeholder' => '--Pilih Hak Akses--']) !!}
                    <span class="text-danger">{{ $errors->first('akses')}}</span>
                </div>
                @endif
                <div class="form-group mb-2">
                    <label for="password">Password</label>
                    {!! Form::password('password', ['class' => 'form-control', 'type' => 'password', 'placeholder' => 'Password']) !!}
                    <span class="text-danger">{{ $errors->first('password')}}</span>
                </div>
                {!! Form::submit($button, ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
