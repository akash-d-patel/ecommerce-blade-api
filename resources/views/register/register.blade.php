{{-- Extends layout --}}
@extends('layout.login')
{{-- Content --}}
@section('content')
<!--begin::Login-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat" style="background-image: url('{{ asset('media/bg/bg-3.jpg')}}');">
            <div class="login-form text-center p-7 position-relative overflow-hidden">
                <div class="d-flex flex-column-fluid flex-column flex-center">
                    <!--begin::Signin-->
                    <div class="login-form login-signin py-11">
                        <!--begin::Login Header-->
                        <div class="d-flex flex-center mb-15">
                            <h1>{{config('app.name')}}</h1>
                        </div>

                        <!--begin::Form-->
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <!--begin::Form-->
                            <h3>Sign Up</h3>
                            <div class="text-muted font-weight-bold">Enter your details to create your account</div>
                    </div>
                    <div class="form-group mb-5">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Fullname" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                        <input class="form-control @error('email') is-invalid @enderror" type="text" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Password" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus />
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-5">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('') }}</label>
                        <input class="form-control @error('password') is-invalid @enderror" type="password" placeholder="Confirm Password" name="password_confirmation" value="{{ old('password') }}" required autocomplete="password" autofocus />
                        @error('password-confirm')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mb-5 text-left">
                        <div class="checkbox-inline">
                            <label class="checkbox m-0">
                                <input type="checkbox" name="agree" />
                                <span></span>
                                I Agree the <a href="#" class="font-weight-bold ml-1">terms and conditions</a>.
                            </label>
                        </div>
                        <div class="form-text text-muted text-center"></div>
                    </div>
                    <div class="form-group d-flex flex-wrap flex-center mt-10">
                        <button id="kt_login_signup_submit" type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-2">
                            {{ __('Sign Up') }}
                        </button>
                        <button id="kt_login_signup_cancel" class="btn btn-light-primary font-weight-bold px-9 py-4 my-3 mx-2" onclick='window.location.href="{{route('login')}}"'>Cancel</button>
                    </div>
                    </form>
                </div>
                <!--end::Login Sign up form-->
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