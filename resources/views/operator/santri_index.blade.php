@extends('layouts.app_sneat', ['title' => 'Data Santri'])
@section('js')
<script>
    $(document).ready(function() {
        $("#div-import").hide();
        $("#btn-div").click(function(e) {
            $("#div-import").toggle();
        });
    });

</script>
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary mb-2">Tambah Data</a>
                        <a href="#" class="btn btn-warning mb-2 ms-2" id="btn-div">Import Dengan Excel</a>
                    </div>
                    <div class="col-md-6">
                        {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                        <div class="input-group mb-2">
                            {!! Form::text('q', request('q'), ['class' => 'form-control', 'placeholder' => '-Pencarian Data Santri-']) !!}
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2" value="{{ request('q') }}">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="row mb-2" id="div-import">
                    <div class="alert alert-primary" role="alert">
                        <strong>Silahkan download template excel, dilarang mengubah format file excel yang telah tersedia!</strong>
                    </div>
                    <div class="col-md-5 col-sm-12"></div>
                    <div class="col-md-7 col-sm-12">
                        {!! Form::open([
                        'route' =>'santriimport.store',
                        'method' => 'POST',
                        'files' => true,
                        ]) !!}
                        <div class="input-group">
                            <input name="template" type="file" class="form-control" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            <button class="btn btn-primary" type="submit" id="inputGroupFileAddon04"><i class="fa fa-upload"></i> Import</button>&nbsp;
                            <a href="{{ asset('template-santri.xlsx') }}" class="btn btn-outline-warning" target="blank">
                                <i class="fa fa-download"></i> Template</a>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="2%" class="text-center text-white">No</th>
                                <th width="20%" class="text-center text-white">Nama</th>
                                <th class="text-center text-white">NIS</th>
                                <th width="15%" class="text-center text-white">Nama Wali</th>
                                <th width="5%" class="text-center text-white">Kelas</th>
                                <th class="text-center text-white">Biaya SPP</th>
                                <th class="text-center text-white">Status</th>
                                <th class="text-center text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-capitalize">{{ $item->nama }}</td>
                                <td class="text-center">{{ $item->nis }}</td>
                                <td class="text-capitalize">{{ $item->wali->name ?? '-Data belum ada-' }}</td>
                                <td class="text-center">{{ $item->kelas }}</td>
                                <td>{{ formatRupiah($item->biaya?->first()->total_tagihan) }}</td>
                                <td class="text-center text-capitalize {{ $item->status == 'aktif' ? 'text-success' : 'text-danger' }}">{{ $item->status }}</td>
                                <td class="text-center">
                                    {!! Form::open([
                                    'route' => [$routePrefix . '.destroy', $item->id],
                                    'method' => 'DELETE',
                                    'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data?")'
                                    ]) !!}
                                    <a href="{{ route($routePrefix . '.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="{{ route($routePrefix . '.show', $item->id) }}" class="btn btn-info btn-sm mx-1">
                                        <i class="fa fa-eye"></i> Detail
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
