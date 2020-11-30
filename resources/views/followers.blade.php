@extends('layouts.backend.app')

@section('title','Followers')

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
                    <div class="card-content">
                        <h3 class="card-title">Followers&nbsp;
                        <span class="badge">{{ $followers->count() }}</span></h3>
                        <div id="followers-show-action">    
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tbody>
                                        @if ($followers->count() > 0)
                                        @foreach ($followers as $item)
                                        <tr>
                                            <td>
                                                @if ($item->user2->image == 'default.png')
                                                <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " class="img-circle" style="max-width:50px; max-height: 50px;" >
                                                @else
                                                <img src=" {{ Storage::disk('public')->url('profile/'.$item->user2->image) }} " class="img-circle" style="max-width:50px; max-height: 50px;" >
                                                @endif
                                            </td>
                                            <td><h4><strong>{{ $item->user2->username }}</strong></h4>
                                                <span>{{ $item->user2->name }}</span>
                                            </td>
                                            <td class=" text-center">
                                                @if (IsFollowing($item->user2->id)=="follow back")
                                                <button class="btn  btn-rose btn-round" onclick="processData({{ $item->user2->id }},'follow',{{ $item->user2->id }})">Follow</button>
                                                @elseif (IsFollowing($item->user2->id)=="following")
                                                <button class="btn  btn-rose btn-round" onclick="processData({{ $item->user2->id }},'unfollow',{{ $item->user2->id }})">Following</button>
                                                @endif
                                            </td>
                                        </tr>    
                                        @endforeach
                                    </tbody>
                                    @else
                                    <div class="container">
                                        <h4 class="title">
                                            Sorry you Have no any Followers. Search for Your Favourite author <a href=" {{ route('popular_author.index') }} "><strong>Click Here.</strong></a>
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
<script type="text/javascript">
    function DeleteComment(id)
            {
                document.getElementById('remove-from-'+id).submit();
            }
    $(document).ready (function(){
        window.setTimeout(function() {
        $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
    }, 2000); });             
</script>
@endpush




{{-- <div id="followers-show-action">
    Total Followers = {{ $followers->count() }}
    @foreach ($followers as $item)
    <div>
        <div>
            {{ $item->user2->name }}
            @if (IsFollowing($item->user2->id)=="follow")
                <button onclick="processData({{ $item->user2->id }},'follow',{{ $item->user2->id }})">Follow</button>
            @elseif (IsFollowing($item->user2->id)=="following")
                <button onclick="processData({{ $item->user2->id }},'unfollow',{{ $item->user2->id }})">Following</button>
            @endif
        </div>
        <br>
    </div>
    @endforeach
</div> --}}