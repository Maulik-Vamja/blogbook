@if ($data->count() > 0)
<div>
@foreach ($data as $user_data)
<div class="col-md-4">
    <div class="card card-profile">
        <div class="card-avatar">
            <a href="#pablo">
                @if ($user_data->image == 'default.png')
                <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " alt="..." class="img">
                @else
                <img class="img" src=" {{ Storage::disk('public')->url('profile/'.$user_data->image) }}" />    
                @endif
            </a>
        </div>
        <div class="card-content">
            <h6 class="category text-gray">Followers : {{ $user_data->user1->count() }} </h6>

            <h4 class="card-title">{{ $user_data->name }}</h4>

            <p class="card-description">
                {{ str_limit($user_data->about,125) }}
            </p>
            <a href=" {{ route('profile.index',$user_data->username) }} " class="btn btn-rose btn-round">Profile</a>
        </div>
    </div>
</div>      
@endforeach
</div>
@else
<div class="container">
    <div class="title">
    <h3><strong>Sorry , There have no any Author Found for your search -<span style="color: #e91e63"> {{ $name }}</span> </strong></h3>
    </div>  
</div>
@endif