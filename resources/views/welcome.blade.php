@extends('layouts.frontend.app')

@section('title','Home')

@push('css')

@endpush

@section('content')

<!-- slider -->
<div class="container" style="margin-top: 20px;">
    <div id="slider" class="owl-carousel owl-theme">
        @foreach ($categories as $category)
        <div class="content-area item">
            <a href=" {{ route('category.post',$category->slug) }} ">
                <img src=" {{ Storage::disk('public')->url('category/slider/'.$category->image) }}" alt="{{ $category->name }}"/>
                <span class="custom-overlay"> 
                    <span class="content-text">
                        <h4>{{ $category->name }}</h4>
                    </span>
                </span>
            </a>
        </div>
        @endforeach
    </div>
</div>
<!-- slider end -->
<br>
<!-- Post Container --> 
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="card card-raised card-form-horizontal">
                <div class="card-content">
                    <form id="postSearch" method="GET" action="">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input id="postInputSearch" type="text" placeholder="Search Your Favourite Blogs Here..." class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-rose btn-block">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class= "container blog-post-container">
    <h2 class="text-center" style="margin-bottom: 20px;"><strong>Posts</strong></h2>
    <br>
    <div id="searchPostResult">
        @if (!empty($posts))
            @for ($i = 0; $i < 6; $i++)
                @foreach ($posts as $post_data)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-blog" >
                        <a href=" {{ route('post.details',$post_data->slug) }} ">
                        <div class="card-image">
                                <img class="img" src="{{ Storage::disk('public')->url('posts/'.$post_data->image) }}" />
                        </div>
                        <div class="card-content">                    
                            <h4 class="card-title">
                                {{ str_limit($post_data->title,30) }}
                            </h4>
                        </a>
                            <h6 class="card-description">
                                {!! str_limit($post_data->body,150) !!}
                            </h6>
                            <div class="footer">
                                <div class="author">
                                    <a href=" {{ route('profile.index',$post_data->user->username) }} ">
                                        @if ($post_data->user->image == 'default.png')
                                        <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " alt="..." class="avatar img-raised">
                                        @else
                                        <img src=" {{ Storage::disk('public')->url('profile/'.$post_data->user->image) }} " alt="..." class="avatar img-raised">
                                        @endif
                                        <span> <strong> {{$post_data->user->name}} </strong> </span>
                                    </a>
                                </div>
                                <div class="stats">
                                    <i class="material-icons">favorite</i> {{ $post_data->favourite_to_users->count() }} &middot;
                                    <i class="material-icons">chat_bubble</i> {{ $post_data->comments->count() }} &middot;
                                    <i class="material-icons">visibility</i> {{ $post_data->view_count }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            @endfor
        @else
            <h3><strong>Sorry </strong>, First You Need to Follow Favourite Author to Read the Posts.<a href=" {{ route('popular_author.index') }} ">Click Here to Follow Author.</a></h3>
        @endif
        
    </div>
</div>
<div class="container">
    <div class="text-center" style="margin-bottom: 14px;">
        <a href=" {{ route('post.index') }} " class="btn btn-rose btn-round">See More</a>
    </div>
    </div>
    <!-- Post Container -->
<div class="separator"></div>
<!-- ADS CONTAINER START -->
<div class="container-fluid">
    <ul class="adContainer owl-carousel owl-theme">
        @foreach ($ads_post as $item)
        <li class="adItem item">
            <a target="_blank" href=" {{ $item->link }} ">
            <img src=" {{ Storage::disk('public')->url('ads/'.$item->image) }}" alt="..." loading="lazy" class="adImg">
            </a>
        </li>    
        @endforeach
    </ul>
</div>
<!-- ADS CONTAINER END -->




@endsection

@push('js')
<script>

    $(document).on('keyup','#postSearch',function(event){
        event.preventDefault();
        let data = $('#postInputSearch').val();
        axios.get("{{ route('search') }}",{
            params : {
                title : data
            }
        }).then(data => {
            $('#searchPostResult').html(data.data)
        }).catch(error => {
            console.log(error)
        })
    });

    $('.owl-carousel').owlCarousel({
    autoplay:500,
    loop:true,
    margin:10,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
</script>
@endpush