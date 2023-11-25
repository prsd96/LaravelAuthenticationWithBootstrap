@extends('layout.main')

@section('title', 'Login')

@section('content')
<div class="container mt-5">
    
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">{{ __('Verify Email') }}</div>
                
                <div class="card-body">
                    <p class="text-center">
                        Kindly verify your email.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
