@extends('layouts.auth.app')

@section('title','Reset Password')

@section('content')


<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black" style="background-image: url({{ asset('public/assets/backend/img/regback.jpg') }}); background-attachment: fixed; background-size: cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" >
                    <div class="card card-signup" style="background-color: rgb(255, 255, 255,0.9)" >
                                <h2 class="card-title text-center " >Reset Password</h2>
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
            
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="card-content">
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Email Address
                                                <small>*</small>
                                            </label>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                            <span class="help-block">Please enter valid Email Address.</span>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Password
                                                <small>*</small>
                                            </label>
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            <span class="help-block">Enter Valid Password.</span>
                                            @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Confirm Password
                                                <small>*</small>
                                            </label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            <span class="help-block">Confirm Password Must be same with your new password.</span>
                                        </div>
                                        <br/>
                                        <br>
                                        <div class="social text-center">
                                            <button type="submit" class="btn btn-round btn-rose btn-fill">{{ __('Reset Password') }}</button>
                                        </div>
                                        <div class="card-content">
                                            <p class="text-muted text-center">
                                            <strong>Reset Your Your old Password.</strong>
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








{{-- 
<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black" style="background-image: url( {{ asset('public/assets/backend/img/regback.jpg') }}); background-attachment: fixed; background-size: cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" >
                    <div class="card card-signup" style="background-color: rgba(255, 255, 255,1)" >
                                <h2 class="card-title text-center " >Login</h2>
                                @if (session('password_update'))
                                <div class="alert alert-success" id="success-alert" role="alert">
                                    {{ session('password_update') }}
                                </div>    
                                @endif
                                <form method="POST" action="{{ route('password.update') }}">
                                    @csrf
            
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="card-content">
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Email Address
                                                <small>*</small>
                                            </label>
                                            <input class="form-control @error('email') in-valid @enderror" value=" {{ old('email') }} " name="email" type="email" required="true" autofocus autocomplete="true"/>
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                                            <span class="help-block">Please enter valid Email Address.</span>
                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Password
                                                <small>*</small>
                                            </label>
                                            <input class="form-control @error('password') is-invalid @enderror" name="password" id="registerPassword" type="password" minLength="5" required="true" />
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            <span class="help-block">Enter Valid Password.</span>
                                            @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Confirm Password
                                                <small>*</small>
                                            </label>
                                            <input class="form-control @error('password') is-invalid @enderror" name="password" id="registerPassword" type="password" minLength="5" required="true" />
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                            <span class="help-block">Confirm Password Must be same with your new password.</span>
                                        </div>
                                        
                                        <div class="social text-center">
                                            <button type="submit" class="btn btn-round btn-rose btn-fill">{{ __('Reset Password') }}</button>
                                            {{-- <button type="submit" class="btn btn-primary">
                                                {{ __('Reset Password') }}
                                            </button> 
                                        </div>
                                    </div>
                                    
                                </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div> --}}


{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection

























{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
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
