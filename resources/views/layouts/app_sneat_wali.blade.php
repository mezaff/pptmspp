<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ @$title != '' ? "$title |" : '' }} {{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('sneat') }}/assets/img/favicon/logo.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="{{ asset('sneat') }}/assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('sneat') }}/assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('sneat') }}/assets/js/config.js"></script>
    <link rel="stylesheet" href="{{ asset('font/css/all.min.css') }}">
    <style>
        .informasi-pengirim {
            padding: 10px;
        }

        .informasi-bank-tujuan,
            {
            padding: 10px;
        }

        .informasi-pembayaran {
            padding: 10px;
        }

        .divider-text {
            font-weight: bold;
        }

        .layout-navbar .navbar-dropdown .dropdown-menu {
            min-width: 22rem;
        }

    </style>
    <script>
        popupCenter = ({
            url
            , title
            , w
            , h
        }) => {
            // Fixes dual-screen position                             Most browsers      Firefox
            const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
            const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

            const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
            const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

            const systemZoom = width / window.screen.availWidth;
            const left = (width - w) / 2 / systemZoom + dualScreenLeft
            const top = (height - h) / 2 / systemZoom + dualScreenTop
            const newWindow = window.open(url, title
                , `
    scrollbars=yes,
    width=${w / systemZoom}, 
    height=${h / systemZoom}, 
    top=${top}, 
    left=${left}
    `
            )

            if (window.focus) newWindow.focus();
        }

    </script>

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo ms-n3">
                    <a href="{{ route('wali.beranda') }}" class="app-brand-link">
                        <span class="app-brand-logo demo">
                            <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="Logo" width="40">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bold text-capitalize fs-4 ms-2">PPTM Payment</span>
                    </a>

                    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item {{ \Route::is('wali.beranda') ? 'active' : '' }}">
                        <a href="{{ route('wali.beranda') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Beranda</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text text-warning fw-bold">DATA MASTER</span>
                    </li>
                    <li class="menu-item {{ \Route::is('wali.profil.*') ? 'active' : '' }}">
                        <a href="{{ route('wali.profil.create') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Profil</div>
                        </a>
                    </li>
                    <li class="menu-item {{ \Route::is('wali.santri.*') ? 'active' : '' }}">
                        <a href="{{ route('wali.santri.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Basic">Data Santri</div>
                        </a>
                    </li>
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text text-warning fw-bold">DATA TRANSAKSI</span>
                    </li>
                    <li class="menu-item {{ \Route::is('wali.tagihan.*') || \Route::is('wali.pembayaran.*') ? 'active' : '' }}">
                        <a href="{{ route('wali.tagihan.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Basic">Data Tagihan</div>
                        </a>
                    </li>
                    {{-- <li class="menu-item {{ \Route::is('wali.pembayaran.*') ? 'active' : '' }}">
                    <a href="{{ route('wali.pembayaran.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-collection"></i>
                        <div data-i18n="Basic">Data Pembayaran</div>
                    </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('logout') }}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-collection"></i>
                            <div data-i18n="Basic">Logout</div>
                        </a>
                    </li> --}}
                </ul>
            </aside>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                            <i class="bx bx-menu bx-sm"></i>
                        </a>
                    </div>

                    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                        <!-- Search -->
                        {!! Form::open(['route' => 'wali.tagihan.index', 'method' => 'GET']) !!}
                        <div class="navbar-nav align-items-center">
                            <div class="nav-item d-flex align-items-center">
                                <i class="bx bx-search fs-4 lh-0"></i>
                                <input name="q" type="text" class="form-control border-0 shadow-none" placeholder="Pencarian..." aria-label="Search..." value="{{ request('q') }}" />
                            </div>
                        </div>
                        {!! Form::close() !!}
                        <!-- /Search -->

                        <ul class="navbar-nav flex-row align-items-center ms-auto">
                            {{-- Notification --}}
                            <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="true">
                                    <i class="bx bx-bell bx-sm"></i>
                                    <span class="badge bg-danger rounded-pill badge-notifications">
                                        {{ auth()->user()->unreadNotifications->count() }}
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end py-0" data-bs-popper="static">
                                    <li class="dropdown-menu-header border-bottom">
                                        <div class="dropdown-header d-flex align-items-center py-3">
                                            <h5 class="text-body mb-0 me-auto">Notification</h5>
                                            {{-- <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Mark all as read" data-bs-original-title="Mark all as read"><i class="bx fs-4 bx-envelope-open"></i></a> --}}
                                        </div>
                                    </li>
                                    <li class="dropdown-notifications-list scrollable-container ps">
                                        <ul class="list-group list-group-flush">
                                            @foreach (auth()->user()->unreadNotifications as $notification)
                                            <li class="list-group-item list-group-item-action dropdown-notifications-item">
                                                <a href="{{ url($notification->data['url'] . '?id=' . $notification->id) }}">
                                                    <div class="d-flex">
                                                        <div class="flex-grow-1">
                                                            <h6 class="mb-1">{{ $notification->data['title'] }}</h6>
                                                            <p class="mb-0">{{ ucwords($notification->data['messages']) }}</p>
                                                            <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                        </div>
                                        <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                        </div>
                                    </li>
                                    {{-- <li class="dropdown-menu-footer border-top p-3">
                                        <button class="btn btn-primary text-uppercase w-100">view all notifications</button>
                                    </li> --}}
                                </ul>
                            </li>

                            <!-- User -->
                            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                    <div class="avatar {{ auth()->user()->unreadNotifications->count() >=1 ? 'avatar-online' : '' }}">
                                        <img src="{{ \Storage::url('images/user2.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('wali.profil.create') }}">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar">
                                                        <img src="{{ \Storage::url('images/user2.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <span class="fw-semibold d-block text-capitalize">{{ auth()->user()->name }}</span>
                                                    <small class="text-muted">{{ auth()->user()->email }}</small>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('wali.profil.create') }}">
                                            <i class="bx bx-user me-2"></i>
                                            <span class="align-middle">Profil</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('wali.tagihan.index') }}">
                                            <span class="d-flex align-items-center align-middle">
                                                <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                                <span class="flex-grow-1 align-middle">Tagihan</span>
                                            </span>
                                        </a>
                                    </li>
                                    <li>
                                        <div class="dropdown-divider"></div>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}">
                                            <i class="bx bx-power-off me-2"></i>
                                            <span class="align-middle">Log Out</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <!--/ User -->
                        </ul>
                    </div>
                </nav>

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->

                    <div class="container-xxl flex-grow-1 container-p-y">
                        @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {!! implode('', $errors->all('<div>:message</div>')) !!}
                        </div>
                        @endif
                        @yield('content')
                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <footer class="content-footer footer bg-footer-theme">
                        <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                            <div class="col-md-6 text-center text-md-start">
                                <span class="text-secondary"><a href="#" class="text-primary fw-bold"><i class="fas fa-copyright text-primary me-2"></i>{{ config('app.name', 'Laravel') }}</a>, All right reserved.</span>
                            </div>
                            <div class="col-md-6 text-center text-md-end">
                                <span class="text-secondary">Created By <a href="https://instagram.com/_mezaff" class="text-primary fw-bold" target="blank">Mezaff</a>
                            </div>
                        </div>
                    </footer>
                    <!-- / Footer -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    {{-- <!-- / Layout wrapper -->

    <div class="buy-now">
        <a href="https://themeselection.com/products/sneat-bootstrap-html-admin-template/" target="_blank" class="btn btn-danger btn-buy-now">Upgrade to Pro</a>
    </div> --}}

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('sneat') }}/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/libs/popper/popper.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/js/bootstrap.js"></script>
    <script src="{{ asset('sneat') }}/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{ asset('sneat') }}/assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('sneat') }}/assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="{{ asset('sneat') }}/assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="{{ asset('sneat') }}/assets/js/dashboards-analytics.js"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.rupiah').mask("#.##0", {
                reverse: true
            });
            $('.select2').select2();
        });

    </script>
    @yield('js')
</body>
</html>
