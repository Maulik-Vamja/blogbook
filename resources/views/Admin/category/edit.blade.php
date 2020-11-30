@extends('layouts.backend.app')

@section('title','Create Category')

@push('css')
    
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Edit Category</h4>
                        <form method="POST" action="{{ route('admin.category.update',$category->id) }} " enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group label-floating" style="margin-bottom:20px;">
                                <label class="control-label">Enter Category</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value=" {{ $category->name }} ">
                                @error('name')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div style="margin-bottom:20px;">
                                <input type="file" class="form-control-file @error('image') is-invalid @enderror"  id="" name="image">
                                @error('image')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>  
                            <button type="submit" class="btn btn-fill btn-rose">UPDATE</button>
                            <a href=" {{route('admin.category.index')}} "><button type="button" class="btn btn-fill btn-primary">BACK</button></a>
                            
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