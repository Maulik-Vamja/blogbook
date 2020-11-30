@extends('layouts.backend.app')

@section('title','Post Page')

@push('css')
     
@endpush

@section('content')

 <!-- ------------------ INSIDE CONTENT START----------- -->
 <div class="content">
    <div class="container-fluid">
        
        <a href=" {{ route('author.post.index') }} " class="btn btn-primary">
            <span class="btn-label">
                <i class="material-icons">keyboard_arrow_left</i>
            </span>Back
        </a>
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
                        <div class="body" style="line-height:28px;"`>
                        @foreach ($post->categories as $categories)
                            <span class="label label-rose" style="margin: 5px;"> {{ $categories->name }} </span>
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

@endpush

