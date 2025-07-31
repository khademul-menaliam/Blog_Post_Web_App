@extends('admin.layouts.app')

{{-- @include('admin.layouts.partials.sidebar') --}}
@section('title', 'Category Edit')
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
                    <h1 class="m-0">Edit Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">Category List</li>
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
                            <h3 class="card-title">Add New Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('admin.category.update', $post->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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
                                    <label for="postTitle">Category Title <span class="text-danger">*</span> </label>
                                    <input type="text" class="form-control @error('postTitle') is-invalid @enderror" id="postTitle" name="postTitle" placeholder="Enter post title" value="{{ old('postTitle', $post->title) }}">
                                    @error('postTitle')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="postSlug">Category Slug <span class="text-danger">*</span></label>
                                    <input readonly type="text" class="form-control @error('postSlug') is-invalid @enderror" id="postSlug" name="postSlug" placeholder="Enter post Slug" value="{{ old('postSlug', $post->slug) }}">
                                    @error('postSlug')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="postAuthor">Author <span class="text-danger">*</span></label>

                                    <select class="form-control @error('Author') is-invalid @enderror" id="Author" name="Author">
                                        <option value="">Select Author</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{ old('Author', $post->user_id) == $user->id ? 'selected' : '' }}>{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('Author')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="form-group">
                                    <label for="postDate">Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('postDate') is-invalid @enderror" id="postDate" name="postDate" value="{{ old('postDate', $post->created_at ? \Carbon\Carbon::parse($post->postDate)->format('Y-m-d') : null) }}">
                                    @error('postDate')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="metaTitle">Meta Title</label>
                                    <input type="text" class="form-control @error('metaTitle') is-invalid @enderror" id="metaTitle" name="metaTitle" placeholder="Enter meta title (Maximum 60 charecter)" value="{{ old('metaTitle', $post->meta_title) }}">
                                    @error('metaTitle')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="metaDescription">Meta Description</label>
                                    <textarea class="form-control @error('metaDescription') is-invalid @enderror" id="metaDescription" name="metaDescription" rows="4" placeholder="Enter meta description (Maximum 160 charecter)">{{ old('metaDescription', $post->meta_description) }}</textarea>
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
                                            @elseif($post->meta_keywords)
                                                @foreach(explode(',', $post->meta_keywords) as $keyword)
                                                    <span class="badge badge-primary mr-1 mb-1 keyword-tag" data-keyword="{{ trim($keyword) }}">
                                                        {{ trim($keyword) }}
                                                        <i class="fas fa-times ml-1" onclick="removeKeyword(this)" style="cursor: pointer;"></i>
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <input type="hidden" id="keywords" name="keywords" value="{{ old('keywords', $post->meta_keywords) }}" />
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
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Cancel</a>
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

<!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Initialize Select2 -->

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
