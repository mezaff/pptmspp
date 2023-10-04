@extends('layouts.app_sneat_wali', ['title' => 'Data Santri'])

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header fw-bold">DATA SANTRI</h5>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="{{ config('app.table_style') }}">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="3%" class="text-white text-center">No</th>
                                <th width="30%" class="text-white text-center">Nama</th>
                                <th class="text-white text-center">NIS</th>
                                <th class="text-white text-center">Kelas</th>
                                <th class="text-white text-center">Biaya SPP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->nama }}</td>
                                <td class="text-center">{{ $item->nis }}</td>
                                <td class="text-center">{{ $item->kelas }}</td>
                                <td class="text-center">
                                    <a href="{{ route('wali.santri.show', $item->id) }}">
                                        <i class="fa fa-eye"></i>
                                        {{ formatRupiah($item->biaya->total_tagihan) }}
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
