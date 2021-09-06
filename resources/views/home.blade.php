@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                    </div>
                </div>

                <br>

                <div class="d-flex flex-wrap">
                    <style>
                        .home_content {
                            width: 100%;
                            margin: 0;
                            padding: .3rem;
                            text-decoration: none;
                            color: #333;
                        }
                        .home_content:hover{
                            color: #666;
                        }

                        @media screen and (min-width:576px) {
                            .home_content {
                                width: 50%;
                            }
                        }

                        .home_content>div {
                            width: 100%;
                            height: 100%;
                            padding: .6rem;
                            background: #fff;
                            border: 1px solid #ccc;
                            border-radius: .3rem;
                        }
                        .home_content>div:hover{
                            background: #eee;
                            transition: .3s;
                        }

                        .home_content h3,
                        .home_content p{
                            text-align: center;
                            margin: .3em auto;
                        }

                    </style>

                    <a class="home_content" href="#">
                        <div>
                            <h3>コンテンツ１</h3>
                            <p>説明説明説明説明説明説明説明説明説明説明</p>
                        </div>
                    </a>
                    <a class="home_content" href="#">
                        <div>
                            <h3>コンテンツ２</h3>
                            <p>説明説明説明説明説明説明説明説明説明説明</p>
                        </div>
                    </a>

                </div>
            </div>
        </div>
    </div>
@endsection
