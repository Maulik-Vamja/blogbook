@extends('layouts.auth.app')

@section('title','Register')

@section('content')

<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black" style="background-image: url({{ asset('public/assets/backend/img/regback.jpg') }}); background-attachment: fixed; background-size: cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" >
                    <div class="card card-signup" style="background-color: rgb(255, 255, 255,0.9)" >
                                <h2 class="card-title text-center " >Register</h2>
                                    <form method="POST" id="RegisterValidation" action="{{ route('register') }}">
                                        @csrf
                                    <div class="card-content">
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Name
                                                <small>*</small>
                                            </label>
                                            <input class="form-control @error('name') is-invalid @enderror" name="name" id="registerName" type="text" 
                                            minLength="3" required="true" />
                                            <span class="help-block">Name with minimun 3 Latters required.</span>
                                        </div>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Email Address
                                                <small>*</small>
                                            </label>
                                            <input class="form-control @error('email') is-invalid @enderror" name="email" type="email" required="true" />
                                            <span class="help-block">Please enter valid Email Address.</span>
                                        </div>
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Password
                                                <small>*</small>
                                            </label>
                                            <input class="form-control @error('email') is-invalid @enderror" name="password" id="registerPassword" type="password" 
                                            minLength="8" required="true" />
                                            <span class="help-block">Password with minimun 8 letters.</span>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Confirm Password
                                                <small>*</small>
                                            </label>
                                            <input class="form-control" name="password_confirmation" id="registerPasswordConfirmation" type="password" required="true" equalTo="#registerPassword" />
                                            <span class="help-block">Password & Confirm Password should be same.</span>
                                        </div>
                                        <br/>
                                        <div class="form-footer text-center">
                                            
                                            <button type="submit" class="btn btn-round btn-rose btn-fill">Register</button>

                                            <div class="social text-center">
                                                <h4 style="color: rgba(0, 0, 0, 0.664);"><strong>OR</strong></h4>
                                                <h4 class="text-center" >Sign in With</h4>
                                                <a href=" {{ url('/redirectToTwitter') }} " class="btn btn-just-icon btn-round btn-twitter">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                                <a href=" {{ url('/redirect') }} " class="btn btn-just-icon btn-round btn-google">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                                <a href=" {{ url('/redirectToFB') }} " class="btn btn-just-icon btn-round btn-facebook">
                                                    <i class="fa fa-facebook"> </i>
                                                </a> 
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <h4 class="text-center">
                                        <a href=" {{ route('login') }} " class="" style="color: #3722f1da;">Already a member?</a>
                                    </h4>
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
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                    {{ __('Register') }}
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
