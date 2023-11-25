@extends('layout.main')

@section('title', 'Reset Password')

@section('content')
<div class="container mt-5">

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="row p-3 align-items-center">
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">{{ __('Reset Password for')}} <b>{{$email}}</b> </div>

                <div class="card-body">
                    @if (!session('success'))
                    <form method="POST" action="{{ route('updatePassword') }}">
                        @csrf

                        <input type="hidden" class="form-control" name="token" value="{{ encrypt($token) }}"/>
                        <input type="hidden" class="form-control" name="email" value="{{ encrypt($email) }}"/>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
