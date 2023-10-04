@extends('auth.app_auth_sneat')

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Forgot Password -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="app-brand justify-content-center">
                        <a href="#" class="app-brand-link gap-2">
                            <img src="{{ \Storage::url(settings()->get('app_logo')) }}" alt="Login" width="100">
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2">Lupa Password? 🔒</h4>
                    <p class="mb-2">Masukkan email Anda dan kami akan mengirimkan instruksi untuk mengatur ulang kata sandi Anda</p>
                    <div class="alert alert-info text-black" role="alert">
                        Jika Bapak/Ibu Wali Santri mebutuhkan bantuan silahkan klik link berikut: <strong>
                            <a target="blank" href="https://wa.link/zwyj1o">Bantuan</a>
                        </strong>
                    </div>
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" placeholder="Masukkan email anda" autofocus>
                        </div>
                        <button type="submit" class="btn btn-primary d-grid w-100">Kirim Link Reset</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="d-flex align-items-center justify-content-center">
                            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                            Kembali ke halaman login
                        </a>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
</div>
@endsection
