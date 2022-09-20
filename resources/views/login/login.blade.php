{{-- Extends layout --}}
@extends('layout.login')
{{-- Content --}}
@section('content')
    <div class="d-flex flex-column flex-root">
            <!--begin::Login-->
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('media/bg/bg-3.jpg')}}');">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
            
                <!--begin::Login Header-->
                <div class="d-flex flex-center mb-15">
                    <h1>{{config('app.name')}}</h1>
                </div>
                <!--end::Login Header-->

                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-20">
                    <form method="POST" action="{{ route('login') }}">
                            @csrf
                        <h3>Sign In To Admin</h3>
                        <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                    </div>
                    <form class="form" id="kt_login_signin_form">
                    <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
                            <div class="checkbox-inline">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                            </label>
                            </div>

                            @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{config('app.url')}}/forgot">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                        </div>
                        <button type="submit" class="btn btn-primary">
                                        {{ __('Sign In') }}
                                    </button>
                    </form>
                    <div class="mt-10">
                        <span class="opacity-70 mr-4">
                            Don't have an account yet?
                        </span>
                        <a href="{{config('app.url')}}/register" class="text-primary font-weight-bolder" id="kt_login_signup">Sign Up!</a></span>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection
{{-- Styles Section --}}
@section('styles')
<link href="{{ asset('plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

{{-- Scripts Section --}}
@section('scripts')
{{-- vendors --}}
<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}" type="text/javascript"></script>

{{-- page scripts --}}
<script src="{{ asset('js/pages/crud/datatables/basic/basic.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/app.js') }}" type="text/javascript"></script>
@endsection