@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('メールアドレスをご確認ください') }}</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('ご登録いただいたメールアドレスに確認用のリンクをお送りしました。') }}
                            </div>
                        @endif

                        <p>
                            仮登録が完了致しました。<br>
                            本登録には、以下のリンクからメール確認をして下さい。
                        </p>
                        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">{{ __('確認メールを送信する') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
