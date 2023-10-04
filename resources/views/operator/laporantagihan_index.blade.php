@extends('layouts.app_sneat_blank', ['title' => 'Laporan Tagihan'])
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold"></h5>
            <div class="card-body">
                @include('operator.laporan_header')
                <h4 class="text-center fw-bold">LAPORAN TAGIHAN</h4>
                <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="2%" class="text-center text-white">No</th>
                                <th width="7%" class="text-center text-white">NIS</th>
                                <th width="23%" class="text-center text-white">Nama</th>
                                <th width="5%" class="text-center text-white">Kelas</th>
                                <th width="15%" class="text-center text-white">Biaya Tagihan</th>
                                <th width="22%" class="text-center text-white">Tanggal Tagihan</th>
                                <th width="10%" class="text-center text-white">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tagihan as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->santri->nis }}</td>
                                <td class="text-capitalize">{{ $item->santri->nama }}</td>
                                <td>{{ $item->santri->kelas }}</td>
                                <td class="text-end">{{ formatRupiah($item->tagihanDetails->sum('jumlah_biaya')) }}</td>
                                <td>{{ $item->tanggal_tagihan->translatedFormat('l, d F Y') }}</td>
                                <td class="text-center text-capitalize">{{ $item->status }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7">Data tidak ditemukan</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
