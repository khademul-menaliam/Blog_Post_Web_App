@extends('admin.layouts.app')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
@endpush
    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Post List')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Advertisement List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">Advertisement List</li>
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
                            <h3 class="card-title">Advertisements</h3>
                            <a class="float-right" href="{{route('admin.advertisement.create')}}">Add Advertisement +</a>
                        </div>
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session('success') }}
                                    </div>
                                @endif
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="cal-md-5">
                                    <select class="form-control" name="status" id="status">
                                        <option value="" {{ request('status') === null || request('status') === '' ? 'selected' : '' }}>All post</option>
                                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>UnActive</option>
                                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Active</option>
                                    </select>
                                </div>
                            </div>
                            <table id="addlist" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>Clicks</th>
                                        <th>Image</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Demo data rows -->
                                    @foreach($adds as $post)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$post->name}}</td>
                                        <td>{{ $post->link ?? 'N/A' }}</td>
                                        <td>{{ $post->clicks ?? 'N/A' }}</td>
                                        <td><img src="{{asset('assets/images/'.$post->img)}}" width="250" height="50" alt="img"><a target="_blank" href="{{asset('assets/images/'.$post->img)}}"> Preview</a></td>

                                        <td style="white-space: nowrap;">{{$post->created_at->format('d / m / Y') }}</td>
                                        <td>@if ($post->status==0) <span class="text-danger">UnActive</span> @else <span class="text-success">Active</span>@endif </td>
                                        <td>
                                            @can('admin.advertisement.view', $user)
                                                <a href="{{route('admin.advertisement.show', $post->id)}}" class="btn btn-primary btn-sm">View</a>
                                            @endcan
                                            @can('admin.advertisement.edit', $user)
                                                <a href="{{route('admin.advertisement.edit', $post->id)}}" class="btn btn-info btn-sm">Edit</a>
                                            @endcan
                                            @can('admin.advertisement.delete', $user)
                                                <form action="{{ route('admin.advertisement.destroy', $post->id) }}" method="POST" style="display:inline;">
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
                                        <th>Name</th>
                                        <th>Link</th>
                                        <th>Clicks</th>
                                        <th>Image</th>
                                        <th>Date</th>
                                        <th>Status</th>
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
        $(document).ready(function() {
            $('#status').on('change', function() {
                let status = $(this).val();
                let url = new URL(window.location.href);
                if (status === "") {
                    url.searchParams.delete('status');
                } else {
                    url.searchParams.set('status', status);
                }
                window.location.href = url.toString();
            });
        });
    </script>
    <script>
        let table = new DataTable('#addlist');
    </script>
@endpush
