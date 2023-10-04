@extends('layouts.app_sneat', ['title' => 'Data Operator'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary mb-2">Tambah Data</a>
                <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="2%" class="text-center text-white">No</th>
                                <th width="23%" class="text-center text-white">Nama</th>
                                <th class="text-center text-white">No. HP</th>
                                <th class="text-center text-white">Email</th>
                                <th class="text-center text-white">Akses</th>
                                <th width="16%" class="text-center text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-capitalize">{{ $item->name }}</td>
                                <td>{{ $item->nohp }}</td>
                                <td>{{ $item->email }}</td>
                                <td class="text-center text-capitalize">{{ $item->akses }}</td>
                                <td class="text-center">
                                    {!! Form::open([
                                    'route' => [$routePrefix . '.destroy', $item->id],
                                    'method' => 'DELETE',
                                    'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data?")'
                                    ]) !!}
                                    <a href="{{ route($routePrefix . '.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
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
