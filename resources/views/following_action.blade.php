<div class="card-content">
    <h4 class="card-title">Following&nbsp;
        <span class="badge"> {{ $data->count() }} </span></h4>
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody>
                    @foreach ($data as $item)
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
            </table>
        </div>
    </div>

