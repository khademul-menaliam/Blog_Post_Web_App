@extends('admin.layouts.app')

    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Admin Rules')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Admin Rules</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Admin Rules</li>
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
            <!-- Add Role Form -->
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Admin Rules</h3>
                         <a class="float-right" href="{{route('admin.users.roles.create')}}">Add Role +</a>
                    </div>
                    <!-- /.card-header -->
                    @if(session('error'))
                         <div class="alert alert-danger m-2">{{ session('error') }}</div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success m-2">{{ session('success') }}</div>
                    @endif


                        <div class="card-body">
                            <table id="postlist" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Role Name</th>
                                        <th>Permissions</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as  $role)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @if ($role->permissions->count() === $totalPermissionsCount)
                                                    <span class="badge badge-success">All Permissions</span>
                                                @else
                                                    @foreach ($role->permissions as $permission)
                                                        <span class="badge badge-primary">{{ $permission->name }}</span>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{ $role->created_at->format('Y-m-d') }}</td>
                                            <td>
                                                <a  href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-info btn-sm">Edit</a>

                                                <form class="mt-2" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" style="display: inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this role?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>


                                <tfoot>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Role Name</th>
                                        <th>Permissions</th>
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
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->

@endsection
