@extends('layouts.app_sneat', ['title' => 'Data Pembayaran'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">DATA PEMBAYARAN</h5>
            <div class="card-body">
                <div class="row justify-content-end">
                    <div class="col-md-12 mb-2">
                        {!! Form::open(['route' => 'pembayaran.index', 'method' => 'GET']) !!}
                        <div class="row gx-4">
                            <div class="col-md-3 col-sm-12">
                                {!! Form::text('q', request('q'), ['class' => 'form-control', 'placeholder' => 'Pencarian Data Santri...']) !!}
                            </div>
                            <div class="col-md-1 col-sm-12">
                                {!! Form::select('kelas', getKelas(), request('kelas'), [
                                'class' => 'form-control',
                                'placeholder' => 'Kelas'
                                ]) !!}
                            </div>
                            <div class="col-md-1 col-sm-12">
                                {!! Form::select('status', [
                                '' => 'Status',
                                'sudah-konfirmasi' => 'Sudah Dikonfirmasi',
                                'belum-konfirmasi' => 'Belum Dikonfirmasi',
                                ],
                                request('status'),
                                ['class' => 'form-control']
                                ) !!}
                            </div>
                            <div class="col-md-1 col-sm-12">
                                {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control', 'placeholder' => 'Bulan']) !!}
                            </div>
                            <div class="col-md-1 col-sm-12">
                                {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control', 'placeholder' => 'Tahun']) !!}
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
                                <th width="2%" class="text-center text-white">No</th>
                                <th width="3%" class="text-center text-white">NIS</th>
                                <th width="22%" class="text-center text-white">Nama</th>
                                <th class="text-center text-white">Nama Wali</th>
                                <th class="text-center text-white">Metode</th>
                                <th class="text-center text-white">Status</th>
                                <th class="text-center text-white">Tgl Konfirmasi</th>
                                <th class="text-center text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->tagihan->santri->nis }}</td>
                                <td class="text-capitalize">{{ $item->tagihan->santri->nama }}</td>
                                <td>{{ $item->wali->name }}</td>
                                <td class="text-center text-capitalize">{{ $item->metode_pembayaran }}</td>
                                <td class="text-center">
                                    <span class="badge rounded-pill bg-{{ $item->status_style }}">
                                        {{ $item->status_konfirmasi }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    @if ($item->tanggal_konfirmasi == null)
                                    Belum Dikonfirmasi
                                    @else
                                    {{ $item->tanggal_konfirmasi->format('d/m/Y') }}
                                    @endif
                                </td>
                                <td class="text-center">
                                    {!! Form::open([
                                    'route' => ['pembayaran.destroy', $item->id],
                                    'method' => 'DELETE',
                                    'onsubmit' => 'return confirm("Apakah anda yakin ingin menghapus data?")'
                                    ]) !!}
                                    <a href="{{ route('pembayaran.show', $item->id) }}" class="btn btn-info btn-sm">
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
