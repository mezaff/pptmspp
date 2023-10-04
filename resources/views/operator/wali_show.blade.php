@extends('layouts.app_sneat', ['title' => 'Detail Wali Santri'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width="15%">ID</th>
                                <td>{{ $model->id}}</td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td class="text-capitalize">{{ $model->name}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $model->email}}</td>
                            </tr>
                            <tr>
                                <th>Nomor HP</th>
                                <td>{{ $model->nohp}}</td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td>{{ $model->created_at->format('d/m/Y H:i')}}</td>
                            </tr>
                        </thead>
                    </table>
                    <h5 class="mt-4 fw-bold">TAMBAH DATA ANAK</h5>
                    {!! Form::open(['route' => 'walisantri.store', 'method' => 'POST']) !!}
                    {!! Form::hidden('wali_id', $model->id, []) !!}
                    <div class="form-group mb-2">
                        {!! Form::select('santri_id', $santri, null, ['class' => 'form-control select2', 'placeholder' => '-Pilih Data Anak-']) !!}
                        <span class="text-danger">{{ $errors->first('santri_id')}}</span>
                    </div>
                    {!! Form::submit('TAMBAH', ['class' => 'btn btn-primary']) !!}
                    {!! Form::close() !!}
                    <h5 class="mt-4 fw-bold">DATA ANAK</h5>
                    <div class="row">
                        <div class="col-md-7">
                            <table class="{{ config('app.table_style') }}">
                                <thead class="{{ config('app.thead_style') }}">
                                    <tr>
                                        <th width="1%" class="text-center text-white">No</th>
                                        <th width="7%" class="text-center text-white">NIS</th>
                                        <th width="30%" class="text-center text-white">Nama</th>
                                        <th width="7%" class="text-center text-white">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model->santri as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nis }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-center">
                                            {!! Form::open([
                                            'route' => ['walisantri.update', $item->id],
                                            'method' => 'PUT',
                                            'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data ini?")'
                                            ]) !!}
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
