@extends('admin.layouts.app')

    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Category View')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category View</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">Category View</li>
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Category</h3>
                            <a class="float-right" href="{{route('admin.category.create')}}">Add Category +</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="postlist" class="table table-bordered table-striped">
                        <!-- Demo data rows -->
                            <tr>
                                <th>Title</th>
                                <td>{{$post->title}}</td>
                            </tr>
                            <tr>
                                <th>Slug</th>
                                <td>{{$post->slug}}</td>
                            </tr>
                            <tr>
                                <th>Meta Title</th>
                                <td>{{$post->meta_title}}</td>
                            </tr>
                            <tr>
                                <th>Description</th>
                                <td>{!! $post->meta_description !!}</td>
                            </tr>

                            <tr>
                                <th>Author</th>
                                <td>{{ $post->user->name ?? 'Unknown' }}</td>
                            </tr>
                            <tr>
                                <th>Meta Keywords</th>
                                <td>{{$post->meta_keywords}}</td>
                            </tr>
                            <tr>
                                <th>Date</th>
                                <td style="white-space: nowrap;">{{$post->created_at->format('d/ m/ Y')}}</td>
                            </tr>

                        </table>
                        @can('admin.blog-category.edit')
                             <div class="mt-3">
                                <a class="btn btn-info btn-sm" href="{{route('admin.category.edit', $post->id)}}">Edit </a>
                            </div>
                        @endcan
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection
