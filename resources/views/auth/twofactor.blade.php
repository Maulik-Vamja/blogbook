@extends('layouts.auth.app')

@section('title','Two Factor Verification')

@section('content')

<div class="wrapper wrapper-full-page">
    <div class="full-page register-page" filter-color="black" style="background-image: url( {{ asset('public/assets/backend/img/regback.jpg') }}); background-attachment: fixed; background-size: cover; background-position: center center; min-height: 100vh;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3" >
                    <div class="card card-signup" style="background-color: rgb(255, 255, 255, 0.9)" >
                                <h2 class="card-title text-center " >Two Factor Authentication</h2>
                                @if(session()->has('message'))
                                    <p class="alert alert-info">
                                        {{ session()->get('message') }}
                                    </p>
                                @endif
                                <form class="form" id="RegisterValidation"  method="POST" action="{{ route('verify.store') }}">
                                    @csrf
                                    <div class="card-content">
                                        <div class="form-group label-floating">
                                            <label class="control-label">
                                                Enter Verifaction Code
                                                <small>*</small>
                                            </label>
                                            <input class="form-control {{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" name="two_factor_code" id="registerPassword" type="text" autofocus  required="true" />
                                            <span class="help-block">Required Field.</span>
                                            @if($errors->has('two_factor_code'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('two_factor_code') }}
                                            </div>
                                        @endif
                                        </div>
                                        
                                        <br/>
                                        <div class="form-footer text-center">
                                            
                                            <button type="submit" class="btn btn-round btn-rose btn-fill">Verify</button>

                                        </div>
                                        <div class="card-content">
                                            <p class="text-muted">
                                            You have received an email which contains two factor login code.
                                            <br>
                                                If you haven't received it,<strong><a href="{{ route('verify.resend') }}"> Click Here
                                                </a></strong>
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



{{-- @if(session()->has('message'))
    <p class="alert alert-info">
        {{ session()->get('message') }}
    </p>
@endif
<form method="POST" action="{{ route('verify.store') }}">
    {{ csrf_field() }}
    <h1>Two Factor Verification</h1>
    <p class="text-muted">
        You have received an email which contains two factor login code.
        If you haven't received it, press <a href="{{ route('verify.resend') }}">here</a>.
    </p>

    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">
                <i class="fa fa-lock"></i>
            </span>
        </div>
        <input name="two_factor_code" type="text" 
            class="form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" 
            required autofocus placeholder="Two Factor Code">
        @if($errors->has('two_factor_code'))
            <div class="invalid-feedback">
                {{ $errors->first('two_factor_code') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-6">
            <button type="submit" class="btn btn-primary px-4">
                Verify
            </button>
        </div>
    </div>
</form> --}}