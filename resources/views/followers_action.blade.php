<div class="table-responsive">
    <table class="table table-striped">
        <tbody>
            @foreach ($data2 as $item)
            <tr>
                <td>
                    @if ($item->user2->image == 'default.png')
                    <img src=" {{ asset('public/assets/backend/img/default-avatar.png') }} " class="img-circle" style="max-width:50px; max-height: 50px;" >
                    @else
                    <img src=" {{ Storage::disk('public')->url('profile/'.$item->user2->image) }} " class="img-circle" style="max-width:50px; max-height: 50px;" >
                    @endif
                </td>
                <td><h4><strong>{{ $item->user2->username }}</strong></h4>
                    <span> {{ $item->user2->name }} </span>
                </td>
                <td class="text-center">
                    @if (IsFollowing($item->user2->id)=="follow back")
                    <button class="btn btn-rose btn-round" onclick="processData({{ $item->user2->id }},'follow',{{ $item->user2->id }})">Follow</button>
                    @elseif (IsFollowing($item->user2->id)=="following")
                    <button class="btn btn-rose btn-round" onclick="processData({{ $item->user2->id }},'unfollow',{{ $item->user2->id }})">Following</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
