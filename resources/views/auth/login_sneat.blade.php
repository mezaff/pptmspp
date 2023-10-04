@extends('auth.app_auth_sneat', ['title' => 'Halaman Login'])
@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
        <!-- Register -->
        <div class="card">
            <div class="card-body">
                <!-- Logo -->
                <div class="app-brand justify-content-center mb-1">
                    <a href="#" class="app-brand-link gap-2">
                        <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="Login" width="100">
                    </a>
                </div>
                <h4 class="mb-2 mt-2 text-center fw-bold text-primary">PPTM Payment</h4>
                <!-- /Logo -->
                <p class="mb-2">Sistem Aplikasi Pembayaran SPP Pondok Pesantren Tarbiyatul Mutathowi'in</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" autofocus />
                    </div>
                    <div class="mb-3 form-password-toggle">
                        <div class="d-flex justify-content-between">
                            <label class="form-label" for="password">Password</label>
                            <a href="{{ route('password.request') }}">
                                <small>Lupa Password?</small>
                            </a>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                            <label class="form-check-label" for="remember-me"> Simpan Info Login </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                    </div>
                </form>

                <p class="text-center">
                    <span>Belum punya akun?</span>
                    <a target="blank" href="{{ route('register') }}">
                        <span>Daftar</span>
                    </a>
                </p>
            </div>
        </div>
        <!-- /Register -->
    </div>
</div>
@endsection
