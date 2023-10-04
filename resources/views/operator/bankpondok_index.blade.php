@extends('layouts.app_sneat', ['title' => 'Data Rekening'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary mb-2">Tambah Rekening</a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="2%" class="text-center text-white">No</th>
                                <th class="text-center text-white">Nama Bank</th>
                                <th width="14%" class="text-center text-white">Kode Transfer</th>
                                <th class="text-center text-white">Pemilik Rekening</th>
                                <th class="text-center text-white">Nomor Rekening</th>
                                <th class="text-center text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_bank }}</td>
                                <td class="text-center">{{ $item->kode }}</td>
                                <td class="text-uppercase">{{ $item->nama_rekening }}</td>
                                <td>{{ $item->nomor_rekening }}</td>
                                <td class="text-center">
                                    {!! Form::open([
                                    'route' => [$routePrefix . '.destroy', $item->id],
                                    'method' => 'DELETE',
                                    'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data?")'
                                    ]) !!}
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
