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
                <div class="card-header text-center">{{ __('Reset Your Password') }}</div>
                
                <div class="card-body">
                    <p class="text-center">
                        Kindly reset your password using the link shared over email.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
