@extends('layouts.frontend.app')

@section('title','Popular Authors')

@push('css')

@endpush

@section('content')

<div class="page-header header-filter header-small" data-parallax="true"
    style="background-image: url( {{ asset('public/assets/frontend/img/popauthors.jpg') }});">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="card card-raised card-form-horizontal">
                    <div class="card-content">
                        <form method="GET" id="authorSearch" action="">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <input type="text" value="" placeholder="Search Your Favourite Author Here..."
                                            class="form-control" id="authorSearchInput" />
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <button type="button" class="btn btn-rose btn-block" id="searchBtn">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="main main-raised">
    <div class="section">
        <div class="container">
            <div class="row" id="myItems">
                <div class="container">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="brand text-center">
                            <h2 class="title"> Top Popular Authors</h2>
                        </div>
                    </div>
                </div>
                <br>
                <br>
                <div id="authorSearchResult">
                    @foreach ($users as $user_data)
                    <div class="col-md-4">
                        <div class="card card-profile">
                            <div class="card-avatar">
                                <a href="#pablo">
                                    @if ($user_data->image == 'default.png')
                                    <img class="img" src="{{ asset('public/assets/backend/img/default-avatar.png') }} " alt="..." />
                                    @else
                                    <img class="img" src=" {{ Storage::disk('public')->url('profile/'.$user_data->image) }} " />
                                    @endif
                                </a>
                            </div>
                            <div class="card-content">
                                <h6 class="category text-gray">Followers : {{ $user_data->user1->count() }} </h6>

                                <h4 class="card-title">{{ $user_data->name }}</h4>

                                <p class="card-description">
                                    {{ str_limit($user_data->about,125) }}
                                </p>
                                <a href=" {{ route('profile.index',$user_data->username) }} "
                                    class="btn btn-rose btn-round">Profile</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div><!-- section -->
</div> <!-- end-main-raised -->

@endsection

@push('js')
<script>
    function searchAuthor() {

            $(document).on('keyup','#authorSearch',function(event){
            event.preventDefault();
            let data = $('#authorSearchInput').val();
            axios.get("{{ route('author_search') }}",{
                params : {
                    name : data
                }
            }).then(data => {
                $('#authorSearchResult').html(data.data)
            }).catch(error => {
                console.log(error)
            })
            });
        }
</script>

@endpush