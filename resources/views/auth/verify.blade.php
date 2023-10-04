@extends('layouts.app')
@section('content')
<div class="container position-absolute top-50 start-50 translate-middle">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <h4 class="card-header text-center text-white fw-bold" style="background-color: #109E92">Verifikasi Email Anda</h4>
                {{-- <div class="card-header">{{ __('Verify Your Email Address') }}
            </div> --}}

            <div class="card-body">
                @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Kami berhasil email verifikasi yang baru ke email anda, silahkan periksa untuk melakukan verifikasi.') }}
                </div>
                @endif
                Periksa email anda kemudian klik link verifikasi untuk melanjutkan ke halaman login.
                Jika anda tidak menerima email verifikasi dari kami,
                {{-- {{ __('Before proceeding, please check your email for a verification link.') }} --}}
                {{-- {{ __('If you did not receive the email') }}, --}}
                <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                    @csrf
                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-decoration-none">{{ __('Klik disini untuk meminta link verifikasi yang baru') }}</button>.
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
