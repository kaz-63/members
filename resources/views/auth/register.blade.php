@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center pb-3 pt-sm-2 pb-sm-4 py-md-5">
        <style>
            .title_logo_main {
                width: 66%;
                max-width: 500px;
            }

        </style>
        <img class="title_logo_main" src="{{ url('/') }}/img/logo.png" alt="">
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="nav nav-tabs login-reg-form-tab">
                <li class="nav-item ">
                    <a class="nav-link " href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link active" >{{ __('Register') }}</a>
                </li>
            </ul>
            <div class="card" style="
                            border-top: none;
                            border-radius: 0 0 .25rem .25rem;
                        ">
                <div class="card-body">

                    {{-- <p class="fs-4 my-5 text-center">現在新規登録を受け付けておりません</p> --}}

                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group mb-3 row">
                            <label for="name" class="col-md-4 col-form-label text-md-start">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label for="email" class="col-md-4 col-form-label text-md-start">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label for="password" class="col-md-4 col-form-label text-md-start">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-start">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
