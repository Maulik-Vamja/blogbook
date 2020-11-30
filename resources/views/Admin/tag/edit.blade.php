@extends('layouts.backend.app')

@section('title','Edit Tag')

@push('css')
    
@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">local_offer</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Edit Tag</h4>
                        <form method="POST" action=" {{ route('admin.tag.update',$tag->id) }} ">
                            @csrf
                            @method('PUT')
                            <div class="form-group label-floating">
                                <label class="control-label">Enter Tag Name</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $tag->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-fill btn-rose">UPDATE</button>
                            <a href=" {{ route('admin.tag.index') }} " class="btn btn-fill btn-primary">BACK</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    
@endpush 
