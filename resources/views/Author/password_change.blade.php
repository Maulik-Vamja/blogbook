@extends('layouts.backend.app')

@section('title','Change Password')

@push('css')
<style>
    small {
        color: red;
    }
</style>
@endpush

@section('content')


<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form id="RegisterValidation" action=" {{ route('author.password.update') }} " method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header card-header-icon" data-background-color="rose">
                            <i class="material-icons">lock</i>
                        </div>
                        @if (session('succesMsg'))
                        <div class="alert alert-success" id="success-alert" role="alert">
                            {{ session('succesMsg') }}
                        </div>
                        @endif

                        <div class="card-content">
                            <h3 class="card-title">Update Password</h3>
                            @if (session('ErrorMsg'))
                            <div class="alert alert-danger" id="success-alert" role="alert">
                                {{ session('ErrorMsg') }}
                            </div>
                            @endif
                            <div class="form-group label-floating">
                                <label class="control-label">
                                    Enter Old Password
                                    <small>*</small>
                                </label>
                                <input class="form-control @error('old_password') is-invalid @enderror"
                                    name="old_password" id="registerPassword" type="password" required="true" />
                                @error('old_password')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                            <div class="form-group label-floating">
                                <label class="control-label">
                                    Enter New Password
                                    <small>*</small>
                                </label>
                                <input class="form-control @error('password') is-invalid @enderror" name="password"
                                    id="registerPassword" type="password" />
                                @error('password')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group label-floating">
                                <label class="control-label">
                                    Enter Confirm Password
                                    <small>*</small>
                                </label>
                                <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" id="registerPasswordConfirmation" type="password"
                                    equalTo="#registerPassword" />
                                @error('password_confirmation')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="category form-category" style="color:red;">
                                <small>*</small> Required fields</div>
                            <div class="form-footer text-left">
                                <button type="submit" class="btn btn-rose btn-fill">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>


@endsection


@push('js')
<script>
    $(document).ready (function(){
        window.setTimeout(function() {
        $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 4000); });             
</script>
@endpush