@extends('layouts.backend.app')

@section('title','Edit Advertisment Post')

@push('css')

@endpush

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">assignment</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Create New Advertisement</h4>
                        <div class="toolbar">

                        </div>
                        <div class="container-fluid">
                            <div class="row text-center">
                                <form method="POST" action=" {{ route('author.ads.update',$post->id) }} "
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="col-md-5 col-md-offset-3">
                                        <input type="hidden" name="total" id="total" value="">
                                        <select class="selectpicker form-control @error('adsoffer') is-invalid @enderror" name="adsoffer" id="offerPrice" data-style="btn btn-rose">
                                            <option value="0" disabled selected>--Choose Offer--</option>
                                            @foreach ($offer as $item)
                                            <option  value=" {{ $item->id }} " data-value=" {{ $item->price }} ">
                                                {{$item->title .' @ '. $item->price .' INR /' }}
                                                {{ $item->time == true ? 'Month' : 'Year' }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('adsoffer')
                                        <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-5 col-md-offset-3">
                                        <h5>Advertisement Image</h5>
                                        <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail">
                                                <img src=" {{ asset('public/assets/backend/img/image_placeholder.jpg') }}"
                                                    alt="...">
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail"></div>
                                            <div>
                                                <span class="btn btn-rose btn-round btn-file">
                                                    <span class="fileinput-new">Select image</span>
                                                    <span class="fileinput-exists">Change</span>
                                                    <input type="file" class="@error('image') is-invalid @enderror" name="image" />
                                                </span>
                                                <a href="#pablo" class="btn btn-danger btn-round fileinput-exists"
                                                    data-dismiss="fileinput"><i class="fa fa-times"></i> Remove</a>
                                            </div>
                                            @error('image')
                                                <div class="invalid-feedback text-danger text-capitalize" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </div>
                                            @enderror   
                                        </div>
                                    </div>

                                    <div class="col-md-7 col-md-offset-2">
                                        <div class="form-group label-floating ">
                                            <input type="text" name="link" value=" {{ $post->link }} " class="form-control" placeholder="Enter url">
                                        </div>
                                    </div>

                                    <div class="col-md-5 col-md-offset-3">
                                        <select class="form-control" name="month" id="monthSlider" data-style="btn btn-rose"
                                            data-size="12">
                                            <option value="0" disabled selected>--Select Month--</option>
                                            @for ($i = 1; $i < 13; $i++) <option value=" {{ $i }} ">{{$i}} Month
                                                </option>
                                                @endfor

                                        </select>
                                    </div>

                                    <div class="col-md-7 col-md-offset-2">
                                        <button type="submit" value="" class="btn btn-lg btn-rose btn-round"
                                            onclick="btnPayAdBtn()" id="payBtn">Pay</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- end content-->
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
<script>
    function DeletePost(id)
        {
            document.getElementById('delete-from-'+id).submit();
        }
</script>
<script>
    $(document).ready (function(){
    window.setTimeout(function() {
    $("#success-alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
}, 2000); });   


// CODE FOR ADVERTISEMENT //

$('select#offerPrice').change(function() {

var other_val = $('select#offerPrice option[value="' + $(this).val() + '"]').data('value');

 var offerPrice = document.getElementById("offerPrice");
    var offerTime = document.getElementById("monthSlider");
    var payBtn = document.getElementById("payBtn");
    var totalPrice = document.getElementById("total");

    offerPrice.oninput = function(){
        payBtn.innerText = 'Pay' + ' ' + other_val * offerTime.value;
    }
    offerTime.oninput = function(){
        payBtn.innerText  = 'Pay' + ' ' + other_val * offerTime.value;
        payBtn.value = other_val * offerTime.value;
        totalPrice.value = payBtn.value;
    }
    function btnPayAdBtn(){
        payBtn.value = other_val * offerTime.value;
        // alert("You have to pay " + payBtn.value);
    }
});

</script>
@endpush