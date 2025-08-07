@extends('admin.layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
@endpush
    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Admin User List')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item ">Users List</li>
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
                        <h3 class="card-title">Users</h3>
                        <a class="float-right" href="{{route('admin.users.create')}}">Create New + </a>
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
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Avatar</th>
                                    <th>Role</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Demo data rows -->
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email ?? 'N/A' }}</td>
                                    <td><img src="{{asset('assets/images/users/'.$user->img)}}" width="50" height="50" alt="img"></td>
                                    {{-- <td>{{$user->role->name ?? 'N/A' }}</td> --}}
                                    <td>{{ $roles->where('id', $user->role_id)->first()->name ?? 'No Role' }}</td>
                                    <td>{{ optional($user->created_at)->format('d/m/Y') ?: 'N/A' }}</td>
                                    <td>
                                        @can('admin.user.edit')
                                            <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-info btn-sm m-2">Edit</a>
                                        @endcan
                                        @can('admin.user.delete')
                                            <form action="{{route('admin.users.destroy', $user->id)}}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm m-2" type="submit" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>SL.</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Avatar</th>
                                    <th>Role</th>
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
