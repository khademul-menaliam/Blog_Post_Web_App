@extends('admin.layouts.app')

    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Admin Rule Create')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Admin Rule Create</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Rules create</li>
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
                        <h3 class="card-title">Create Rule</h3>
                         <a class="float-right" href="{{route('admin.roles.index')}}">Back</a>
                    </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                    @if(session('success'))
                        <div class="alert alert-success m-2">{{ session('success') }}</div>
                    @endif
                    <!-- /.card-header -->
                    <form method="POST" action="{{ route('admin.roles.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="name" class="form-label">Role Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>

                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="permission_all" onclick="toggleAllPermissions(this)">
                                            <label for="permission_all" class="custom-control-label">All Permission</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php $groupIndex = 1; @endphp
                            @foreach($permissions as $group => $perms)
                                <div class="row">
                                    <div class="col-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="group{{ $groupIndex }}management"
                                                onclick="CheckPermissionByGroup('role-{{ $groupIndex }}-management-checkbox', this)">
                                            <label for="group{{ $groupIndex }}management" class="custom-control-label text-capitalize">
                                                {{ $group }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-9 role-{{ $groupIndex }}-management-checkbox">
                                        @foreach($perms as $permission)
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="permissions[]" class="custom-control-input"
                                                    id="permission_checkbox_{{ $permission->id }}" value="{{ $permission->name }}">
                                                <label for="permission_checkbox_{{ $permission->id }}"
                                                    class="custom-control-label">{{ $permission->name }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                                @php $groupIndex++; @endphp
                            @endforeach
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>

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
@push('scripts')
    <script>
        $('#permission_all').click(function() {
            if ($(this).is(':checked')) {
                // check all the checkbox
                $('input[type=checkbox]').prop('checked', true);
            } else {
                // uncheck all the checkbox
                $('input[type=checkbox]').prop('checked', false);
            }
        });

        // check permission by group
        function CheckPermissionByGroup(classname, checkthis) {
            const groupIdName = $("#" + checkthis.id);
            const classCheckBox = $('.' + classname + ' input');
            if (groupIdName.is(':checked')) {
                // check all the checkbox
                classCheckBox.prop('checked', true);
            } else {
                // uncheck all the checkbox
                classCheckBox.prop('checked', false);
            }
        }
    </script>

@endpush
