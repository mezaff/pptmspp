@extends('layouts.app_sneat', ['title' => 'Data Tagihan'])
@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">{{ $title }}</h5>
            <div class="card-body">
                <div class="row">
                    {{-- <div class="col-md-2">
                        <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary mb-2">Tambah Data</a>
                </div> --}}
                <div class="col-md-12 mb-2">
                    {!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
                    <div class="row gx-2">
                        <div class="col-md-3 col-sm-12">
                            {!! Form::text('q', request('q'), ['class' => 'form-control', 'placeholder' => '-Pencarian Data Santri-']) !!}
                        </div>
                        <div class="col-md-1 col-sm-12">
                            {!! Form::select('kelas', getKelas(), request('kelas'), [
                            'class' => 'form-control',
                            'placeholder' => '-Kelas-'
                            ]) !!}
                        </div>
                        <div class="col-md-1 col-sm-12">
                            {!! Form::select('biaya_id', $biayaList, request('biaya_id'), [
                            'class' => 'form-control',
                            'placeholder' => '-Jenis-'
                            ]) !!}
                        </div>
                        <div class="col-md-1 col-sm-12">
                            {!! Form::select('status', [
                            '' => '-Status-',
                            'baru' => 'Baru',
                            'angsur' => 'Angsur',
                            'lunas' => 'Lunas',
                            ],
                            request('status'),
                            ['class' => 'form-control']
                            ) !!}
                        </div>
                        <div class="col-md-1 col-sm-12">
                            {!! Form::selectMonth('bulan', request('bulan'), [
                            'class' => 'form-control',
                            'placeholder' => '-Bulan-'
                            ]) !!}
                        </div>
                        <div class="col-md-1 col-sm-12">
                            {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), [
                            'class' => 'form-control',
                            'placeholder' => '-Tahun-'
                            ]) !!}
                        </div>
                        <div class="col-md-2 col-sm-12">
                            <button class="btn btn-primary">Cari</button>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="table-responsive">
                <table class="{{ config('app.table_style') }}">
                    <thead class="{{ config('app.thead_style') }}">
                        <tr>
                            <th width="1%" class="text-center text-white">No</th>
                            <th width="7%" class="text-center text-white">NIS</th>
                            <th width="20" class="text-center text-white">Nama</th>
                            <th width="15%" class="text-center text-white">Biaya Tagihan</th>
                            <th width="22%" class="text-center text-white">Tanggal Tagihan</th>
                            <th width="10%" class="text-center text-white">Jenis</th>
                            <th width="10%" class="text-center text-white">Status</th>
                            <th width="17%" class="text-center text-white">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($models as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $item->santri->nis }}</td>
                            <td>{{ $item->santri->nama }}</td>
                            <td>{{ formatRupiah($item->tagihanDetails->sum('jumlah_biaya')) }}</td>
                            <td>{{ $item->tanggal_tagihan->translatedFormat('l, d F Y') }}</td>
                            <td>{{ $item->jenis }}</td>
                            <td class="text-center">
                                <span class="badge rounded-pill bg-{{ $item->status_style }}">
                                    {{ $item->status }}
                                </span>

                            </td>
                            <td class="text-center">
                                {!! Form::open([
                                'route' => [$routePrefix . '.destroy', $item->id],
                                'method' => 'DELETE',
                                'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data?")'
                                ]) !!}
                                <a href="{{ route($routePrefix . '.show', [
                                        $item->id,
                                        'santri_id' => $item->id,
                                        'bulan' => $item->tanggal_tagihan->format('m'),
                                        'tahun' => $item->tanggal_tagihan->format('Y'),
                                    ]) }}" class="btn btn-info btn-sm">
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
                            <td colspan="7">Data tidak ditemukan</td>
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
