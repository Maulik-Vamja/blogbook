@extends('layouts.backend.app')

@section('title','Create New Post')

@push('css')
    
@endpush

@section('content')
<form method="POST" action=" {{ route('admin.post.store') }} " enctype="multipart/form-data">
    @csrf
<div class="content">
    <div class="container-fluid">
        <div class="row">
<!-- ------------- ADD POST TITLE ----------- -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">library_books</i>
                    </div>
    
                    <div class="card-content">
                        <h4 class="card-title">Add Post Title</h4>
                            <div class="form-group label-floating">
                                <label class="control-label">Post Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value=" {{ old('title') }} ">
                                @error('title')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            
                            <div>
                                <h4 class="card-title">Select Featured Image</h4>
                                <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror" id="image">
                                @error('image')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="checkbox"> 
                                <label>
                                    <input type="checkbox" name="status" id="published"><span class="checkbox-material"></span>Publish
                                </label>   
                                
                            </div>
                        
                    </div>
                </div>
            </div>
<!-- -------------/ ADD POST TITLE ----------- -->

<!-- ------------- ADD CATEGORIES & TAGS ----------- -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">apps</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Add Categories and Tags</h4>
                        
                            <div class="row">
                            <div class="col-lg-5 col-md-6 col-sm-3">
                                <select class="selectpicker @error('categories') is-invalid @enderror" name="categories[]" id="category" data-live-search="true" data-style="select-with-transition" multiple title="Select Category">
                                    <option disabled>Select Category</option>
                                    @foreach ($category as $cat_list)
                                        <option value="{{ $cat_list->id }}"> {{ $cat_list->name }} </option>
                                    @endforeach
                                </select>
                                @error('categories')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="col-lg-5 col-md-6 col-sm-3">
                                <select class="selectpicker @error('tags') is-invalid @enderror" name="tags[]" id="tags" data-live-search="true" data-style="select-with-transition" multiple title="Select Tags">
                                    <option disabled>Select Tag</option>
                                    @foreach ($tag as $tag_list)
                                        <option value="{{ $tag_list->id }}"> {{ $tag_list->name }} </option>
                                    @endforeach
                                </select>
                                @error('tags')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            </div>

                            <a href=" {{ route('admin.post.index') }} "><button type="button" class="btn btn-fill btn-primary">Back</button></a>
                            <button type="submit" class="btn btn-fill btn-rose">Submit</button>
                        
                    </div>
                </div>
            </div>
<!-- -------------/ ADD CATEGORIES & TAGS ----------- -->

<!-- ------------- WRITE POST ----------- -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="rose">
                        <i class="material-icons">library_books</i>
                    </div>
                    <div class="card-content">
                        <h4 class="card-title">Write Your Post</h4>
                        @if (session('contentMsg'))
                            <div class="alert alert-danger" id="danger-alert" role="alert">
                                {{ session('contentMsg') }}
                            </div>    
                        @endif
                            @error('body')
                                <span class="invalid-feedback text-danger text-capitalize" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        <textarea class="tinymce my-editor @error('body') is-invalid @enderror" name="body" rows="15"> {{ old('body') }} </textarea>
                    </div>
                </div>
            </div>
<!-- -------------/ WRITE POST ----------- -->
        </div>
<!-- /--------------------- INSIDE CONTENT END------------- -->
    </div>
</div>
</form>
@endsection

@push('js')

<script type="text/javascript" src=" {{ asset('public/assets/backend/plugin/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('public/assets/backend/plugin/tinymce/init-tinymce.js') }}"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
        var editor_config = {
        path_absolute : "{{ url('/') }}/",
        selector: "textarea.my-editor",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
    
            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
            cmsURL = cmsURL + "&type=Images";
            } else {
            cmsURL = cmsURL + "&type=Files";
            }
    
            tinyMCE.activeEditor.windowManager.open({
            file : cmsURL,
            title : 'Filemanager',
            width : x * 0.8,
            height : y * 0.8,
            resizable : "yes",
            close_previous : "no"
            });
        }
        };
    
    tinymce.init(editor_config);
</script>

@endpush