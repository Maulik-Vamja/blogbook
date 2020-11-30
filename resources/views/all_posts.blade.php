@extends('layouts.frontend.app')

@section('title','All Post')

@push('css')

@endpush

@section('content')

<div class="page-header header-filter header-small" data-parallax="true" style="background-image: url(' {{ asset('public/assets/frontend/img/allpostbg2.jpg') }} ');">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="brand text-center">
                    <h1 class="title"> All Blog Post </h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="section">
        <div class="container">
            <div class="row">
                @foreach ($posts as $post_data)
                <div class="col-md-6 col-lg-4">
                    <div class="card card-blog">
                        <a href=" {{ route('post.details',$post_data->slug) }} ">
                        <div class="card-image">
                                <img class="img" src="{{ Storage::disk('public')->url('posts/'.$post_data->image) }}" />
                        </div>
                        <div class="card-content">                    
                            <h4 class="card-title">
                                {{ str_limit($post_data->title,30) }}
                            </h4> </a>
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
                                    <i class="material-icons ">favorite</i> {{ $post_data->favourite_to_users->count() }} &middot;
                                    <i class="material-icons">chat_bubble</i> {{ $post_data->comments->count() }}  &middot;
                                    <i class="material-icons">visibility</i> {{ $post_data->view_count }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                <!-- Pagination -->
                <div class="container">
                    <div class="text-center" style="margin-bottom: 14px;">
                        <ul class="pagination pagination-rose">
                            <li> {{ $posts->links() }} </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- section -->
</div> <!-- end-main-raised -->


@endsection

@push('js')
    
@endpush
