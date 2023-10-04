@extends('layouts.app_sneat_wali', ['title' => 'Data Tagihan'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">DATA TAGIHAN</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="1%" class="text-center text-white">No</th>
                                <th class="text-center text-white">Nama</th>
                                <th width="2%" class="text-center text-white">Kelas</th>
                                <th width="20%" class="text-center text-white">Jenis Tagihan</th>
                                <th width="20%" class="text-center text-white">Bulan Tagihan</th>
                                <th width="20%" class="text-center text-white">Status Pembayaran</th>
                                <th width="15%" class="text-center text-white">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tagihan as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-capitalize">{{ $item->santri->nama }}</td>
                                <td class="text-center">{{ $item->santri->kelas }}</td>
                                <td class="text-center text-uppercase">{{ $item->jenis }}</td>
                                <td>{{ $item->tanggal_tagihan->translatedFormat('F Y') }}</td>
                                <td class="text-center">
                                    @if ($item->pembayaran->count() >= 1)
                                    <a href="{{ route('wali.pembayaran.show', $item->pembayaran->first()->id) }}" class="btn btn-success btn-sm">
                                        {{ $item->pembayaran->first()->tanggal_konfirmasi == null ? 'Belum Dikonfirmasi' : 'Sudah Dibayar' }}
                                    </a>
                                    @else
                                    {{ $item->getStatusTagihanWali() }}
                                    @endif

                                </td>
                                <td class="text-center">
                                    @if ($item->status == 'baru' || $item->status == 'angsur')
                                    <a href="{{ route('wali.tagihan.show', $item->id) }}" class="btn btn-primary btn-sm">Bayar Tagihan</a>
                                    @else
                                    <a href="" class="btn btn-success btn-sm">Tagihan Lunas</a>
                                    @endif
                                </td>
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
