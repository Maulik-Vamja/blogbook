@extends('layouts.frontend.app')

@section('title',"$posts->title")


@push('css')

@endpush

@section('content')

<div class="page-header header-filter" data-parallax="true" style="background-image: url(' {{ Storage::disk('public')->url('posts/'.$posts->image) }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h1 class="title"> {{ $posts->title }} </h1>
                <br />
                <a href="#readarticle" class="btn btn-rose btn-round btn-lg">
                    <i class="material-icons">format_align_left</i> Read Article
                </a>
            </div>
        </div>
    </div>
</div>
<!-- ==========Post Detail============================= -->
<div class="main main-raised" id="readarticle">
    <div class="container-fluid">
        <div class="section section-text">
            <div class="row">
                
                <div class="col-md-10 col-md-offset-1">
                    <p class="author">
                        By <a href=" {{ route('profile.index',$posts->user->username) }} "><strong> {{ $posts->user->name }} </strong></a>, {{ $posts->created_at->diffForHumans() }}
                    </p>
                </div>
                <div class="col-md-10 col-md-offset-1">
                    <h3 class="title">Content:</h3>
                    <h4> {!! html_entity_decode($posts->body) !!} </h4>
                </div>
            </div>
        </div>

        <div class="section section-blog-info">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="blog-tags lbl-spacing">
                                <h4><strong>Tags : </strong></h3>
                                @foreach ($posts->tags as $tags)
                                <a href=" {{ route('tag.post',$tags->slug) }} "><span class="label label-danger h6">{{ $tags->name }}</span></a>
                                @endforeach 
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="blog-tags lbl-spacing">
                                <h4><strong>Categories : </strong></h3>
                                    @foreach ($posts->categories as $category)
                                    <a href=" {{ route('category.post',$category->slug) }} "><span class="label label-rose h6">{{ $category->name }}</span></a>
                                    @endforeach
                                
                            </div>
                        </div>
                    </div>

                    <hr />

                    <div>
                        <div class="pull-left">
                            <a href="javascript::void(0)" class="btn btn-facebook btn-round pull-right">
                                <i class="material-icons">visibility</i> {{ $posts->view_count }}
                            </a>
                            <a href="#btnComment" class="btn btn-primary btn-round pull-right">
                                <i class="material-icons">comment</i> {{ $posts->comments->count() }}
                            </a>
                            @guest
                            <a href="javascript::void(0)">
                                <button onclick="fav()" type="button" class="btn btn-default btn-round pull-right" >
                                <i class="material-icons">favorite</i> {{ $posts->favourite_to_users()->count() }}</button>
                            </a>
                            @else
                            <a href="javascript::void(0)" class="btn btn-default btn-round pull-right {{ !Auth::user()->favourite_posts->where('pivot.post_id',$posts->id)->count()==0 ? 'btn-rose' : '' }}" onclick="event.preventDefault();document.getElementById('favourite-from-{{ $posts->id }} ').submit(); " >
                                <i class="material-icons">favorite</i> {{ $posts->favourite_to_users()->count() }}
                            </a>
                            <form method="POST" action=" {{ route('post.favourite',$posts->id) }} " id="favourite-from-{{ $posts->id }} ">
                                @csrf
                            </form>
                            @endguest
                            
                        </div>
                        <div class="pull-right">
                            <br>
                            <div class="sharethis-inline-share-buttons"></div>
                        </div>
                    </div>
                    <div class="col-md-10 col-md-offset-1">
                        <div class="card card-profile card-plain">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="card-avatar">
                                        <a href=" {{ route('profile.index',$posts->user->username)}} ">
                                            @if ($posts->user->image == 'default.png')
                                            <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " alt="..." class="img">
                                            @else
                                            <img class="img" src=" {{ Storage::disk('public')->url('profile/'.$posts->user->image) }} ">
                                            @endif
                                            
                                        </a>
                                    <div class="ripple-container"></div></div>
                                </div>
                                <div class="col-md-8">
                                    <h4 class="card-title"> {{ $posts->user->name }} </h4>
                                    <p class="description"> {{ $posts->user->about }} </div>
                                <div class="col-md-2">
                                    @guest
                                        <button class="btn btn-default pull-right btn-round btn-rose" onclick="follow()">Follow</button>
                                    @else
                                        @if (IsFollowing($posts->user->id)=="follow back")
                                        <button class="btn btn-default pull-right btn-round"  onclick="processData({{ $posts->user->id }},'follow',{{ $posts->user->id }})">Follow</button>
                                        @elseif (IsFollowing($posts->user->id)=="following")
                                        <button class="btn btn-default pull-right btn-rose btn-round" onclick="processData({{ $posts->user->id }},'unfollow',{{ $posts->user->id }})">Following</button>
                                    @endif
                                    @endguest
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
<!-- comment Section -->
        <div class="section section-comments">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="media-area">
                        <h3 class="title text-center"> {{ $posts->comments->count() }} Comments</h3>
                        @if ($posts->comments->count() > 0)
                        @foreach ($posts->comments as $comment)
                        <div class="media">
                            <a class="pull-left" href=" {{ route('profile.index',$comment->user->username) }} ">
                                <div class="avatar">
                                    <img class="media-object" src="
                                    @if ($comment->user->image == 'default.png')
                                        {{ asset('public/assets/backend/img/default-avatar.png') }}
                                    @else
                                    {{ Storage::disk('public')->url('profile/'.$comment->user->image) }} 
                                    @endif
                                    
                                    " alt="..."/>
                                </div>
                            </a>
                            <div class="media-body">
                            <h4 class="media-heading">{{ $comment->user->name }}<small>&middot; {{ $comment->created_at->diffForHumans() }}</small></h4>
                                <h6 class="text-muted"></h6>

                                <p> {{ $comment->comment }} </p>

                                <div class="media-footer">
                                    <a href="#btnComment" class="btn btn-primary btn-simple pull-right" rel="tooltip" title="Reply to Comment">
                                        <i class="material-icons">reply</i> Reply
                                    </a>
                                </div>
                            </div>
                        </div>    
                        @endforeach                      
                        @else
                            <div class="title h5">
                                <strong>Still There has no any Commented on this post. You will be the First.</strong>
                            </div>
                        @endif
                    </div>
                    <h3 class="title text-center" id="btnComment">Post your comment</h3>
                    @if (session('commentMsg'))
                            <div class="alert alert-success" style="border-radius: 10px;" id="success-alert" role="alert">
                                {{ session('commentMsg') }}
                            </div>    
                        @endif
                    @guest
                        <p> To Add a new Comment..You need to login First. <a href=" {{ route('login') }} " >Click Here To Login.</a>
                        </p>
                    @else
                    <form method="POST" action=" {{ route('comment.store',$posts->id) }} ">
                        {{ csrf_field() }}
                    <div class="media media-post">
                        <a class="pull-left author" href="#pablo">
                            <div class="avatar">
                                <img class="media-object" alt="64x64" src="
                                @if ( Auth::user()->image == 'default.png')
                                {{ asset('public/assets/backend/img/default-avatar.png') }}
                                @else
                                {{ Storage::disk('public')->url('profile/'.Auth::user()->image) }} 
                                @endif
                                
                                ">
                            </div>
                        </a>
                        <div class="media-body">
                            <textarea class="form-control" name="comment" placeholder="Write some nice stuff or nothing..." rows="6"></textarea>
                            <div class="media-footer">
                                <button type="submit" class="btn btn-rose btn-round btn-wd pull-right">Post Comment</button>
                            </div>
                        </div>
                    </div> <!-- end media-post -->
                    </form>
                    @endguest
                </div>
            </div>
        </div>

    </div>
