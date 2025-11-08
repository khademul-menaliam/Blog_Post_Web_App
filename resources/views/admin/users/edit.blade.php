@extends('admin.layouts.app')

{{-- @include('admin.layouts.partials.sidebar') --}}
@section('title', 'user Edit')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit user</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item ">users List</li>
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
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit user</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('admin.users.update', $user->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @if(session('success'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if(session('error') || session('error_detail'))
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                        <ul class="mb-0">
                                            @if(session('error'))
                                                <li>{{ session('error') }}</li>
                                            @endif
                                            @if(session('error_detail'))
                                                <li><strong>Details:</strong> {{ session('error_detail') }}</li>
                                            @endif
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                  {{-- Full Name --}}
                                <div class="form-group">
                                    <label for="name">Full Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" placeholder="Enter full name" value="{{ old('name', $user->name)}}">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Enter email address" value="{{ old('email',$user->email) }}">
                                    @error('email')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Password --}}
                                <div class="form-group">
                                    <label for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Enter password">
                                    @error('password')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- ROle --}}
                                <div class="form-group">
                                    <label for="role">Role <span class="text-danger">*</span></label>
                                    <select class="form-control " id="role" name="role">
                                        <option value="">Select Role</option>
                                        @foreach($roles as $role)
                                       <option value="{{$role->id}}" {{$user->role_id == $role->id  ? 'selected': ''}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Image --}}
                                <div class="form-group">
                                    <label for="postImage">Post Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input @error('img') is-invalid @enderror" id="img" name="img">
                                            <label class="custom-file-label" for="postImage">Choose file</label>
                                        </div>
                                    </div>
                                    @if($user->img)
                                        <div class="mt-2">
                                            <img src="{{ asset('assets/images/users/' . $user->img) }}" alt="Current Image" style="max-width: 150px;">
                                        </div>
                                    @endif
                                    @error('img')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror

                                {{-- status --}}
                                </div>
                                    <div class="form-group">
                                    <label for="status">Select Status <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="0" {{$user->status == 0 ? 'selected': ''}}>Draft</option>
                                       <option value="1" {{$user->status == 1 ? 'selected': ''}}>Published</option>
                                    </select>
                                </div>

                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@endsection

@push('scripts')
    <!-- Include CKEditor 5 from CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-inspector@4.1.0/build/inspector.js"></script>

        <script>
        $(function () {
            let table = new DataTable('#postlist');
        });
    </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




@endpush
