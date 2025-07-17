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
                            <label for="keywords">Keywords</label>
                            <select class="form-control" id="keywords" name="keywords[]" multiple="multiple">
                                @php
                                    $keywords = old('keywords', isset($data->meta_keywords) ? explode(',', $data->meta_keywords) : []);
                                @endphp
                                @foreach($keywords as $keyword)
                                    <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                @endforeach
                            </select>
                            @error('keywords')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="metaDescription">Meta Description</label>
                            <textarea class="form-control @error('metaDescription') is-invalid @enderror" id="metaDescription" name="metaDescription" rows="4" placeholder="Enter meta description (Maximum 160 characters)">{{ old('metaDescription', $data->meta_description ?? '') }}</textarea>
                            @error('metaDescription')
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
                            <select class="form-control" id="blog_keywords" name="blog_keywords[]" multiple="multiple">
                                @php
                                    $blog_keywords = old('blog_keywords', isset($data->blog_meta_keywords) ? explode(',', $data->blog_meta_keywords) : []);
                                @endphp
                                @foreach($blog_keywords as $keyword)
                                    <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                @endforeach
                            </select>
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
                            <select class="form-control" id="content_keywords" name="content_keywords[]" multiple="multiple">
                                @php
                                    $content_keywords = old('content_keywords', isset($data->content_meta_keywords) ? explode(',', $data->content_meta_keywords) : []);
                                @endphp
                                @foreach($content_keywords as $keyword)
                                    <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                @endforeach
                            </select>
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
