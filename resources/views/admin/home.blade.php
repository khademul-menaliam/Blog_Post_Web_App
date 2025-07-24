@extends('admin.layouts.app')

    {{-- @include('admin.layouts.partials.sidebar') --}}

@section('content')
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6">
                     <h1 class="m-0">Dashboard</h1>
                  </div>
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                     </ol>
                  </div>
               </div>
            </div>
         </div>
         <!-- Main content -->
         <div class="content">
            <div class="container-fluid">
               <div class="row">
                  <!-- Total Categories -->
                  <div class="col-lg-3 col-6">
                     <div class="small-box bg-info">
                        <div class="inner">
                           <h3>{{$totalcategories}}</h3>
                           <p>Total Categories</p>
                        </div>
                        <div class="icon">
                           <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{route('admin.category.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- Total Posts -->
                  <div class="col-lg-3 col-6">
                     <div class="small-box bg-success">
                        <div class="inner">
                           <h3>{{$totalblogs}}</h3>
                           <p>Total Posts</p>
                        </div>
                        <div class="icon">
                           <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.blogs.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-lg-3 col-6">
                     <div class="small-box bg-info">
                        <div class="inner">
                           <h3>{{$totaldraftblogs}}</h3>
                           <p>Pending Posts</p>
                        </div>
                        <div class="icon">
                           <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.blogs.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-lg-3 col-6">
                     <div class="small-box bg-default">
                        <div class="inner">
                           <h3>{{$totalpublishedblogs}}</h3>
                           <p>Published Posts</p>
                        </div>
                        <div class="icon">
                           <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{route('admin.blogs.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <!-- Latest Posts -->
                  <div class="col-lg-12 col-12">
                     <div class="card">
                        <div class="card-header border-transparent">
                           <h3 class="card-title">Latest Posts</h3>
                           <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                              </button>
                           </div>
                        </div>
                        <div class="card-body p-0">
                           <div class="table-responsive">
                            <table id="postlist" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Author</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                    <tbody>
                        <!-- Demo data rows -->
                        @foreach($blogs as $post)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$post->title}}</td>
                            <td>{{$post->category->title}}</td>
                            <td>{!! Str::limit($post->description, 80)!!}</td>
                            <td><img src="{{asset('assets/images/blog/'.$post->img)}}" width="50" height="50" alt="img"></td>
                            <td>{{ $post->user->name ?? 'N/A' }}</td>
                            <td>
                                <a href="{{route('admin.blogs.show', $post->id)}}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{route('admin.blogs.edit', $post->id)}}" class="btn btn-info btn-sm">Edit</a>


                                <form action="{{ route('admin.blogs.destroy', $post->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                </form>
                            </td>
                        </tr>

                        @endforeach


                    </tbody>

                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>image</th>
                                        <th>Author</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                           </div>
                        </div>
                        <div class="card-footer clearfix">
                           <a href="{{route('admin.blogs.index')}}" class="btn btn-sm btn-secondary float-right">View All Post</a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <!-- Latest Categories -->
                  <div class="col-lg-12 col-12">
                     <div class="card">
                        <div class="card-header border-transparent">
                           <h3 class="card-title">Latest Categories</h3>
                           <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                              </button>
                           </div>
                        </div>
                        <div class="card-body p-0">
                           <div class="table-responsive">
                            <table id="postlist" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>SL.</th>
                                        <th>Category Name</th>
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
                                        <td>{{$category->slug}}</td>
                                        <td>{{$category->created_at->format('d/ m/ Y')}}</td>
                                    <td>
                                        <a href="{{route('admin.category.show', $category->id)}}" class="btn btn-primary btn-sm">View</a>
                                        <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-info btn-sm">Edit</a>

                                        <form action="{{route('admin.category.destroy', $category->id)}}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach


                                </tbody>

                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Name</th>
                                        <th>Slug</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </tfoot>
                            </table>
                           </div>
                        </div>
                        <div class="card-footer clearfix">
                           <a href="{{route('admin.category.index')}}" class="btn btn-sm btn-secondary float-right">View All Categories</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
@endsection
