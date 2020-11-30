@extends('layouts.backend.app')

@section('title','Pending Post')

@push('css')
     
@endpush

@section('content')

<!-- --------------------- INSIDE CONTENT ------------- -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">library_books</i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">All Pending Posts &nbsp; 
                            <span class="badge">10</span></h3>
                        <div class="toolbar">
                            
                        </div>
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
                                        <th>Post Title</th>
                                        <th>Author</th>
                                        <th>Approval</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Post Title</th>
                                        <th>Author</th>
                                        <th>Approval</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($posts as  $key => $post_data)
                                    <tr>
                                        
                                        <td> {{ $key+1 }} </td>
                                        <td> {{ str_limit($post_data->title,25) }} </td>
                                        <td> {{ $post_data->user->name }} </td>
                                        <td><span class="btn btn-sm btn-danger">Pending</span></td>
                                        <td>@if ( $post_data->status == true )
                                        <span class="btn btn-sm btn-success">Published</span>    
                                        @else
                                        <span class="btn btn-sm btn-danger">Pending</span>
                                        @endif</td>
                                        <td> {{ $post_data->created_at->isoFormat('Do MMMM YYYY') }} </td>
                                        <td> {{ $post_data->updated_at->isoFormat('Do MMMM YYYY') }} </td>
                                        <td class="text-right">
                                            <!--============Model=============-->
                                            <div class="modal fade" style="margin-top: 120px;" id="approvModel_{{$key}}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog"  role="document">
                                                <div class="modal-content" style="padding-left:0px;">
                                                    <div class="modal-header">
                                                    <h2 class="modal-title text-center" id="exampleModalLabel">Are You Sure?</h2>
                                                    </div>
                                                    <h4 class="modal-body text-center">
                                                    You Want to Approve This Post..?
                                                    </h4>
                                                    <div class="modal-footer text-center">
                                                    <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                                    <button type="button" class="btn btn-success" id="" onclick="ApprovePost({{ $post_data->id }})">Approve</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <form id="approve-from-{{$post_data->id}}" method="POST" action=" {{ route('admin.post.approve',$post_data->id) }}">
                                                @csrf
                                                @method('PUT')
                                            </form>
                                            <button type="button" class="btn btn-xs btn-success btn-icon"><i class="material-icons" rel="tooltip" data-placement="bottom" title="Approve" data-toggle="modal" data-target="#approvModel_{{$key}}" onclick="">done</i></button>
                                            <a href=" {{ route('admin.post.show',$post_data->id) }} " class="btn btn-xs btn-primary btn-icon"><i class="material-icons" rel="tooltip" data-placement="bottom" title="View">visibility</i></a>
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
                                                    <button type="button" class="btn btn-danger" id="" onclick="DeletePost({{$post_data->id}})">Delete</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                            <form id="delete-from-{{ $post_data->id }}" method="POST" action=" {{ route('admin.post.destroy',$post_data->id) }}">
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
<!-- /--------------------- INSIDE CONTENT ---------- -->


@endsection

@push('js')
<script>
function DeletePost(id)
        {
            document.getElementById('delete-from-'+id).submit();
        }

    function ApprovePost(id)
            {
                document.getElementById('approve-from-'+id).submit();
            }
</script>

<script>
$(document).ready (function(){
    window.setTimeout(function() {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000); });             
</script>
@endpush
