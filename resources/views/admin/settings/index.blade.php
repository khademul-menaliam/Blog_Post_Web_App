@extends('admin.layouts.app')

    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Admin Settings')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
    <h1 class="m-0">Web Settings</h1>
</div>
<div class="col-sm-6">
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item ">Web Settings</li>
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
            <h3 class="card-title">General Settings</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session('success') }}
                                    </div>
                                @endif
                        <div class="row">
                            <!-- Logo Upload -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="logo">Upload Logo</label>
                                    <input type="file" class="form-control-file" id="logo" name="logo">
                                    @if(!empty($data->logo))
                                        <p>Current: <img src="{{ asset('assets/images/' . $data->logo) }}" height="40"></p>
                                    @endif
                                </div>
                            </div>

                            <!-- Favicon Upload -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="favicon">Upload Favicon</label>
                                    <input type="file" class="form-control-file" id="favicon" name="favicon">
                                    @if(!empty($data->fav_icon))
                                        <p>Current: <img src="{{ asset('assets/images/' . $data->fav_icon) }}" height="20"></p>
                                    @endif
                                </div>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $data->phone ?? '') }}" placeholder="Enter phone number">
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $data->email ?? '') }}" placeholder="Enter email">
                                </div>
                            </div>

                            <!-- Address -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $data->address ?? '') }}" placeholder="Enter address">
                                </div>
                            </div>

                            <!-- Facebook -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="facebook">Facebook Link</label>
                                    <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook', $data->facebook ?? '') }}" placeholder="Facebook URL">
                                </div>
                            </div>

                            <!-- LinkedIn -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="linkedin">LinkedIn Link</label>
                                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ old('linkedin', $data->linkedin ?? '') }}" placeholder="LinkedIn URL">
                                </div>
                            </div>

                            <!-- Instagram -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="instagram">Instagram Link</label>
                                    <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram', $data->instagram ?? '') }}" placeholder="Instagram URL">
                                </div>
                            </div>

                            <!-- Twitter -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="twitter">Twitter Link</label>
                                    <input type="text" class="form-control" id="twitter" name="twitter" value="{{ old('twitter', $data->twitter ?? '') }}" placeholder="Twitter URL">
                                </div>
                            </div>

                            <!-- Youtube -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="youtube">Youtube Link</label>
                                    <input type="text" class="form-control" id="youtube" name="youtube" value="{{ old('youtube', $data->youtube ?? '') }}" placeholder="Youtube URL">
                                </div>
                            </div>
                            {{-- global meta --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="metaTitle">Meta Title</label>
                                    <input type="text" class="form-control @error('metaTitle') is-invalid @enderror" id="metaTitle" name="metaTitle" placeholder="Enter meta title (Maximum 60 characters)" value="{{ old('metaTitle', $data->meta_title ?? '') }}">
                                    @error('metaTitle')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="metaDescription">Meta Description</label>
                                    <textarea class="form-control @error('metaDescription') is-invalid @enderror" id="metaDescription" name="metaDescription" rows="4" placeholder="Enter meta description (Maximum 160 characters)">{{ old('metaDescription', $data->meta_description ?? '') }}</textarea>
                                    @error('metaDescription')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="keywords">Keywords</label>

                                    <div class="mt-2">
                                        <div id="selectedKeywords" class="form-control" style="min-height: 80px; max-height: 150px; overflow-y: auto; background-color: #f8f9fa;">
                                            @if(old('keywords'))
                                                @foreach(explode(',', old('keywords')) as $keyword)
                                                    <span class="badge badge-primary mr-1 mb-1 keyword-tag" data-keyword="{{ trim($keyword) }}">
                                                        {{ trim($keyword) }}
                                                        <i class="fas fa-times ml-1" onclick="removeKeyword(this)" style="cursor: pointer;"></i>
                                                    </span>
                                                @endforeach
                                            @elseif(isset($data->meta_keywords) && $data->meta_keywords)
                                                @foreach(explode(',', $data->meta_keywords) as $keyword)
                                                    <span class="badge badge-primary mr-1 mb-1 keyword-tag" data-keyword="{{ trim($keyword) }}">
                                                        {{ trim($keyword) }}
                                                        <i class="fas fa-times ml-1" onclick="removeKeyword(this)" style="cursor: pointer;"></i>
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <input type="hidden" id="keywords" name="keywords" value="{{ old('keywords', $data->meta_keywords ?? '') }}" />
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="keywordInput" placeholder="Enter keywords (separate with commas)" />
                                            <small class="form-text text-muted">Type keywords and press Enter or click Add to add them</small>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-sm btn-primary" onclick="addKeyword()">Add</button>
                                        </div>
                                    </div>
                                    @error('keywords')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            {{-- blog page meta --}}
                        <div class="col-lg-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Blog Meta</h3>
                                </div>
                            </div>
                        </div>
                            <hr class="w-100">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="blog_metaTitle">Blog Meta Title</label>
                                    <input type="text" class="form-control @error('blog_metaTitle') is-invalid @enderror" id="blog_metaTitle" name="blog_metaTitle" placeholder="Enter blog meta title (Maximum 60 characters)" value="{{ old('blog_metaTitle', $data->blog_meta_title ?? '') }}">
                                    @error('blog_metaTitle')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="blog_keywords">Blog Keywords</label>

                                    <div class="mt-2">
                                        <div id="selectedBlogKeywords" class="form-control" style="min-height: 100px; max-height: 180px; overflow-y: auto; background-color: #f8f9fa;">
                                            @if(old('blog_keywords'))
                                                @foreach(explode(',', old('blog_keywords')) as $keyword)
                                                    <span class="badge badge-success mr-1 mb-1 blog-keyword-tag" data-keyword="{{ trim($keyword) }}">
                                                        {{ trim($keyword) }}
                                                        <i class="fas fa-times ml-1" onclick="removeBlogKeyword(this)" style="cursor: pointer;"></i>
                                                    </span>
                                                @endforeach
                                            @elseif(isset($data->blog_meta_keywords) && $data->blog_meta_keywords)
                                                @foreach(explode(',', $data->blog_meta_keywords) as $keyword)
                                                    <span class="badge badge-success mr-1 mb-1 blog-keyword-tag" data-keyword="{{ trim($keyword) }}">
                                                        {{ trim($keyword) }}
                                                        <i class="fas fa-times ml-1" onclick="removeBlogKeyword(this)" style="cursor: pointer;"></i>
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <input type="hidden" id="blog_keywords" name="blog_keywords" value="{{ old('blog_keywords', $data->blog_meta_keywords ?? '') }}" />
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="blogKeywordInput" placeholder="Enter blog keywords (separate with commas)" />
                                            <small class="form-text text-muted">Type keywords and press Enter or click Add to add them</small>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-sm btn-success" onclick="addBlogKeyword()">Add</button>
                                        </div>
                                    </div>
                                    @error('blog_keywords')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="blog_metaDescription">Blog Meta Description</label>
                                    <textarea class="form-control @error('blog_metaDescription') is-invalid @enderror" id="blog_metaDescription" name="blog_metaDescription" rows="4" placeholder="Enter blog meta description (Maximum 160 characters)">{{ old('blog_metaDescription', $data->blog_meta_description ?? '') }}</textarea>
                                    @error('blog_metaDescription')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            {{-- content page meta --}}
                        <div class="col-lg-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Content Meta</h3>
                                </div>
                            </div>
                        </div>
                            <hr class="w-100">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="content_metaTitle">Content Meta Title</label>
                                    <input type="text" class="form-control @error('content_metaTitle') is-invalid @enderror" id="content_metaTitle" name="content_metaTitle" placeholder="Enter content meta title (Maximum 60 characters)" value="{{ old('content_metaTitle', $data->content_meta_title ?? '') }}">
                                    @error('content_metaTitle')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="content_keywords">Content Keywords</label>

                                    <div class="mt-2">
                                        <div id="selectedContentKeywords" class="form-control" style="min-height: 120px; max-height: 220px; overflow-y: auto; background-color: #f8f9fa;">
                                            @if(old('content_keywords'))
                                                @foreach(explode(',', old('content_keywords')) as $keyword)
                                                    <span class="badge badge-info mr-1 mb-1 content-keyword-tag" data-keyword="{{ trim($keyword) }}">
                                                        {{ trim($keyword) }}
                                                        <i class="fas fa-times ml-1" onclick="removeContentKeyword(this)" style="cursor: pointer;"></i>
                                                    </span>
                                                @endforeach
                                            @elseif(isset($data->content_meta_keywords) && $data->content_meta_keywords)
                                                @foreach(explode(',', $data->content_meta_keywords) as $keyword)
                                                    <span class="badge badge-info mr-1 mb-1 content-keyword-tag" data-keyword="{{ trim($keyword) }}">
                                                        {{ trim($keyword) }}
                                                        <i class="fas fa-times ml-1" onclick="removeContentKeyword(this)" style="cursor: pointer;"></i>
                                                    </span>
                                                @endforeach
                                            @endif
                                        </div>
                                        <input type="hidden" id="content_keywords" name="content_keywords" value="{{ old('content_keywords', $data->content_meta_keywords ?? '') }}" />
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" id="contentKeywordInput" placeholder="Enter content keywords (separate with commas)" />
                                            <small class="form-text text-muted">Type keywords and press Enter or click Add to add them</small>
                                        </div>
                                        <div class="col-md-4">
                                            <button type="button" class="btn btn-sm btn-info" onclick="addContentKeyword()">Add</button>
                                        </div>
                                    </div>
                                    @error('content_keywords')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="content_metaDescription">Content Meta Description</label>
                                    <textarea class="form-control @error('content_metaDescription') is-invalid @enderror" id="content_metaDescription" name="content_metaDescription" rows="4" placeholder="Enter content meta description (Maximum 160 characters)">{{ old('content_metaDescription', $data->content_meta_description ?? '') }}</textarea>
                                    @error('content_metaDescription')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>




                        </div>
            </div>
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
<!-- Keywords Management Scripts -->
<script>
    // General Keywords Functions
    function addKeyword() {
        const input = document.getElementById('keywordInput');
        const keywords = input.value.trim();

        if (keywords) {
            const keywordArray = keywords.split(',').map(k => k.trim()).filter(k => k);
            keywordArray.forEach(keyword => {
                if (keyword && !isKeywordExists(keyword, 'keyword-tag')) {
                    addKeywordTag(keyword, 'selectedKeywords', 'keyword-tag');
                }
            });
            input.value = '';
            updateHiddenInput('selectedKeywords', 'keywords');
        }
    }

    function addKeywordTag(keyword, containerId, tagClass) {
        const container = document.getElementById(containerId);
        const tag = document.createElement('span');
        tag.className = `badge badge-primary mr-1 mb-1 ${tagClass}`;
        tag.setAttribute('data-keyword', keyword);
        tag.innerHTML = `
            ${keyword}
            <i class="fas fa-times ml-1" onclick="removeKeyword(this)" style="cursor: pointer;"></i>
        `;
        container.appendChild(tag);
    }

    function removeKeyword(element) {
        element.parentElement.remove();
        updateHiddenInput('selectedKeywords', 'keywords');
    }

    function isKeywordExists(keyword, tagClass) {
        const existingTags = document.querySelectorAll(`.${tagClass}`);
        for (let tag of existingTags) {
            if (tag.getAttribute('data-keyword').toLowerCase() === keyword.toLowerCase()) {
                return true;
            }
        }
        return false;
    }

    function updateHiddenInput(containerId, hiddenInputId) {
        const tags = document.querySelectorAll(`#${containerId} .keyword-tag, #${containerId} .blog-keyword-tag, #${containerId} .content-keyword-tag`);
        const keywords = Array.from(tags).map(tag => tag.getAttribute('data-keyword')).join(',');
        document.getElementById(hiddenInputId).value = keywords;
    }

    // Blog Keywords Functions
    function addBlogKeyword() {
        const input = document.getElementById('blogKeywordInput');
        const keywords = input.value.trim();

        if (keywords) {
            const keywordArray = keywords.split(',').map(k => k.trim()).filter(k => k);
            keywordArray.forEach(keyword => {
                if (keyword && !isBlogKeywordExists(keyword)) {
                    addBlogKeywordTag(keyword);
                }
            });
            input.value = '';
            updateBlogHiddenInput();
        }
    }

    function addBlogKeywordTag(keyword) {
        const container = document.getElementById('selectedBlogKeywords');
        const tag = document.createElement('span');
        tag.className = 'badge badge-success mr-1 mb-1 blog-keyword-tag';
        tag.setAttribute('data-keyword', keyword);
        tag.innerHTML = `
            ${keyword}
            <i class="fas fa-times ml-1" onclick="removeBlogKeyword(this)" style="cursor: pointer;"></i>
        `;
        container.appendChild(tag);
    }

    function removeBlogKeyword(element) {
        element.parentElement.remove();
        updateBlogHiddenInput();
    }

    function isBlogKeywordExists(keyword) {
        const existingTags = document.querySelectorAll('.blog-keyword-tag');
        for (let tag of existingTags) {
            if (tag.getAttribute('data-keyword').toLowerCase() === keyword.toLowerCase()) {
                return true;
            }
        }
        return false;
    }

    function updateBlogHiddenInput() {
        const tags = document.querySelectorAll('.blog-keyword-tag');
        const keywords = Array.from(tags).map(tag => tag.getAttribute('data-keyword')).join(',');
        document.getElementById('blog_keywords').value = keywords;
    }

    // Content Keywords Functions
    function addContentKeyword() {
        const input = document.getElementById('contentKeywordInput');
        const keywords = input.value.trim();

        if (keywords) {
            const keywordArray = keywords.split(',').map(k => k.trim()).filter(k => k);
            keywordArray.forEach(keyword => {
                if (keyword && !isContentKeywordExists(keyword)) {
                    addContentKeywordTag(keyword);
                }
            });
            input.value = '';
            updateContentHiddenInput();
        }
    }

    function addContentKeywordTag(keyword) {
        const container = document.getElementById('selectedContentKeywords');
        const tag = document.createElement('span');
        tag.className = 'badge badge-info mr-1 mb-1 content-keyword-tag';
        tag.setAttribute('data-keyword', keyword);
        tag.innerHTML = `
            ${keyword}
            <i class="fas fa-times ml-1" onclick="removeContentKeyword(this)" style="cursor: pointer;"></i>
        `;
        container.appendChild(tag);
    }

    function removeContentKeyword(element) {
        element.parentElement.remove();
        updateContentHiddenInput();
    }

    function isContentKeywordExists(keyword) {
        const existingTags = document.querySelectorAll('.content-keyword-tag');
        for (let tag of existingTags) {
            if (tag.getAttribute('data-keyword').toLowerCase() === keyword.toLowerCase()) {
                return true;
            }
        }
        return false;
    }

    function updateContentHiddenInput() {
        const tags = document.querySelectorAll('.content-keyword-tag');
        const keywords = Array.from(tags).map(tag => tag.getAttribute('data-keyword')).join(',');
        document.getElementById('content_keywords').value = keywords;
    }

    // Handle Enter key in input fields
    document.addEventListener('DOMContentLoaded', function() {
        // General keywords
        const input = document.getElementById('keywordInput');
        if (input) {
            input.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addKeyword();
                }
            });
        }

        // Blog keywords
        const blogInput = document.getElementById('blogKeywordInput');
        if (blogInput) {
            blogInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addBlogKeyword();
                }
            });
        }

        // Content keywords
        const contentInput = document.getElementById('contentKeywordInput');
        if (contentInput) {
            contentInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addContentKeyword();
                }
            });
        }

        // Initialize hidden inputs with existing keywords
        updateHiddenInput('selectedKeywords', 'keywords');
        updateBlogHiddenInput();
        updateContentHiddenInput();
    });
</script>
@endpush
