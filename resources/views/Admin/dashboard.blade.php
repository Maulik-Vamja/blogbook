@extends('layouts.backend.app')

@section('title','Dashboard')

@push('css')
    
@endpush

@section('content')

    <div class="container-fluid">
    
        <!----------------- FIRST COLUMN START ------------------->
    
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="orange">
                        <i class="material-icons">playlist_add_check</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Total Posts</p>
                        <h3 class="card-title"> {{ $posts->count() }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="rose">
                        <i class="material-icons">favorite</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Favorite</p>
                        <h3 class="card-title"> {{ Auth::user()->favourite_posts->count() }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="red">
                        <i class="material-icons">history</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Pending Posts</p>
                        <h3 class="card-title"> {{ $total_pending_post }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="blue">
                        <i class="material-icons">visibility</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Total Views</p>
                        <h3 class="card-title"> {{ $all_view }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!----------------- FIRST COLUMN END ------------------->
    
        <!----------------- SECOND COLUMN START --------------->
    
        <div class="row">
        
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="purple">
                    <i class="material-icons">apps</i>
                </div>
                <div class="card-content">
                    <p class="category">Categories</p>
                <h3 class="card-title">{{ $categories }}</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Just Updated
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="green">
                    <i class="material-icons">local_offer</i>
                </div>
                <div class="card-content">
                    <p class="category">Tags</p>
                    <h3 class="card-title"> {{ $tag }} </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Just Updated
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="orange">
                    <i class="material-icons">account_box</i>
                </div>
                <div class="card-content">
                    <p class="category">Total Authors</p>
                    <h3 class="card-title"> {{ $total_author }} </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Just Updated
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header" data-background-color="rose">
                    <i class="material-icons">fiber_new</i>
                </div>
                <div class="card-content">
                    <p class="category">Today Authors</p>
                    <h3 class="card-title"> {{ $new_author_today }} </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i> Just Updated
                    </div>
                </div>
            </div>
        </div>
        </div>
    
        <!----------------- SECOND COLUMN END --------------->
    
    
        <!----------------- THIRD COLUMN START ------------------->
    
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="green">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Total Followers</p>
                        <h3 class="card-title"> {{ $followers }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="rose">
                        <i class="material-icons">people</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Total Following</p>
                        <h3 class="card-title"> {{ $following }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="green">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Total Ads Offer</p>
                        <h3 class="card-title"> {{ $offer }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header" data-background-color="orange">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="card-content">
                        <p class="category">Total Ads Post</p>
                        <h3 class="card-title"> {{ $ads_post }} </h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i> Just Updated
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <!----------------- THIRD COLUMN END ------------------->


        <!------------ TOP 5 POPULAR POSTS START-------- -->
    
        <br>
        <div class="row">
        <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-icon" data-background-color="rose">
                <i class="material-icons">library_books</i>
            </div>
            <h4 class="card-title">TOP 5 POPULAR POSTS</h4>
            <div class="card-content">
                <div class="table-responsive">
                    <table class="table tbl-con-center">
                        <thead>
                            <tr>
                                <th>Rank List</th>
                                <th>Title</th>
                                <th>Views</th>
                                <th >Favourite</th>
                                <th>Comments</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($popular_post as $key => $post)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ str_limit($post->title,40) }} </td>
                                <td>{{ $post->view_count }}</td>
                                <td> {{ $post->favourite_to_users_count }} </td>
                                <td>{{ $post->comments_count }}</td>
                                <td>
                                    @if ($post->status == true)
                                        <button class="btn btn-sm btn-success">Published</button>
                                    @else
                                        <button class="btn btn-sm btn-success">Pending</button>
                                    @endif
                                    
                                </td>
                                <td class="td-actions text-right">
                                    <a href="{{ route('post.details',$post->slug) }}" type="button" rel="tooltip" class="btn btn-sm" data-background-color="rose">
                                        <i class="material-icons">remove_red_eye</i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        </div>
    
        <!------------ TOP 5 POPULAR POSTS END-------- -->
    
    
        <!------------ TOP 10 ACTIVE AUTHOR START-------- -->
    
        <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="rose">
                    <i class="material-icons">person</i>
                </div>
                <div class="card-content">
                    <h4 class="card-title">TOP 10 ACTIVE AUTHOR</h4>
                    <div class="table-responsive">
                        <table class="table tbl-con-center">
                            <thead class="text-primary">
                                <th>Rank List</th>
                                <th>Name</th>
                                <th>Posts</th>
                                <th>Comments</th>
                                <th>Favorites</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                @foreach ($active_authors as $key => $author)
                                <tr>
                                    <td> {{ $key + 1 }} </td>
                                    <td> {{ $author->name }} </td>
                                    <td> {{ $author->posts_count }} </td>
                                    <td> {{ $author->comments_count }} </td>
                                    <td> {{ $author->favourite_posts_count }} </td>
                                    <td> <a href=" {{ route('profile.index',$author->username) }} " class="btn btn-sm btn-rose btn-round">See Profile</a></td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    
        <!------------ TOP 10 ACTIVE AUTHOR END-------- -->
    
    </div>

@endsection

@push('js')
    
@endpush
