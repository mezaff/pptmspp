@extends('layouts.app_sneat', ['title' => 'Form Tagihan'])
@section('js')
<script>
    $(document).ready(function() {
        $('#show-all').click(function(e) {
            $('.more').removeClass('d-none');

        });
    });

</script>
@endsection
@section('content')
<div class="bs-stepper wizard-numbered mt-2">
    @include('operator.tagihanlain_stepheader')
    <div class="bs-stepper-content">
        <!-- Account Details -->
        <div id="account-details" class="content active dstepper-block">
            {!! Form::open([
            'route' => ['tagihanlainstep4.store'],
            'method' => 'POST',
            ]) !!}
            {!! Form::hidden('step', 4, []) !!}
            {!! Form::hidden('biaya_id', $biaya->id, []) !!}
            <div class="row mb-3">
                <div class="col-md-4">
                    <h6 class="fw-bold mb-2">Tentukan Tanggal Tagihan</h6>
                    <div class="form-group mb-2">
                        <label for="tanggal_tagihan">Tanggal Tagihan</label>
                        {!! Form::date('tanggal_tagihan', date('Y-m-') . '01', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_tagihan')}}</span>
                    </div>
                    <div class="form-group mb-2">
                        <label for="tanggal_jatuh_tempo">Tanggal Jatuh Tempo</label>
                        {!! Form::date('tanggal_jatuh_tempo', date('Y-m-') . '10', ['class' => 'form-control']) !!}
                        <span class="text-danger">{{ $errors->first('tanggal_jatuh_tempo')}}</span>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <h6 class="fw-bold">Tagihan ini dibuat untuk : {{ $santri->count() }} Santri</h6>
                    <table class="table table-sm table-bordered">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="2%" class="text-white text-center">No</th>
                                <th width="20%" class="text-white text-center">NIS</th>
                                <th class="text-white text-center">Nama</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($santri as $item)
                            <tr class="{{ $loop->iteration > 5 ? 'd-none more' : ''}}">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->nis }}</td>
                                <td class="text-capitalize">{{ $item->nama }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if ($santri->count() >= 5)
                    <a href="#" id="show-all">Lihat Selengkapnya...</a>
                    @endif
                </div>
                <div class="col-md-6">
                    <h6 class="fw-bold">
                        Biaya yang ditagihkan : {{ $biaya->nama }} ({{ formatRupiah($biaya->total_tagihan) }})
                    </h6>
                    <table class="table table-sm table-bordered">
                        <thead class="{{ config('app.thead_style') }}">
                            <tr>
                                <th width="2%" class="text-white text-center">No</th>
                                <th class="text-white text-center">Nama Biaya</th>
                                <th class="text-white text-center">Nominal Biaya</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($biaya->children as $item)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td>{{ $item->nama }}</td>
                                <td class="text-capitalize">{{ formatRupiah($item->jumlah) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="alert alert-primary" role="alert">
                    Klik Simpan untuk memproses tagihan.
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <a href="{{ route('tagihanlainstep.create', ['step' => 3]) }}" class="btn btn-secondary btn-prev">
                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                        <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                    </a>
                    <button class="btn btn-primary btn-next" type="submit">
                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Simpan</span>
                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
