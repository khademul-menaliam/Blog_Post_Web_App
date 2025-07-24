@extends('admin.layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
@endpush
    {{-- @include('admin.layouts.partials.sidebar') --}}
    @section('title', 'Contact List')

@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Contact List</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item ">Contact List</li>
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
                        <h3 class="card-title">Contacts</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="contactlist" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subjects</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Demo data rows -->
                                @foreach($contacts as $contact)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$contact->name}}</td>
                                    <td>{{$contact->email ?? 'N/A' }}</td>
                                    <td>{{$contact->subjects}}</td>
                                    <td>{{$contact->message}}</td>
                                    <td>{{$contact->created_at->format('d/ m/ Y')}}</td>
                                    <td>@if ($contact->status==0) <span class="text-danger">UnSolve</span> @else <span class="text-success">Solved</span>@endif </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Subjects</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Status</th>
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
        let table = new DataTable('#contactlist');
    </script>
@endpush
