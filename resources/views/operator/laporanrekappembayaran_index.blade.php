@extends('layouts.app_sneat_blank', ['title' => 'Rekap Pembayaran'])
@section('content')

<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold"></h5>
            <div class="card-body">
                @include('operator.laporan_header')
                <h4 class="text-center fw-bold text-black">REKAP PEMBAYARAN</h4>
                <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th class="text-center text-white">No</th>
                                <th class="text-center text-white">Nama Santri</th>
                                @foreach ($header as $bulan)
                                <th class="text-center text-white">{{ ubahNamaBulan($bulan) }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($dataRekap as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item['santri']['nama'] }}</td>
                                @foreach ($item['dataTagihan'] as $itemTagihan)
                                <td class="text-center">
                                    @if ($itemTagihan['tanggal_lunas'] != '-')
                                    {{ optional($itemTagihan['tanggal_lunas'])->format('d/m/y') }}
                                    @else
                                    -
                                    @endif
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
