@extends('admin.layouts.app')

{{-- @include('admin.layouts.partials.sidebar') --}}
@section('title', 'Post Create')
@push('css')
    <!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Post</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">Post List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add New Post</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('admin.blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if(session('error') || session('error_detail'))
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <ul class="mb-0">
                                        @if(session('error'))
                                            <li>{{ session('error') }}</li>
                                        @endif
                                        @if(session('error_detail'))
                                            <li><strong>Details:</strong> {{ session('error_detail') }}</li>
                                        @endif
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                                <div class="form-group">
                                    <label for="postTitle">Post Title <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control @error('postTitle') is-invalid @enderror" id="postTitle" name="postTitle" placeholder="Enter post title" value="{{ old('postTitle') }}">
                                    @error('postTitle')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="postTitle">Post Slug <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('postSlug') is-invalid @enderror" id="postSlug" name="postSlug" placeholder="Enter post Slug" value="{{ old('postSlug') }}">
                                    @error('postSlug')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="postCategory">Category <span class="text-danger">*</span></label>
                                    <select class="form-control @error('postCategory') is-invalid @enderror" id="postCategory" name="postCategory">
                                        <option value="">Select Category</option>
                                        @foreach($categores as $category)
                                            <option value="{{$category->id}}" {{ old('postCategory') == $category->id ? 'selected' : '' }}>{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('postCategory')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="postAuthor">Author <span class="text-danger">*</span></label>

                                    <select class="form-control @error('Author') is-invalid @enderror" id="Author" name="Author">
                                        <option value="">Select Author</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{ old('Author') == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Author')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="desc">Description <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" placeholder="Enter post desc">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="postDate">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('postDate') is-invalid @enderror" id="postDate" name="postDate" value="{{ old('postDate') }}">
                                    @error('postDate')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="postImage">Post Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('img') is-invalid @enderror" id="img" name="img">
                                            <label class="custom-file-label" for="postImage">Choose file</label>
                                        </div>
                                    </div>
                                    @error('img')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="metaTitle">Meta Title</label>
                                    <input type="text" class="form-control @error('metaTitle') is-invalid @enderror" id="metaTitle" name="metaTitle" placeholder="Enter meta title (Maximum 60 charecter)" value="{{ old('metaTitle') }}">
                                    @error('metaTitle')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="metaDescription">Meta Description</label>
                                    <textarea class="form-control @error('metaDescription') is-invalid @enderror" id="metaDescription" name="metaDescription" rows="4" placeholder="Enter meta description (Maximum 160 charecter)">{{ old('metaDescription') }}</textarea>
                                    @error('metaDescription')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="keywords">Keywords</label>

                                    <div class="mt-2">
                                        <div id="selectedKeywords" class="form-control" style="min-height: 60px; max-height: 120px; overflow-y: auto; background-color: #f8f9fa;">
                                        @if(old('keywords'))
                                            @foreach(explode(',', old('keywords')) as $keyword)
                                                    <span class="badge badge-primary mr-1 mb-1 keyword-tag" data-keyword="{{ trim($keyword) }}">
                                                        {{ trim($keyword) }}
                                                        <i class="fas fa-times ml-1" onclick="removeKeyword(this)" style="cursor: pointer;"></i>
                                                    </span>
                                            @endforeach
                                        @endif
                                        </div>
                                        <input type="hidden" id="keywords" name="keywords" value="{{ old('keywords') }}" />
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" id="keywordInput" placeholder="Enter keywords (separate with commas)" />
                                            <small class="form-text text-muted">Type keywords and press Enter or click Add to add them</small>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button" class="btn btn-sm btn-primary" onclick="addKeyword()">Add</button>
                                        </div>
                                    </div>
                                    @error('keywords')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Select Status <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="0">Draft</option>
                                       <option value="1">Published</option>
                                    </select>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="is_banner" name="is_banner" value="1" {{ old('is_banner') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_banner">Is Banner?</label>
                                </div>
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection

@push('scripts')
    <!-- Include CKEditor 5 from CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-inspector@4.1.0/build/inspector.js"></script>

        <script>
        $(function () {
            let table = new DataTable('#postlist');
        });
    </script>
  <script>
    // Custom plugin (for example purposes, not adding functionality here)
    function CustomizationPlugin(editor) {}

    // Initialize CKEditor 5 with extended toolbar and plugins
    ClassicEditor
        .create(document.querySelector('#description'), {
            extraPlugins: [CustomizationPlugin],
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                    'indent', 'outdent', '|',
                    'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'undo', 'redo', 'alignment', 'fontSize', 'fontColor', 'highlight', 'codeBlock'
                ]
            },
            image: {
                toolbar: [
                    'imageTextAlternative', 'imageStyle:full', 'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells'
                ]
            },
            language: 'en'
        })
        .then(newEditor => {
            window.editor = newEditor;
            // The following line adds CKEditor 5 inspector.
            CKEditorInspector.attach(newEditor, {
                isCollapsed: true
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function generateSlug(text) {
        return text
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')     // Remove invalid chars
            .replace(/\s+/g, '-')             // Replace whitespace with -
            .replace(/-+/g, '-');             // Collapse multiple -
    }

    $(document).ready(function() {
        $('#postTitle').on('keyup change', function() {
            let title = $(this).val();
            let slug = generateSlug(title);
            $('#postSlug').val(slug);
        });
    });
</script>
<!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Keywords Management Script -->
<script>
    function addKeyword() {
        const input = document.getElementById('keywordInput');
        const keywords = input.value.trim();

        if (keywords) {
            // Split by commas and add each keyword
            const keywordArray = keywords.split(',').map(k => k.trim()).filter(k => k);

            keywordArray.forEach(keyword => {
                if (keyword && !isKeywordExists(keyword)) {
                    addKeywordTag(keyword);
                }
            });

            input.value = '';
            updateHiddenInput();
        }
    }

    function addKeywordTag(keyword) {
        const container = document.getElementById('selectedKeywords');
        const tag = document.createElement('span');
        tag.className = 'badge badge-primary mr-1 mb-1 keyword-tag';
        tag.setAttribute('data-keyword', keyword);
        tag.innerHTML = `
            ${keyword}
            <i class="fas fa-times ml-1" onclick="removeKeyword(this)" style="cursor: pointer;"></i>
        `;
        container.appendChild(tag);
    }

    function removeKeyword(element) {
        element.parentElement.remove();
        updateHiddenInput();
    }

    function isKeywordExists(keyword) {
        const existingTags = document.querySelectorAll('.keyword-tag');
        for (let tag of existingTags) {
            if (tag.getAttribute('data-keyword').toLowerCase() === keyword.toLowerCase()) {
                return true;
            }
        }
        return false;
    }

    function updateHiddenInput() {
        const tags = document.querySelectorAll('.keyword-tag');
        const keywords = Array.from(tags).map(tag => tag.getAttribute('data-keyword')).join(',');
        document.getElementById('keywords').value = keywords;
    }

    // Handle Enter key in input field
    document.addEventListener('DOMContentLoaded', function() {
        const input = document.getElementById('keywordInput');
        if (input) {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addKeyword();
                }
            });
        }

        // Initialize hidden input with existing keywords
        updateHiddenInput();
    });
</script>

@endpush
