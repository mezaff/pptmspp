@extends('layouts.app_sneat_wali')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">DATA PEMBAYARAN</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        {!! Form::open(['route' => 'wali.pembayaran.index', 'method' => 'GET']) !!}
                        <div class="row">
                            <div class="col">
                                {!! Form::selectMonth('bulan', request('bulan'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                {!! Form::selectRange('tahun', 2022, date('Y') + 1, request('tahun'), ['class' => 'form-control']) !!}
                            </div>
                            <div class="col">
                                <button class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th width="1%">No</th>
                                <th width="3%">NIS</th>
                                <th width="20%">Nama</th>
                                <th width="20%">Nama Wali</th>
                                <th width="10%">Metode Pembayaran</th>
                                <th width="15%">Status Konfirmasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->tagihan->santri->nis }}</td>
                                <td>{{ $item->tagihan->santri->nama }}</td>
                                <td>{{ $item->wali->name }}</td>
                                <td class="text-center">{{ $item->metode_pembayaran }}</td>
                                <td class="text-center">{{ $item->status_konfirmasi }}</td>
                                <td class="text-center">
                                    <a href="{{ route('wali.pembayaran.show', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-eye"></i> Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4">Data tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {!! $models->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
