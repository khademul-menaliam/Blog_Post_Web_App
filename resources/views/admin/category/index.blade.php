@extends('admin.layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
@endpush
    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Category List')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Category List</h1>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Category</h3>
                        <a class="float-right" href="{{route('admin.category.create')}}">Create New + </a>
                    </div>
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="postlist" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Category Name</th>
                                    <th>Author</th>
                                    <th>Slug</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Demo data rows -->
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->user->name ?? 'N/A' }}</td>
                                    <td>{{$category->slug}}</td>
                                    <td>{{$category->created_at->format('d/ m/ Y')}}</td>
                                    <td>
                                        @can('admin.blog-category.view')
                                            <a href="{{route('admin.category.show', $category->id)}}" class="btn btn-primary btn-sm">View</a>
                                        @endcan
                                        @can('admin.blog-category.edit')
                                            <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-info btn-sm">Edit</a>
                                        @endcan
                                        @can('admin.blog-category.delete')
                                            <form action="{{route('admin.category.destroy', $category->id)}}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Category Name</th>
                                    <th>Author</th>
                                    <th>Slug</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </tfoot>
                        </table>
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
@push('scripts')
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#postlist');
    </script>
@endpush
