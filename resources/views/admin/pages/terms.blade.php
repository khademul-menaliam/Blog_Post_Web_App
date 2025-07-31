@extends('admin.layouts.app')

    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Terms & Conditions')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Terms & Conditions</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item ">Terms & Conditions</li>
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
            <div class="col-lg-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Terms & Conditions</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <!-- form start -->
                                <form action="{{route('admin.terms.update', $post->id)}}" method="POST">
                                     @csrf
                            @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="Title">Page Title</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $post->name) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Privacy Description</label>
                                            <textarea name="description" id="description" class="form-control" rows="10">{{ old('description', $post->description) }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="postDate">Date <span class="text-danger">*</span></label>
                                            <input type="date" class="form-control @error('postDate') is-invalid @enderror" id="postDate" name="postDate" value="{{ old('postDate', isset($post->created_at) ? \Carbon\Carbon::parse($post->created_at)->format('Y-m-d') : '') }}">
                                            @error('postDate')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="metatitle">Meta Title</label>
                                            <input type="text" class="form-control" name="metatitle" id="metatitle" value="{{ old('metatitle', $post->meta_title) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="meta_desc">Meta Description</label>
                                            <textarea name="meta_desc" id="meta_desc" placeholder="meta desc" class="form-control" rows="2">{{ old('metaDescription', $post->meta_description) }}</textarea>
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
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection

@push('scripts')
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
