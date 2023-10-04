@extends('layouts.app_sneat_wali', ['title' => 'Detail Santri'])

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
                                <th width="15%">Status Santri</th>
                                <td>
                                    <span class="badge {{ $model->status == 'aktif' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $model->status}}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                                <td class="text-capitalize">{{ $model->nama}}</td>
                            </tr>
                            <tr>
                                <th>NIS</th>
                                <td>{{ $model->nis}}</td>
                            </tr>
                            <tr>
                                <th>Kelas</th>
                                <td>{{ $model->kelas}}</td>
                            </tr>
                            <tr>
                                <th>Dibuat Oleh</th>
                                <td class="text-capitalize">{{ $model->user->name}}</td>
                            </tr>
                            <tr>
                                <th>Dibuat Pada</th>
                                <td>{{ $model->created_at->format('d/m/Y H:i')}}</td>
                            </tr>
                        </thead>
                    </table>
                    <div class="row mt-5 mb-3">
                        <div class="col-md-5">
                            <h5 class="fw-bold">TAGIHAN SPP</h5>
                            <table class="{{ config('app.table_style') }}">
                                <thead class="{{ config('app.thead_style') }}">
                                    <tr>
                                        <th width="2%" class="text-center text-white">No</th>
                                        <th class="text-center text-white">Nama Tagihan</th>
                                        <th class="text-center text-white">Jumlah Tagihan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($model->biaya->children as $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $item->nama }}</td>
                                        <td class="text-end">{{ formatRupiah($item->jumlah) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <td colspan="2" class="text-center fw-bold">TOTAL TAGIHAN</td>
                                    <td class="fw-bold text-end">{{ formatRupiah($model->biaya->children->sum('jumlah')) }}</td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
