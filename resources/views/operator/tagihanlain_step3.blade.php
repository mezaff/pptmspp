@extends('layouts.app_sneat', ['title' => 'Form Tagihan'])
@section('content')
<div class="bs-stepper wizard-numbered mt-2">
    @include('operator.tagihanlain_stepheader')
    <div class="bs-stepper-content">
        <!-- Account Details -->
        <div id="account-details" class="content active dstepper-block">
            <div class="content-header mb-3">
                @if (session('tagihan_untuk') == 'semua')
                <h6 class="mb-0">Tagihan Untuk Semua Santri</h6>
                @else
                <h6 class="mb-0">Tagihan Untuk : {{ session('data_santri')->count() }} Santri</h6>
                @endif
                <small>Pilih Biaya yang akan ditagihkan.</small>
            </div>
            {!! Form::open([
            'route' => ['tagihanlainstep.create'],
            'method' => 'GET',
            ]) !!}
            {!! Form::hidden('step', 4, []) !!}
            <div class="row g-3">
                <div class="form-group">
                    <label for="biaya_id">
                        Pilih Biaya atau
                        <a href="{{ route('biaya.create') }}" target="blank">
                            Buat Baru
                        </a>
                    </label>
                    {!! Form::select('biaya_id', $biayaList, null, [
                    'class' => 'form-control select2',
                    'placeholder' => 'Pilih Nama Biaya'
                    ]) !!}
                </div>
                <div class="alert alert-secondary" role="alert">
                    Jika anda menambahkan biaya baru, jangan lupa klik tombol berikut untuk menampilkan biaya yang baru anda buat. <a href=""> <i class="fa fa-arrows-rotate"></i></a>
                </div>
                <div class="col-12 d-flex justify-content-between">
                    <a href="{{ route('tagihanlainstep.create', ['step' => 1]) }}" class="btn btn-secondary btn-prev">
                        <i class="bx bx-chevron-left bx-sm ms-sm-n2"></i>
                        <span class="align-middle d-sm-inline-block d-none">Kembali</span>
                    </a>
                    <button class="btn btn-primary btn-next" type="submit">
                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Lanjut</span>
                        <i class="bx bx-chevron-right bx-sm me-sm-n2"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
