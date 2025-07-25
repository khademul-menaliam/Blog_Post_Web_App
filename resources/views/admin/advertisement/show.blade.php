@extends('admin.layouts.app')

    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Post View')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Advertisements View</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">Advertisements View</li>
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
                            <h3 class="card-title">Advertisement</h3>
                            <a class="float-right" href="{{route('admin.advertisement.create')}}">Add Advertisements +</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="postlist" class="table table-bordered table-striped">
                        <!-- Demo data rows -->
                        <tr>
                            <th>Name</th>
                            <td>{{$post->name}}</td>
                        </tr>
                        <tr>
                            <th>Link</th>
                            <td>{{$post->link}}</td>
                        </tr>
                        <tr>
                            <th>Image</th>
                            <td><img src="{{asset('assets/images/'.$post->img)}}" width="200" alt="img"></td>
                        </tr>
                        <tr>
                            <th>Date</th>
                            <td style="white-space: nowrap;">{{$post->created_at->format('d/ m/ Y')}}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $post->status ? 'Yes' : 'No' }}</td>
                        </tr>

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
