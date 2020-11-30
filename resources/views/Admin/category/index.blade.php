@extends('layouts.backend.app')

@section('title','Category')

@push('css')

@endpush

@section('content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="card-content">
                        <h3 class="card-title">All Categories &nbsp;
                            <span class="badge">{{ $category->count() }}</span></h3>
                        <div class="toolbar">
                            <a href=" {{ route('admin.category.create') }} " class="btn btn-rose">
                                <i class="material-icons">add</i>
                                Add New Category
                            </a>
                        </div>
                        @if (session('succesMsg'))
                        <div class="alert alert-success" id="success-alert" role="alert">
                            {{ session('succesMsg') }}
                        </div>
                        @endif
                        <div class="material-datatables">
                            <table id="datatables" class="table table-striped table-no-bordered table-hover"
                                cellspacing="0" width="100%" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Post Count</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="disabled-sorting text-centre">Actions</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Post Count</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($category as $key => $cat_list)
                                    <tr>
                                        <td> {{$key + 1 }} </td>
                                        <td>{{$cat_list->name}} {{ $cat_list->id }} </td>
                                        <td><span class="badge badge-primary"> {{ $cat_list->posts->count() }} </span>
                                        </td>
                                        <td>{{$cat_list->created_at->isoFormat('Do MMMM YYYY')}}</td>
                                        <td>{{$cat_list->updated_at->isoFormat('Do MMMM YYYY')}}</td>
                                        <td class="text-centre">

                                            <a href=" {{route('admin.category.edit',$cat_list->id)}} " rel="tooltip"
                                                data-placement="bottom" title="Edit"
                                                class="btn btn-sm mr-auto btn-warning btn-icon"><i
                                                    class="material-icons">edit</i></a>
                                            <button type="button" rel="tooltip" data-placement="bottom" title="Delete" class="btn btn-sm btn-danger btn-icon" data-toggle="modal" data-target="#exampleModal_{{$key}}"> <i class="material-icons">delete</i></button>
                                            <!------------ Modal ------------------>
                                            <div class="modal fade" style="margin-top: 120px;" id="exampleModal_{{$key}}" tabindex="1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content" style="padding-left:0px;">
                                                        <div class="modal-header">
                                                            <h2 class="modal-title text-center" id="exampleModalLabel">
                                                                Are You Sure?</h2>
                                                        </div>
                                                        <h4 class="modal-body text-center">
                                                            You Want To Delete It?
                                                        </h4>
                                                        <div class="modal-footer text-center">
                                                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-danger" id="" onclick="DeleteCat({{ $cat_list->id }})">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <form id="delete-from-{{ $cat_list->id }}" method="POST"
                                                action=" {{ route('admin.category.destroy',$cat_list->id) }}">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
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
    function DeleteCat(id)
        {
            // document.write(id);
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