@extends('layouts.backend.app')

@section('title','Advertisment Offer')

@push('css')
     
@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Create New Offer</h4>
                        <div class="toolbar">
                            
                        </div>
                        <div class="container-fluid">
                        <div class="row text-center">
                            <form method="POST" action=" {{ route('admin.ads.store') }} ">
                                {{ csrf_field() }}
                                <div class="col-md-7 col-md-offset-2">
                                    <div class="form-group label-floating ">
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Enter Offer Title">
                                    </div>
                                    @error('title')
                                    <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                

                                <div class="col-md-7 col-md-offset-2">
                                    <div class="form-group label-floating ">
                                        <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="Enter Offer Price">
                                    </div>
                                    @error('price')
                                    <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-5 col-md-offset-3">
                                    <select class="selectpicker form-control @error('time') is-invalid @enderror" name="time" id="" data-style="btn btn-rose" >
                                        <option value="0" disabled selected>--Select Offer Time--</option>
                                        <option value="0">Month</option>
                                        <option value="1">Year</option>
                                    </select>
                                    @error('time')
                                    <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-5 col-md-offset-3">
                                    <select class="selectpicker form-control @error('time') is-invalid @enderror" name="month" id="" data-style="btn btn-rose" >
                                        <option value="0" disabled selected>--Select Month for Expirey Time--</option>
                                        @for ($i = 1; $i < 7; $i++)
                                        <option value=" {{ $i }} "> {{ $i }} </option>    
                                        @endfor
                                    </select>
                                    @error('time')
                                    <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-7 col-md-offset-2" style="margin-top: 6px;">
                                    <button type="submit" value="" class="btn btn-lg btn-rose btn-round" onclick="" id="payBtn">Submit</button>
                                </div>
                                
                            </form>
                                
                            </div>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>

@endsection

@push('js')
    
@endpush