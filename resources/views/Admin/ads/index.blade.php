@extends('layouts.backend.app')

@section('title','Advertisment Offer')

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
                        <h4 class="card-title">Advertisements Offer &nbsp; 
                            <span class="badge"> {{ $offer->count() }} </span></h4>
                        <div class="toolbar">
                            <a href=" {{ route('admin.ads.create') }} " class="btn btn-rose">
                                <i class="material-icons">add</i> 
                                Add New Offer
                            </a>
                        </div>
                        @if (session('succesMsg'))
                            <div class="alert alert-success" id="success-alert" role="alert">
                                {{ session('succesMsg') }}
                            </div>    
                        @endif
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover" cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>title</th>
                                        <th>Offer</th>
                                        <th>Post Count</th>
                                        <th>Submitted At</th>
                                        <th>Expire at</th>
                                        <th class="disabled-sorting ">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>title</th>
                                        <th>Offer</th>
                                        <th>Post Count</th>
                                        <th>Submitted At</th>
                                        <th>Expire at</th>
                                        <th class="disabled-sorting ">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if ($offer->count() > 0 )
                                    @foreach ($offer as $key => $item)
                                    <tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td>    
                                        <p> {{ $item->title }} </p>
                                        </td>
                                        <td> {{ $item->price }} INR/ @if ($item->time == false)
                                            Month
                                        @else
                                            Year
                                        @endif
                                        </td>
                                        <td>{{ $item->ads_post->count() }}</td>
                                        <td> {{ $item->created_at->isoFormat('Do MMMM YYYY') }} </td>
                                        <td> {{ $item->expire }} </td>
                                        <td class="">
                                            <a href=" {{ route('admin.ads.edit',$item->id) }} " class="btn btn-sm btn-warning btn-icon"><i class="material-icons" rel="tooltip" data-placement="bottom" title="Edit">edit</i></a>

                                            <button type="button"  rel="tooltip" data-placement="bottom" title="Delete" class="btn btn-sm btn-danger btn-icon" data-toggle="modal" data-target="#exampleModal_{{$key}}">
                                                <i class="material-icons">delete</i>
                                            </button>
                        <!------------ Modal ------------------>
                                    <div class="modal fade" style="margin-top: 120px;" id="exampleModal_{{$key}}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"  role="document">
                                        <div class="modal-content" style="padding-left:0px;">
                                            <div class="modal-header">
                                            <h2 class="modal-title text-center" id="exampleModalLabel">Are You Sure?</h2>
                                            </div>
                                            <h4 class="modal-body text-center">
                                            You Want To Delete It?
                                            </h4>
                                            <div class="modal-footer text-center">
                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" id="" onclick="DeleteOffre({{$item->id}})">Delete</button>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                            <form id="delete-from-{{ $item->id }}" method="POST" action=" {{ route('admin.ads.destroy',$item->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>  
                                    @endforeach
                                    @else
                                        <td colspan="7" class="text-center h4"> Sorry...Still You Don't Have any Offer </td>
                                    @endif
                                </tbody>
                            </table>
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
    function DeleteOffre(id)
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
            }, 3000); });             
</script>    
@endpush