@extends('layouts.auth.app')

@section('title','Login')

@section('content')
<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black" style="background-image: url( {{ asset('public/assets/backend/img/regback.jpg') }}); background-attachment: fixed; background-size: cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" >
                    <div class="card card-signup" style="background-color: rgba(255, 255, 255,0.9)" >
                                <h2 class="card-title text-center " >Login</h2>
                                @if (session('reset_password'))
                                <div class="alert alert-success" id="success-alert" role="alert">
                                    {{ session('reset_password') }}
                                </div>    
                                @endif
                                @if (session('status'))
                                <div class="alert alert-success" id="success-alert" role="alert">
                                    {{ session('status') }}
                                </div>    
                                @endif
                                    <form method="POST" action="{{ route('login') }}" id="LoginValidation">
                                        @csrf
                                    <div class="card-content">
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Email Address
                                                <small>*</small>
                                            </label>
                                            <input class="form-control @error('email') in-valid @enderror" value=" {{ old('email') }} " name="email" type="email" required="true" autofocus autocomplete="true"/>
                                            <span class="help-block">Please enter valid Email Address.</span>
                                            @error('email')
                                            <span class="invalid-feedback text-danger text-capitalize" role="alert">
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
                                            <span class="help-block">Enter Valid Password.</span>
                                            @error('password')
                                        <span class="invalid-feedback alert-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        </div>
                                        
                                        <div class="checkbox">
                                            @if (Route::has('password.request'))
                                            <label>
                                                <a href=" {{ route('password.request') }} " style="color: #6655ffda;">Forgot Password?</a>
                                            </label>
                                            @endif
                                            <label class="pull-right">
                                                <a href=" {{ route('register') }} " style="color: #6655ffda;">Create Account?</a>
                                            </label>
                                        </div>

                                        
                                        
                                        <div class="social text-center">

                                            <button type="submit" class="btn btn-round btn-rose btn-fill">Login</button>

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
                                    
                                </form>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
