@extends('layouts.backend.app')

@section('title','Post Page')

@push('css')

@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">library_books</i>
                    </div>

                    <div class="card-content">
                        <h4 class="card-title h3">All Posts &nbsp;
                            <span class="badge"> {{ $posts->count() }} </span></h4>
                        <div class="toolbar">
                            <a href=" {{ route('author.post.create') }} " class="btn btn-rose">
                                <i class="material-icons">add</i>
                                Add New Post
                            </a>
                        </div>
                        @if (session('succesMsg'))
                        <div class="alert alert-success" id="success-alert" role="alert">
                            {{ session('succesMsg') }}
                        </div>
                        @endif

                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Post Title</th>
                                        <th><i class="material-icons">visibility</i></th>
                                        <th>Approval</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="disabled-sorting text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Post Title</th>
                                        <th><i class="material-icons">visibility</i></th>
                                        <th>Approval</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th class="disabled-sorting text-center">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if ($posts->count() > 0)
                                    @foreach ($posts as $key => $post_data)
                                    <tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td> {{ str_limit($post_data->title,30) }} </td>
                                        <td>{{ $post_data->view_count }}</td>
                                        <td>
                                            @if ( $post_data->is_approved == true )
                                            <span class="btn btn-sm btn-success">Approved</span>
                                            @else
                                            <span class="btn btn-sm btn-danger">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ( $post_data->status == true )
                                            <span class="btn btn-sm btn-success">Published</span>
                                            @else
                                            <span class="btn btn-sm btn-danger">Pending</span>
                                            @endif

                                        </td>
                                        <td> {{ $post_data->created_at }} </td>
                                        <td class="text-center">
                                            <a href=" {{ route('author.post.show',$post_data->id) }} "
                                                class="btn btn-sm btn-primary btn-icon"><i class="material-icons"
                                                    rel="tooltip" data-placement="bottom"
                                                    title="View">visibility</i></a>
                                            <a href=" {{ route('author.post.edit',$post_data->id) }} "
                                                class="btn btn-sm btn-warning btn-icon"><i class="material-icons"
                                                    rel="tooltip" data-placement="bottom" title="Edit">edit</i></a>
                                            <button type="button" rel="tooltip" data-placement="bottom" title="Delete"
                                                class="btn btn-sm btn-danger btn-icon" data-toggle="modal"
                                                data-target="#exampleModal_{{$key}}">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <!------------ Modal ------------------>
                                            <div class="modal fade" style="margin-top: 120px;"
                                                id="exampleModal_{{$key}}" tabindex="1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content" style="padding-left:0px;">
                                                        <div class="modal-header">
                                                            <h2 class="modal-title text-center" id="exampleModalLabel">
                                                                Are You Sure?</h2>
                                                        </div>
                                                        <h4 class="modal-body text-center">
                                                            You Want To Delete It?
                                                        </h4>
                                                        <div class="modal-footer text-center">
                                                            <button type="button" class="btn btn-warning"
                                                                data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-danger" id=""
                                                                onclick="DeletePost({{$post_data->id}})">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="delete-from-{{ $post_data->id }}" method="POST"
                                                action=" {{ route('author.post.destroy',$post_data->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>

                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="text-center">
                                        <td colspan="7">
                                            <h4>Sorry,You don't have any Post. Create Your First Blog Post.</h4>
                                        </td>
                                    </tr>
                                    @endif
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
    $("#success-alert").fadeTo(500, 0).slideUp(2000, function(){
        $(this).remove(); 
    });
}, 2000); });             
</script>
@endpush