@extends('admin.layouts.app')

    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Profile')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profile View</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">Profile View</li>
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
                            <h3 class="card-title">Profile</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="postlist" class="table table-bordered table-striped">
                                <!-- Demo data rows -->
                                <tr>
                                    <th>Full Name</th>
                                    <td>{{ $admin->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $admin->email ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th class="text-left align-middle">Profile Image </th>
                                    <td><img src="{{asset('assets/images/users/'.$admin->img)}}" width="200" alt="img"></td>
                                </tr>
                                <tr>
                                    <th>Role</th>
                                    <td>
                                        {{ $roles->where('id', $admin->role_id)->first()->name ?? 'User' }}
                                    </td>
                                </tr>

                                <tr>
                                    <th>Registration Date</th>
                                    <td>{{ $admin->created_at ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Last Update</th>
                                    <td>{{ $admin->updated_at ?? 'N/A' }}</td>
                                </tr>
                            </table>
                            @if($admin->role_id==3)
                                @can('admin.user.edit')
                                    <div class="mt-3">
                                        <a class="btn btn-info btn-sm" href="{{route('admin.users.edit', $admin->id)}}">Edit </a>
                                    </div>
                                @endcan
                            @endif
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
