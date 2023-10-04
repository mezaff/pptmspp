@extends('layouts.app_sneat', ['title' => 'Selamat Datang'])

@section('content')
<div class="row">
    <div class="col-lg-4 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-12">
                    <div class="card-body">
                        <h5 class="card-title text-primary text-capitalize">Selamat Datang, {{ auth()->user()->name}}</h5>
                        <p class="mb-1">
                            Kamu mendapat <span class="fw-bold">{{ auth()->user()->unreadNotifications->count() }}</span> informasi pembayaran yang
                            belum dikonfirmasi.
                        </p>
                        <a href="{{ route('pembayaran.index') }}" class="btn btn-sm btn-outline-primary">Lihat Data Pembayaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-8 order-1">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('sneat') }}/assets/img/icons/unicons/add-user.png" alt="chart success" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{ route('santri.index') }}">Lihat Data Santri</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Santri</span>
                        <h3 class="fw-semibold mb-1"><span class="text-success">{{ $santri }}</span> Santri</h3>
                        {{-- <small class="text-success fw-semibold">Data</small> --}}
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('sneat') }}/assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="{{ route('pembayaran.index') }}">Lihat Data Pembayaran</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Sudah Bayar</span>
                        <h3 class="card-title text-nowrap mb-1"><span class="text-success">{{ $totalSantriSudahBayar }}</span> Santri</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <img src="{{ asset('sneat') }}/assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded" />
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="{{ route('pembayaran.index') }}">Lihat Data Pembayaran</a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Saldo</span>
                        <h3 class="card-title text-nowrap mb-1 text-succes">{{ formatRupiah($totalPembayaran) }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card h-80">
            <div class="card-body mb-n1">
                {{ $tagihanStatusChart->container() }}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-80">
            <div class="card-body mb-1">
                {{ $pembayaranStatusChart->container() }}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-80">
            <div class="card-body mb-1">
                Coming soon
                <br><br><br><br><br><br><br><br><br>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                <div class="card-title mb-0">
                    <h5 class="m-0 me-2 fw-bold">Tagihan {{ $bulanTeks }} {{ $tahun }}</h5>
                    <small class="text-muted">{{ date('d F Y H:i:s') }}</small>
                </div>

            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="d-flex flex-column align-items-start gap-1 mt-2">
                        <h4 class="mb-1">
                            {{ $tagihanSudahBayar->count() }}/{{ $tagihanBelumBayar->count() }}
                        </h4>
                        <span>Total Tagihan : {{ $totalTagihan }}</span>
                    </div>
                    {{-- {{ $tagihanChart->container() }} --}}
                </div>
                <ul class="p-0 m-0">
                    @foreach ($tagihanPerKelas as $key => $item)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary">
                                {{ $item->count() }}
                            </span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Kelas {{ $key }}</h6>
                                <small class="text-muted">Sudah Bayar / Belum Bayar</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">
                                    {{ $item->where('status', 'lunas')->count() }} /
                                    {{ $item->where('status', '<>', 'lunas')->count() }}
                                </small>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 order-2 mb-4">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2 fw-bold">Pembayaran Belum Dikonfirmasi</h5>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    @foreach ($dataPembayaranBelumKonfirmasi->take(9) as $item)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <span>
                                <img src="{{ asset('storage') }}/images/user2.png" alt="Santri" class="rounded" />
                            </span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">{{ $item->tanggal_bayar->diffForHumans() }}</small>
                                <h6 class="mb-0 text-capitalize">{{ $item->tagihan->santri->nama }}</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0">
                                    <a class="btn btn-primary btn-sm" href="{{ route('pembayaran.show', $item->id) }}">Detail</a>
                                </h6>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!--/ Transactions -->
    <!-- Transactions -->
    <div class="col-md-6 col-lg-4 order-2">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2 fw-bold">Tagihan Belum Dibayar</h5>
                {{ $tagihanBelumBayar->count() }}/{{ $totalTagihan }}
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    @foreach ($tagihanBelumBayar->take(9) as $item)
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar flex-shrink-0 me-3">
                            <img src="{{ asset('storage') }}/images/user2.png" alt="User" class="rounded" />
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <small class="text-muted d-block mb-1">
                                    {{ $item->tanggal_tagihan->translatedFormat('F Y') }}
                                </small>
                                <h6 class="mb-0 text-capitalize">{{ $item->santri->nama }}</h6>
                            </div>
                            <div class="user-progress d-flex align-items-center gap-1">
                                <h6 class="mb-0">
                                    <a class="btn btn-primary btn-sm" href="{{ route('tagihan.show', [
                                        $item->id,
                                        'santri_id' => $item->santri_id,
                                        'tahun' => $item->tanggal_tagihan->year
                                        ]) }}">Detail</a>
                                </h6>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    <!--/ Transactions -->
</div>
<script src="{{ $tagihanChart->cdn() }}"></script>
{{ $tagihanChart->script() }}
{{ $tagihanStatusChart->script() }}
{{ $pembayaranStatusChart->script() }}
@endsection