</div>
<!-- ===================Latest Post======================= -->
<div class="blogs-1" id="blogs-1">
    <div class="container">
        <div class="row">
            <h2 class="title text-center">Latest Blogs</h2>
@foreach ($random as $random_post)
<div class="col-md-6 col-lg-4">
    <div class="card card-blog">
        <a href=" {{ route('post.details',$random_post->slug) }} ">
        <div class="card-image">
            
                <img class="img" src=" {{ Storage::disk('public')->url('posts/'.$random_post->image) }} " />
        </div>
        <div class="card-content">
            <h4 class="card-title">
                {{ str_limit($random_post->title,30) }} 
            </h4>
        </a>
            <h6 class="card-description">
                {!! str_limit($random_post->body,150) !!}
            </h6>
            <div class="footer">
                <div class="author">
                    <a href=" {{ route('profile.index',$random_post->user->username ) }} ">
                        @if ($random_post->user->image == 'default.png')
                        <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " alt="..." class="avatar img-raised">
                        @else
                        <img src=" {{ Storage::disk('public')->url('profile/'.$random_post->user->image) }} " alt="..." class="avatar img-raised">
                        @endif
                    
                    <span><strong> {{ $random_post->user->name }} </strong></span>
                    </a>
                </div>
                <div class="stats">
                    <i class="material-icons">favorite</i> {{ $random_post->favourite_to_users()->count() }} &middot;
                    <i class="material-icons">chat_bubble</i> {{ $random_post->comments()->count() }} &middot;
                    <i class="material-icons">visibility</i> {{ $random_post->view_count }}
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
        </div>
    </div>
    </div>

<!-- ====================Latest Post======================= -->

@endsection

@push('js')
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=5e95c039d0a4ec0011032371&product=inline-share-buttons" async="async"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script type="text/javascript">
    function fav()
    {
        Swal.fire({
        icon: 'info',
        title: 'Oops...',
        text: 'Sorry, To Add This Post As a Favourite , You need To login First..!',
        })
    }
    function follow()
    {
        Swal.fire({
        icon: 'info',
        title: 'Oops...',
        text: 'To Follow this user.., You need To login First..!',
        })
    }
</script>
@endpush