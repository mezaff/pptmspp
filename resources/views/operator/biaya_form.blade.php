@extends('layouts.app_sneat', ['title' => 'Form Biaya'])

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
                @if (request()->filled('parent_id'))
                <h6 class="text-uppercase">Item Tagihan {{$parentData->nama }}</h6>
                {!! Form::hidden('parent_id', $parentData->id, []) !!}
                <table class="{{ config('app.table_style') }}">
                    <thead class="{{ config('app.thead_style') }}">
                        <tr>
                            <th width="5%" class="text-center text-white">No</th>
                            <th class="text-center text-white">Nama Biaya</th>
                            <th class="text-center text-white">Jumlah</th>
                            <th class="text-center text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parentData->children as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ formatRupiah($item->jumlah) }}</td>
                            <td class="text-center">
                                <a href="{{ route('delete-biaya.item', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Apakah anda yakin ingin menghapus?')">
                                    <i class="fa fa-trash"></i>
                                    Hapus
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
                <div class="form-group mt-2 mb-2">
                    <label for="nama">Nama Biaya</label>
                    {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama', 'autofocus']) !!}
                    <span class="text-danger">{{ $errors->first('nama')}}</span>
                </div>
                <div class="form-group mb-2">
                    <label for="jumlah">Jumlah / Nominal</label>
                    {!! Form::text('jumlah', null, ['class' => 'form-control rupiah', 'placeholder' => 'Nominal SPP']) !!}
                    <span class="text-danger">{{ $errors->first('jumlah')}}</span>
                </div>
                {!! Form::submit($button, ['class' => 'btn btn-primary mt-2']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
