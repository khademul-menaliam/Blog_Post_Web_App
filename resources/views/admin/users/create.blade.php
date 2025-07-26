@extends('admin.layouts.app')
@section('title', 'User Create')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item">Create User</li>
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
                            <h3 class="card-title">Add New User</h3>
                        </div>
                        <!-- /.card-header -->
                    <!-- form start -->
                        <!-- form start -->
                    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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
                                        id="name" name="name" placeholder="Enter full name" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Email --}}
                                <div class="form-group">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Enter email address" value="{{ old('email') }}">
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
                                       <option value="1">Admin</option>
                                       <option value="0">Editor</option>
                                    </select>
                                </div>

                                {{-- Date of Birth (optional or required) --}}
                                <div class="form-group">
                                    <label for="dob">Date of Birth</label>
                                    <input type="date" class="form-control @error('dob') is-invalid @enderror"
                                        id="dob" name="dob" value="{{ old('dob') }}">
                                    @error('dob')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Profile Image --}}
                                <div class="form-group">
                                    <label for="img">Profile Image <span class="text-danger">( Image size recomanded 100 x 100 )</span></label>
                                    <input type="file" class="form-control-file @error('img') is-invalid @enderror"
                                        id="img" name="img">
                                    @error('img')
                                        <span class="invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                 {{-- Profile Status --}}
                                <div class="form-group">
                                    <label for="status">Select Status <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="0">Pending</option>
                                       <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>

                            <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                    </div>
                </form>
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
    <!-- Include CKEditor 5 from CDN -->
    <script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/classic/ckeditor.js"></script>
    <script src="https://unpkg.com/@ckeditor/ckeditor5-inspector@4.1.0/build/inspector.js"></script>

        <script>
        $(function () {
            let table = new DataTable('#postlist');
        });
    </script>
  <script>
    // Custom plugin (for example purposes, not adding functionality here)
    function CustomizationPlugin(editor) {}

    // Initialize CKEditor 5 with extended toolbar and plugins
    ClassicEditor
        .create(document.querySelector('#description'), {
            extraPlugins: [CustomizationPlugin],
            toolbar: {
                items: [
                    'heading', '|',
                    'bold', 'italic', 'link', 'bulletedList', 'numberedList', '|',
                    'indent', 'outdent', '|',
                    'imageUpload', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                    'undo', 'redo', 'alignment', 'fontSize', 'fontColor', 'highlight', 'codeBlock'
                ]
            },
            image: {
                toolbar: [
                    'imageTextAlternative', 'imageStyle:full', 'imageStyle:side'
                ]
            },
            table: {
                contentToolbar: [
                    'tableColumn', 'tableRow', 'mergeTableCells'
                ]
            },
            language: 'en'
        })
        .then(newEditor => {
            window.editor = newEditor;
            // The following line adds CKEditor 5 inspector.
            CKEditorInspector.attach(newEditor, {
                isCollapsed: true
            });
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function generateSlug(text) {
        return text
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')     // Remove invalid chars
            .replace(/\s+/g, '-')             // Replace whitespace with -
            .replace(/-+/g, '-');             // Collapse multiple -
    }

    $(document).ready(function() {
        $('#postTitle').on('keyup change', function() {
            let title = $(this).val();
            let slug = generateSlug(title);
            $('#postSlug').val(slug);
        });
    });
</script>
<!-- jQuery (required) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        $('#keywords').select2({
            tags: true,
            tokenSeparators: [','],
            placeholder: "Enter keywords...",
            width: '100%'
        });
    });
</script>



@endpush
