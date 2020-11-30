@extends('layouts.backend.app')

@section('title','Favourite Posts')

@push('css')

@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">favorite</i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">Favourite Posts &nbsp;
                            <span class="badge"> {{ auth()->user()->favourite_posts()->count() }} </span></h3>
                        <div class="toolbar">
                            @if (session('succesMsg'))
                            <div class="alert alert-success" id="success-alert" role="alert">
                                {{ session('succesMsg') }}
                            </div>
                            @endif
                        </div>
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th><i class="material-icons" title="likes">favorite</i></th>
                                        <th><i class="material-icons" title="comments">comment</i></th>
                                        <th><i class="material-icons" title="views">visibility</i></th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Author</th>
                                        <th><i class="material-icons" title="likes">favorite</i></th>
                                        <th><i class="material-icons" title="comments">comment</i></th>
                                        <th><i class="material-icons" title="views">visibility</i></th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($posts as $key=>$post)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ str_limit($post->title,20) }}</td>
                                        <td>{{ $post->user->username }}</td>
                                        <td> {{ $post->favourite_to_users()->count() }} </td>
                                        <td> {{ $post->comments()->count() }} </td>
                                        <td>{{ $post->view_count }}</td>
                                        <td class="text-center">

                                            <a href="{{ route('post.details',$post->slug) }} "
                                                class="btn btn-xs btn-primary btn-icon"><i class="material-icons"
                                                    rel="tooltip" data-placement="bottom"
                                                    title="View">visibility</i></a>
                                            <button type="button" rel="tooltip" data-placement="bottom" title="Delete"
                                                class="btn btn-xs btn-danger btn-icon" data-toggle="modal"
                                                data-target="#exampleModal_{{$key}}">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            {{--===================== model============== --}}
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
                                                                onclick="remove({{$post->id}})">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="remove-from-{{ $post->id }}" method="POST"
                                                action=" {{ route('post.favourite',$post->id) }}"
                                                style="display: none;">
                                                @csrf
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
    function remove(id)
            {
                document.getElementById('remove-from-'+id).submit();
            }
            $(document).ready (function(){
    window.setTimeout(function() {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 3000); });      
</script>
@endpush