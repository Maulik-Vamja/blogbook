@extends('layouts.backend.app')

@section('title','All Authors')

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
                                    <h3 class="card-title">All Authors &nbsp; 
                                        <span class="badge"> {{ $user->count() }} </span></h3>
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
                                                    <th>Name</th>
                                                    <th>Posts</th>
                                                    <th>Comments</th>
                                                    <th>Favorite Posts</th>
                                                    <th>Joined At</th>
                                                    <th class="disabled-sorting text-center">Actions</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Name</th>
                                                    <th>Posts</th>
                                                    <th>Comments</th>
                                                    <th>Favorite Posts</th>
                                                    <th>Joined At</th>
                                                    <th class="disabled-sorting text-center">Actions</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                                @foreach ($user as $key => $item)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td> {{ $item->name }} </td>
                                                    <td><span class="badge badge-primary"> {{ $item->posts_count }} </span></td>
                                                    <td> {{ $item->comments_count }} </td>
                                                    <td> {{ $item->favourite_posts_count }} </td>
                                                    <td> {{ $item->created_at->isoFormat('Do MMMM YYYY') }} </td>
                                                    <td class="text-center">
                                                        <button type="button"  rel="tooltip" data-placement="bottom" title="Delete" class="btn btn-sm btn-danger btn-icon" data-toggle="modal" data-target="#exampleModal_{{$key}}">
                                                            <i class="material-icons">delete</i>
                                                        </button>
                                                    <!------------ Modal ------------------>
                                                        <div class="modal fade" style="margin-top: 120px;" id="exampleModal_{{$key}}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog"  role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                <h2 class="modal-title text-center" id="exampleModalLabel">Are You Sure?</h2>
                                                                </div>
                                                                <h4 class="modal-body text-center">
                                                                You Want To Delete It?
                                                                </h4>
                                                                <div class="modal-footer text-center">
                                                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                                                <button type="button" class="btn btn-danger" onclick="DeleteAuthor({{ $item->id }})">Delete</button>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <form id="delete-from-{{ $item->id }}" method="POST" action=" {{ route('admin.author.destroy',$item->id)}} ">
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
function DeleteAuthor(id)
{
    document.getElementById('delete-from-'+id).submit();
}

$(document).ready (function(){
window.setTimeout(function() {
$("#success-alert").fadeTo(500, 0).slideUp(500, function(){
$(this).remove(); 
});
}, 2000); });             
</script>
@endpush