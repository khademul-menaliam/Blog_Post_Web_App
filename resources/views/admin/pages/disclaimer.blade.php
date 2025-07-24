@extends('admin.layouts.app')

    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Privacy and Policy')

@section('content')
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Disclaimer</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item ">Disclaimer</li>
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
                                    <h3 class="card-title">Disclaimer</h3>
                                </div>
                                <!-- /.card-header -->
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <!-- form start -->
                                <form action="{{route('admin.disclaimer.update', $post->id)}}" method="POST">
                                     @csrf
                            @method('PUT')
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="Title">Page Title</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $post->name) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
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
                                            <label for="meta_keywords">Meta Keywords</label>
                                            {{-- <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" placeholder="meta keywords"> --}}
                                        <select class="form-control " id="keywords" name="keywords[]" multiple="multiple" >
                                        @php
                                            $keywords = old('keywords', explode(',', $post->meta_keywords)) ;
                                        @endphp
                                        @foreach($keywords as $keyword)
                                            <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                                        @endforeach
                                    </select>
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
