@extends('layouts.backend.app')

@section('title','Following')

@push('css')
    
@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">people
                        </i> 
                    </div>
                    <div id="following-show-action">    
                    <div class="card-content">
                        <h3 class="card-title">Following&nbsp;
                            <span class="badge"> {{ $following->count() }} </span></h3>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        @if ($following->count() > 0)
                                        @foreach ($following as $item)
                                        <tr>
                                            <td>
                                                @if ($item->user1->image == 'default.png')
                                                <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " class="img-circle" style="max-width:50px; max-height: 50px;" >
                                                @else
                                                <img src=" {{ Storage::disk('public')->url('profile/'.$item->user1->image) }} " class="img-circle" style="max-width:50px; max-height: 50px;" >
                                                @endif
                                                
                                            </td>
                                            <td ><h4><strong>{{ $item->user1->username }}</strong></h4>
                                                <span> {{ $item->user1->name }} </span>
                                            </td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-rose btn-round" onclick="processData({{ $item->user1->id }},'unfollow',{{ $item->user1->id }})">Following</button>
                                            </td>
                                        </tr>    
                                        @endforeach
                                    </tbody>
                                    @else
                                    <div class="container">
                                        <h4 class="title">
                                            Sorry..! You Have no Following Users.To Search Your Favourite User <strong><a href=" {{ route('popular_author.index') }} "> Click here. </a></strong>
                                        </h4>
                                    </div>
                                    @endif
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  end card  -->
            </div>
            <!-- end col-md-12 -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection

@push('js')

@endpush