@extends('layouts.backend.app')

@section('title','Post Comment')

@push('css')
    
@endpush

@section('content')

<!-- ---------------INSIDE CONTENT ---------- -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">comment</i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">All Comments &nbsp; 
                        </h3>
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
                                        <th colspan="2">Comment Info</th>
                                        <th colspan="2">Post Info</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Comment Info</th>
                                        <th colspan="2">Post Info</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($posts as $key=>$post_data)
                                    @foreach ($post_data->comments as $comment)
                                    <tr>
                                        <td>    
                                            <a href="#pablo">
                                                <img class="img-thumbnail img-responsive img-circle" src=" {{ Storage::disk('public')->url('profile/'.$comment->user->image) }}" style="max-width:60px; max-height: 60px;" />
                                            </a>
                                        </td>
                                        <td>
                                            <p>
                                                <h4><strong> {{ $comment->user->username }} </strong><small> {{ $comment->created_at->diffForHumans() }} </small></h4>
                                                <p>{{ $comment->comment }}
                                                </p>
                                                <a target="_blank" href=" {{  route('post.details',$comment->post->slug.'#btnComment') }}"><p>Replay</p></a>
                                            </p>
                                        </td>
                                        <td>    
                                            <a href="javascript::void(0)">
                                            <img class="img-thumbnail  img-responsive" src=" {{ Storage::disk('public')->url('posts/'.$comment->post->image) }} " style="max-width:80px; max-height: 80px;" />
                                            </a>
                                        </td>
                                        <td>
                                            <span>
                                                <a href=" {{ route('post.details',$comment->post->slug) }} ">
                                                <h4><strong> {{ str_limit($comment->post->title,22) }} </strong></h4>
                                                </a>
                                                <p>By {{ $comment->post->user->username }}
                                                </p>
                                            </span>
                                        </td>
                                        <td class="text-center">
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
                                                    <button type="button" class="btn btn-danger" id="" onclick="DeleteComment({{$comment->id}})">Delete</button>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                                    <form id="remove-from-{{ $comment->id }}" method="POST" action=" {{ route('author.comment.destroy',$comment->id) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </td>
                                        
                                    </tr> 
                                    @endforeach
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
<!-- -------- INSIDE CONTENT -------- -->


@endsection

@push('js')
<script type="text/javascript">
    function DeleteComment(id)
            {
                document.getElementById('remove-from-'+id).submit();
            }
    $(document).ready (function(){
        window.setTimeout(function() {
        $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 2000); });             
</script>
@endpush