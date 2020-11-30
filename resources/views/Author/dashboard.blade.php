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
                    <p class="category">Favourite</p>
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
                    <i class="material-icons">library_books</i>
                </div>
                <div class="card-content">
                    <p class="category">Pending Posts</p>
                    <h3 class="card-title"> {{ $total_pending_posts }} </h3>
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
                <div class="card-header" data-background-color="blue">
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
                <div class="card-header" data-background-color="red">
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
    
        <!----------------- SECOND COLUMN END --------------->
    
    
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
                            @if ($populer_posts->count() > 0)
                            @foreach ($populer_posts as $key => $item)
                            <tr>
                                <td> {{ $key + 1 }} </td>
                                <td> {{ str_limit($item->title,40) }} </td>
                                <td> {{ $item->view_count }} </td>
                                <td> {{ $item->favourite_to_users_count }} </td>
                                <td> {{ $item->comments_count }} </td>
                                <td>
                                @if ($item->status == true)
                                <button class="btn btn-sm btn-success">Published</button>
                                @else
                                <button class="btn btn-sm btn-danger">Pending</button>
                                @endif
                                </td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn" data-background-color="rose">
                                        <i class="material-icons">remove_red_eye</i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="7"><h3>Sorry,You don't have any Post. Create Your First Blog Post.</h3></td>
                            </tr>
                            @endif
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
        </div>
    
        <!------------ TOP 5 POPULAR POSTS END-------- -->
    </div>

@endsection

@push('js')
    
@endpush
