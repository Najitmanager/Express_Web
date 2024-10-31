@extends('adminLte.auth.layout')

@section('pageTitle')
    {{ __('view.sign_in') }}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 bg-color-15 p-0 none-992 bg-img">
                <div class="info clearfix">
                    <h1>Welcome to <br><span>Nejoum Express</span></h1>
                </div>
            </div>
            <div class="col-lg-6 d-flex justify-content-center align-items-center" style="background: #fff7f7">
                <div class="login-box">
                    <div class="card card-outline card-primary">
                        <div class="card-header text-center">
                            <a href="{{ aurl('/') }}" class="mb-12">

                                <img alt="Logo"
                                    src="{{ asset('assets/lte/cargo-logo.gif') }}"
                                    style="max-width: 88px;max-height: 52px;" />
                            </a>
                        </div>
                        <div class="card-body">
                            <h3 class="widget-title">{{ __('view.LOG_IN_TO_YOUR_ACCOUNT') }}</h3>

                            @error('email')
                                <div class="mb-10 bg-light-info p-8 rounded">
                                    <div class="text-danger"> {{ $message }} </div>
                                </div>
                            @enderror

                            <form method="POST" action="{{ route('login.request') }}" novalidate="novalidate"
                                id="kt_sign_in_form">
                                @csrf
                                <div class="input-group mb-3">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="{{ __('view.Email') }}" autocomplete="off" value="" required
                                        autofocus>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-envelope"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="{{ __('view.Password') }}" autocomplete="off" required>
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
{{--                                    <div class="col-8">--}}
{{--                                        <div class="icheck-primary">--}}
{{--                                            <input type="checkbox" id="remember">--}}
{{--                                            <label for="remember" style="font-size: 13px; font-weight: normal">--}}
{{--                                                {{ __('view.remember_me') }}--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <!-- /.col -->
                                    <div class="col-12 mb-2" >
                                        <button type="submit" style="background: #ef4b22;box-shadow: 0 0 10px rgba(0, 0, 0, .2);"
                                            class="form-control btn text-white btn-block">{{ __('view.login') }}</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                            </form>

{{--                            <p class="forgot-password">--}}
{{--                                <!--begin::Link-->--}}
{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a href="{{ route('password.request') }}">--}}
{{--                                        {{ __('view.forgot_password') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                                <!--end::Link-->--}}
{{--                            </p>--}}


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>

    <style type="text/css" media="all">
        body {
            background: #FFF !important;
        }

        div.login-box {
            width: 500px;
        }

        div.login-box div.card {
            padding: 2.75rem 3.75rem !important;
            box-shadow: 0 .1rem 1rem .25rem rgba(0, 0, 0, .05) !important;
            border-radius: 0.475rem !important;
            border: 0 none !important;
        }

        div.login-box div.card div.card-body {
            padding: 24px 0 0 0 !important;
        }

        div.login-box div.card-header {
            padding: 0 !important;
            border: 0 none !important;
            margin-bottom: 24px !important;
        }

        p.forgot-password {
            text-align: center;
            padding-top: 30px;
            margin: 0 auto !important;
        }

        .widget-title {
            padding: 0 !important;
            margin: 0 auto 24px !important;
            text-align: center !important;
            position: relative !important;
            display: block !important;
            font-size: 22px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
        }

        .form-control {
            height: calc(50px + 2px) !important;
            border-radius: 5px !important;
        }

        .input-group:not(.has-validation)>.form-control:not(:last-child),
        .input-group:not(.has-validation)>.custom-select:not(:last-child),
        .input-group:not(.has-validation)>.custom-file:not(:last-child) .custom-file-label::after {
            border-top-right-radius: 0 !important;
            border-bottom-right-radius: 0 !important;
        }

        @media (max-width: 767px) {

            html,
            body {
                margin: 0 !important;
                padding: 0 !important;
                -ms-touch-action: manipulation;
                touch-action: manipulation;
                -webkit-text-size-adjust: 100%;
                -ms-text-size-adjust: 100%;
                overflow-x: hidden !important;
                width: unset !important;
                height: unset !important;
            }

            body {
                min-height: unset !important;
            }

            div.login-box {
                width: 100% !important;
                margin: 0 !important;
                padding: 0 !important;
            }

            div.login-box div.card {
                padding: 40px 24px !important;
                background: none transparent !important;
                box-shadow: none !important;

            }
        }



        /* custom styles */

        .bg-img {
            min-height: 100vh;
            position: relative;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 15px 50px;
            background: #fff;
            background: rgba(0, 0, 0, .04) url({{ asset('assets/lte/img/modern-city-with-skyscrapers.jpg') }}) top left repeat;
            z-index: 999;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .bg-img:before {
            position: absolute;
            content: '';
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgb(33 9 90/55%);
            z-index: -1;
        }

        .info {
            max-width: 610px;
            padding: 10px 30px;
        }

        .info h1 {
            color: #fff;
            margin-bottom: 20px;
            font-family: jost, sans-serif;
            font-size: 45px;
            text-transform: uppercase;
            font-weight: 600
        }

        .info h1 span {
            color: #ff574d;
        }

        .clearfix::after {
            display: block;
            clear: both;
            content: "";
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection
