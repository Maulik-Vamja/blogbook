@extends('layouts.backend.app')

@section('title','Post Page')

@push('css')
     
@endpush

@section('content')

 <!-- ------------------ INSIDE CONTENT START----------- -->
 <div class="content">
    <div class="container-fluid">
        
        <a href=" {{ route('admin.post.index') }} " class="btn btn-primary">
            <span class="btn-label">
                <i class="material-icons">keyboard_arrow_left</i>
            </span>Back
        </a>
        @if ($post->is_approved == false)
        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#exampleModal">
            <i class="material-icons">done</i>
            <span>Approve</span>
            </button>
        <!--============Model=============-->
        <div class="modal fade" style="margin-top: 120px;" id="exampleModal" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <button type="button" class="btn btn-success" id="" onclick="ApprovePost({{ $post->id }})">Approve</button>
                </div>
            </div>
            </div>
        </div>
        <form id="approve-from" method="POST" action=" {{ route('admin.post.approve',$post->id) }}">
            @csrf
            @method('PUT')
        </form>
        @else
        <button type="button" class="btn btn-success pull-right" disabled>
            <i class="material-icons">done</i>
            <span>Approved</span>
              </button>

        @endif
      
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">library_books</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Post</h4>
                        
                        <div>
                            <h3><strong> {{ $post->title }} </strong></h3>
                            <p>
                            Posted By 
                                <strong> {{ $post->user->name }} </strong>
                                on {{ $post->created_at->toFormattedDateString() }}
                            </p>
                        </div>
                        <hr>
                        <div class="body">
                            <h5>
                            {!! $post->body !!}
                            </h5>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-8 -->

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Categories</h4>
                        <div class="body" style="line-height:28px;">
                        @foreach ($post->categories as $categories)
                            <span class="label label-rose " style="margin: 5px;"> {{ $categories->name }} </span>
                        @endforeach
                    </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-4 -->

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="red">
                        <i class="material-icons">local_offer</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Tags</h4>
                        
                        <div class="body" style="line-height:28px;">
                            @foreach ($post->tags as $tags)
                            <span class="label label-danger" style="margin: 5px;"> {{ $tags->name }} </span>
                            @endforeach
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-4 -->

            <div class="col-md-4 pull-right">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="purple">
                        <i class="material-icons">perm_media
                        </i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Featured Image
                        </h4>
                        
                        <div class="body">
                            <img class="img-responsive thumbnail" src=" {{ Storage::disk('public')->url('posts/'.$post->image) }} "/>
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-4 -->
        </div>
        <!-- end row -->
    </div>
</div>


@endsection

@push('js')
<script>
    function ApprovePost(id)
            {
                document.getElementById('approve-from').submit();
            }
        </script>
@endpush

