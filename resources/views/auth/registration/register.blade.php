@extends('layout.main')

@section('title', 'Register')

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
                <div class="card-header text-center">{{ __('Register') }}</div>
                
                <div class="card-body">
                    <form method="POST" action="{{route('users.store')}}">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="first_name">{{ __('First Name') }}</label>
                            <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                            @error('first_name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="last_name">{{ __('Last Name') }}</label>
                            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="mobile">{{ __('Mobile Number (10 digit Indian number)') }}</label>
                            <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile">
                            @error('mobile')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="email">{{ __('Email Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="password">{{ __('Password') }}</label>
                            
                            <div class="input-group">
                                <input id="regPasswordInput" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                                
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="regPasswordButton" onclick="passwordShowHide('regPasswordInput', 'regPasswordButton')">Show</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="password">{{ __('Confirm Password') }}</label>
                            
                            <div class="input-group">
                                <input id="regConfPasswordInput" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button" id="regConfPasswordButton" onclick="passwordShowHide('regConfPasswordInput', 'regConfPasswordButton')">Show</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary ">{{ __('Register') }}</button>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer">
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none">Already have an account? Login here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
