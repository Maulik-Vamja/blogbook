@extends('layouts.frontend.app')

@section('title',"$user->name")


@push('css')

@endpush

@section('content')
<div class="profile-page">
	<div class="page-header header-filter" data-parallax="true" style="background-image: url( {{ asset('public/assets/frontend/img/man1.jpg') }} );"></div>
	<div class="main main-raised">
		<div class="profile-content">
            <div class="container">

                <div class="row">
                        <div class="col-xs-6 col-xs-offset-3">
                        <div class="profile">
                                <div class="avatar">
                                    @if ($user->image == 'default.png')
                                    <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " alt="Circle Image" class="img-circle img-responsive img-raised">
                                    @else
                                    <img src="{{Storage::disk('public')->url('profile/'.$user->image)}}" alt="Circle Image" class="img-circle img-responsive img-raised">
                                    @endif
                                </div>
                                <div class="name">
                                    <h3 class="title"> {{ $user->name }} </h3>
                                    <h4><strong>Followers : {{ $followers }}</strong></h4>
                                    @if ($user->id == auth()->user()->id)
                                    <button class="btn btn-lg btn-default btn-round btn-rose" onclick="Not()">Follow</button>
                                    @else
                                        @if (IsFollowing($user->id)=="follow back")
                                        <button class="btn btn-lg btn-default btn-round" onclick="processData({{ $user->id }},'follow',{{ $user->id }})">Follow Back</button>
                                        @elseif (IsFollowing($user->id)=="following")
                                        <button class="btn btn-lg btn-rose btn-default btn-round"  onclick="processData({{ $user->id }},'unfollow',{{ $user->id }})">Following</button>
                                        @else
                                        <button class="btn btn-lg btn-default btn-round" onclick="processData({{ $user->id }},'follow',{{ $user->id }})">Follow</button>
                                        @endif
                                    @endif
                                        
                                </div>
                            </div>
                        </div>
                </div>
                <div class="description text-center">
                    <p> {{ $user->about }} </p>
                <h4><strong>Joined On {{ $user->created_at->isoFormat('Do MMMM YYYY') }}</strong></h4>
                    <h4><strong>Total Post: {{ $user->posts->count() }} </strong></h4>
                </div>
                <hr/>

                <div class="row">

                    <h3 class="text-center"><strong>Posts</strong></h3>
                    @if ($posts->count() > 0)
                    @foreach ($posts as $item)
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-blog">
                            <a href=" {{ route('post.details',$item->slug) }} ">
                            <div class="card-image">
                                    <img class="img" src=" {{ Storage::disk('public')->url('posts/'.$item->image) }} " />
                            </div>
                        
                            <div class="card-content">
                                <h4 class="card-title">
                                    <a> {{ str_limit($item->title,30) }} </a>
                                </h4>
                            </a>
                                <h6 class="card-description">
                                    {!! str_limit($item->body,150) !!}
                                </h6>
                            
                                <div class="footer">
                                    <div class="author">
                                        <a href="#pablo">
                                            @if ($item->user->image == 'default.png')
                                            <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " alt="..." class="avatar img-raised" >
                                            @else
                                            <img src=" {{ Storage::disk('public')->url('profile/'.$item->user->image) }} " alt="..." class="avatar img-raised">
                                            @endif
                                        <span><strong> {{ $item->user->name }} </strong></span>
                                        </a>
                                    </div>
                                    <div class="stats">
                                        <i class="material-icons ">favorite</i>  {{ $item->favourite_to_users->count() }}&middot;
                                        <i class="material-icons">chat_bubble</i> {{ $item->comments->count() }} &middot;
                                        <i class="material-icons">visibility</i> {{ $item->view_count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                    @endforeach    
                    @else
                        <div>
                            <div class="title h4"> 
                                <strong>This User has no any Posts.</strong>
                            </div>
                        </div>
                    @endif
                    

                </div>
            </div>
        </div>
	</div>
</div>
    @endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script>
    function Not()
    {
        Swal.fire({
        icon: 'info',
        title: 'Oops...',
        text: 'You Can Not Follow Yourself .',
        })
    }
</script>
<script>
    var header_height;
    var fixed_section;
    var floating = false;

    $().ready(function(){
        suggestions_distance = $("#suggestions").offset();
        pay_height = $('.fixed-section').outerHeight();

        $(window).on('scroll', materialKit.checkScrollForTransparentNavbar);

        // the body of this function is in assets/material-kit.js
        materialKit.initSliders();
        materialKit.initFormExtendedDatetimepickers();
    });

    $('.owl-carousel').owlCarousel({
    autoplay:1000,
    loop:true,
    margin:10,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
});

$('#btnFollow').click(function() {
  $(this).text(function(_, text) {
    return text === "Follow" ? "Following" : "Follow";
  });
  if($(this).text() == "Follow") {
    $(this).addClass('btn-default');
    $(this).removeClass('btn-rose');
  } else if($(this).text() == "Following") {
    $(this).removeClass('btn-default');
    $(this).addClass('btn-rose');
  }
});
</script>

@endpush
