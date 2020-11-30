@extends('layouts.backend.app')

@section('title','Advertisment Post')

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
                        <h4 class="card-title">Advertisements &nbsp; 
                            <span class="badge"> {{ $posts->count() }} </span></h4>
                        @if (session('succesMsg'))
                            <div class="alert alert-success" id="success-alert" role="alert">
                                {{ session('succesMsg') }}
                            </div>    
                        @endif
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>AD Image</th>
                                        <th>Link</th>
                                        <th>Author Name</th>
                                        <th>Offer</th>
                                        <th>Expired at</th>
                                        <th>Payment Status</th>
                                        <th>Total Payment</th>
                                        <th class="disabled-sorting ">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>AD image</th>
                                        <th>Link</th>
                                        <th>Author Name</th>
                                        <th>Offer</th>
                                        <th>Expired at</th>
                                        <th>Payment Status</th>
                                        <th>Total Payment</th>
                                        <th class="disabled-sorting ">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($posts as $key => $item)
                                    <tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td>    
                                            <a href="#pablo">
                                                <img class="img-thumbnail  img-responsive" src=" {{ Storage::disk('public')->url('ads/'.$item->image) }}" style="max-width:80px; max-height: 80px;" />
                                            </a>
                                        </td>
                                        <td> {{ $item->link }} </td>
                                        <td> {{ $item->user->name }} </td>
                                        <td> {{ $item->offer->price }} INR/
                                        @if ($item->offer->time == true)
                                            Month
                                        @else
                                            Year
                                        @endif
                                        </td>
                                        <td>{{ $item->expire_time }}</td>
                                        <td>
                                            @if ($item->trans_status == true)
                                            <span class="btn btn-xs btn-success">Succesfull</span>
                                            @else
                                            <span class="btn btn-xs btn-danger">Pending</span>
                                            @endif
                                        </td>
                                        <td> {{ $item->total_price }}/- INR </td>
                                        <td class="">
                                            <button type="button"  rel="tooltip" data-placement="bottom" title="Delete" class="btn btn-sm btn-danger btn-icon" data-toggle="modal" data-target="#exampleModal_{{$key}}">
                                                <i class="material-icons">delete</i>
                                            </button>
                                <!------------ Modal ------------------>
                                            <div class="modal fade" style="margin-top: 120px;" id="exampleModal_{{$key}}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog"  role="document">
                                                <div class="modal-content" style="padding-left:0px;">
                                                    <div class="modal-header">
                                                    <h2 class="modal-title text-center" id="exampleModalLabel">Are You Sure?</h2>
                                                    </div>
                                                    <h4 class="modal-body text-center">
                                                    You Want To Delete It?
                                                    </h4>
                                                    <div class="modal-footer text-center">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-danger" id="" onclick="DeletePost({{$item->id}})">Delete</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div> 
                                            <form id="delete-from-{{ $item->id }}" method="POST" action=" {{ route('admin.adv_post.destroy',$item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>      
                                    @endforeach
                                    
                                </tbody>
                            </table>
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
<script>
function DeletePost(id)
        {
            document.getElementById('delete-from-'+id).submit();
        }
    </script>
<script>
$(document).ready (function(){
    window.setTimeout(function() {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 3000); });             
</script>
@endpush