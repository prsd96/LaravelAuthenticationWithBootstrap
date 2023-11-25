@extends('layout.main')

@section('title', 'Login')

@section('content')
<div class="container mt-5">
    
    @if (session('message'))
    <div class="alert alert-{{ session('type') }}">
        {{ session('message') }}
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
                <div class="card-header text-center">{{ __('Login') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('checkUserLogin') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
                    </form>
                </div>
                
                <div class="card-footer">
                    <div class="text-center">
                        <a href="{{ route('forgotPassword') }}">Forgot your password?</a>
                        <br>
                        <a href="{{ route('register') }}">Don't have an account? Register here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
