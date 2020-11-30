@extends('layouts.backend.app')

@section('title','Edit Profile Page')

@push('css')
     
@endpush

@section('content')
 
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">person</i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Edit Profile
                        </h3>
                        @if (session('succesMsg'))
                            <div class="alert alert-success" id="success-alert" role="alert">
                                {{ session('succesMsg') }}
                            </div>    
                        @endif
                        <form method="POST" action=" {{ route('admin.profile.update') }} " enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <legend>Profile Image</legend>
                                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail img-circle">
                                            @if (Auth::user()->image == 'default.png')
                                            <img src=" {{ asset('public/assets/backend/img/default.jpg') }} " alt="...">
                                            @else
                                            <img src=" {{ Storage::disk('public')->url('profile/'.Auth::user()->image) }} " alt="...">
                                            @endif
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail img-circle"></div>
                                        <div>
                                            <span class="btn btn-round btn-rose btn-file">
                                                <span class="fileinput-new">Update Photo</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input type="file" name="image" class="@error('image') is-invalid @enderror"/>
                                            </span>
                                            <br />
                                            <a href="" class="btn btn-danger btn-round fileinput-exists" data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                        </div> 
                                        @error('image')
                                            <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                    </div>
                                </div>
                
                                
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">name</label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value=" {{ Auth::user()->name }} ">
                                        @error('name')
                                    <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Username</label>
                                        <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value=" {{ Auth::user()->username }} ">
                                        @error('username')
                                    <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Email address</label>
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" readonly  value=" {{ Auth::user()->email }}">
                                        @error('email')
                                        <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                            </div>

                           
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>About Profile</label>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Write Something About Yourself.</label>
                                            <textarea class="form-control @error('email') is-invalid @enderror" name="about" rows="5"> {{ Auth::user()->about }} </textarea>
                                            @error('about')
                                            <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-rose pull-right">Update Profile</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
    }, 2000); });             
    </script>
@endpush