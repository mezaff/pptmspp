@extends('layouts.app_sneat', ['title' => 'Data Biaya'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary mb-2">Tambah Biaya</a>
                    </div>
                    <div class="col-md-6">
                        {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                        <div class="input-group mb-2">
                            <input name="q" type="text" class="form-control" placeholder="Cari Data" aria-label="cari data" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2" value="{{ request('q') }}">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="2%" class="text-center text-white">No</th>
                                <th width="9%" class="text-center text-white">Biaya ID</th>
                                <th class="text-center text-white">Nama Biaya</th>
                                <th class="text-center text-white">Total Tagihan</th>
                                <th class="text-center text-white">Pembuat</th>
                                <th width="30%" class="text-center text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center"><span class="badge bg-warning">{{ $item->id }}</span></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ formatRupiah($item->total_tagihan) }}</td>
                                <td class="text-capitalize">{{ $item->user->name }}</td>
                                <td class="text-center">
                                    {!! Form::open([
                                    'route' => [$routePrefix . '.destroy', $item->id],
                                    'method' => 'DELETE',
                                    'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data?")'
                                    ]) !!}
                                    <a href="{{ route($routePrefix . '.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route($routePrefix . '.create', [
                                        'parent_id' => $item->id
                                        ]) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i> Rincian
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i> Hapus
                                    </button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Data tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {!! $models->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
