@if ($data->count() > 0)
<div>        
    @foreach ($data as $post_data)
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
                        <i class="material-icons">chat_bubble</i> {{ $post_data->comments->count(2) }} &middot;
                        <i class="material-icons">visibility</i> {{ $post_data->view_count }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="container">
    <div class="title">
    <h3><strong>Sorry , There have no any post for your search - <span style="color: #e91e63">{{ $title }}</span> </strong></h3>
    </div>  
</div>
@endif
