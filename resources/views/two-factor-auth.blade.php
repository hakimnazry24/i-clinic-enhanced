@extends('master.layout')

@section('content')
    @if (session('status') == 'two-factor-authentication-enabled')
        <div class="mb-4 font-medium text-sm alert alert-primary">
            Two factor authentication enabled. Perform two auth confirmation
        </div>
    @endif

    @if (session('status') == 'two-factor-authentication-disabled')
        <div class="alert alert-success">
            Two factor authentication is disabled
        </div>
    @endif

    @if (session('status') == 'two-factor-authentication-confirmed')
        <div class="alert alert-success">
            Two factor authentication is enabled and confirmed
        </div>
    @endif

    <div class="m-20">
        <h1>Two Factor Authentication Setting</h1>
        <form method="POST" action="/user/two-factor-authentication">
            @csrf

            @if (auth()->user()->two_factor_secret === null)
                @method('POST')
                <button class="btn btn-primary">Enable</button>
            @else
                @method('DELETE')
                <button class="btn btn-danger">Disable</button>
            @endif
        </form>



        @if (auth()->user()->two_factor_secret !== null)
            Please confirm two factor authentication
            <form action="/user/confirmed-two-factor-authentication" method="post">
                @csrf
                <input type="text" name="code" id="code" placeholder="Enter code" class="form-control">
                <button class="btn btn-primary" type="submit">Confirm</button>
            </form>
            <p class="mt-10">Scan the following QR code</p>
            {!! auth()->user()->twoFactorQrCodeSvg() !!}

            <div class="mt-10">
                <p>Here is the recovery code</p>
                {{ auth()->user()->recoveryCodes()[1] }}
            </div>
        @endif
    </div>
@endsection
