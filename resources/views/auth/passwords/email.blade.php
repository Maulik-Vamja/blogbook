@extends('layouts.auth.app')

@section('title','Forget Password')

@section('content')

<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black" style="background-image: url( {{ asset('public/assets/backend/img/regback.jpg') }}); background-attachment: fixed; background-size: cover; background-position: center center; min-height: 100vh;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" >
                    <div class="card card-signup" style="background-color: rgb(255, 255, 255, 0.9)" >
                                <h2 class="card-title text-center " >Forget Password ?</h2>
                                @if (session('status'))
                                <div class="container">
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                </div>
                                @endif
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf
                                    <div class="card-content">
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Email Address
                                                <small>*</small>
                                            </label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                            <span class="help-block">Required Field.</span>
                                            @error('email')
                                            <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <br/>
                                        <div class="form-footer text-center">
                                            
                                            <button type="submit" class="btn btn-round btn-rose btn-fill">{{ __('Send Password Reset Link') }}</button>

                                        </div>
                                        <div class="card-content">
                                            <p class="text-muted text-center">
                                            <strong>You will recieve Password Reset link to your Email address.</strong>
                                            </p>
                                        </div>
                                    </div>
                                    
                                </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
