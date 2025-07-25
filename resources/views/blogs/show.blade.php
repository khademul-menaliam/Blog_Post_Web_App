@extends('layouts.app')

@section('title', $blog->meta_title)
@section('description', $blog->meta_description)
@section('keywords', $blog->meta_keywords)

@section('content')


    <!-- ======================= breadcrumb Start  ============================ -->
    <div class="breadcrumb_sec py-3">
        <div class="container">
            <nav>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active"> {{$blog->title}}</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- ======================= breadcrumb End  ============================ -->
    <!-- banner advertisement start -->
@if($adBanner->count() > 0)

    <div class="blog_section bg-white overflow-hidden pt-4 pb-4">
        <div class="container">
            <div class="row g-4">
<!-- banner advertisement with no advertizement message start -->
                {{-- @forelse($adBanner as $banner)
                    <div class="col-12 mt-0">
                        <a target="_blank" href="{{ $banner->link }}">
                            <div class="ad-banner">
                                <img src="{{ asset('assets/images/' . $banner->img) }}" alt="{{ $banner->name }}" class="ad-image">
                            </div>
                        </a>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center text-muted">No advertisement available at the moment.</div>
                    </div>
                @endforelse --}}
<!-- end banner advertisement with no advertizement message start -->
            @foreach($adBanner as $banner)
                <div class="col-12 ">
                        <a target="_blank" href="{{ route('advertisement.clicks', $banner->id)  }}">
                            <div class="ad-banner">
                                <img src="{{ asset('assets/images/' . $banner->img) }}" alt="{{ $banner->name }}" class="ad-image">
                            </div>
                        </a>
                </div>
            @endforeach
            </div>
        </div>
    </div>

@endif
    {{-- <!-- banner advertisement end --> --}}

    <!-- ======================= Blog Details Start  ============================ -->
    <div class="blog_details_section bg-white overflow-hidden pt-4 pb-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-xl-3 order-xl-2">

                    @include('layouts.partials.sidebar')
                </div>
                <div class="col-xl-9 order-xl-1">
                    <div class="single_post blog_wrapper border p-3 p-xl-4 rounded">
                        <div class="single_photo mb-3">
                            <img src="{{ asset('assets/images/blog/' . $blog->img) }}" class="rounded w-100" alt="{{ $blog->title }}">
                        </div>
                        <div class="short_info d-sm-flex align-items-center mb-3">
                            <div class="mb-2 mb-sm-0 me-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon me-1">
                                        <img src="{{ asset('assets/images/tag.svg') }}" alt="Tag">
                                    </div>
                                    <div class="date"><span>{{ $blog->category->title }}</span></div>
                                </div>
                            </div>
                            <div class="mb-2 mb-sm-0 me-3">
                                <div class="d-flex align-items-center">
                                    <div class="icon me-1">
                                        <img src="{{ asset('assets/images/calendar.svg') }}" alt="Date">
                                    </div>
                                    <div class="date"><span>{{ $blog->created_at->format('d M, Y') }}</span></div>
                                </div>
                            </div>
                            <div class="">
                                <div class="d-flex align-items-center">
                                    <div class="icon me-1">
                                        <img src="{{ asset('assets/images/eye.svg') }}" alt="View">
                                    </div>
                                    <div class="date"><span>{{ $blog->views }}</span></div>
                                </div>
                            </div>
                        </div>
                        <div class="title mb-3">
                            <h1>{{$blog->title}}</h1>
                        </div>
                        <div class="desc">
                            {!! $blog->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Blog Details End  ============================ -->

    <!-- ======================= Related Post Start  ============================ -->
@if($relatedPost -> count() > 0)
    <div class="related_section pt-4 pb-4 border-top">
        <div class="container">
            <div class="section_heading pb-4">
                <h1 class="section_title">You may also like</h1>
            </div>
            <div class="related_posts owl-theme owl-carousel">
                <!-- blog post -->

            @foreach($relatedPost as $post)
                <!-- related post card here -->
                {{-- releted post --}}
                <div class="blog_post p-3 p-lg-4 card h-100 bg-transparent shadow-sm border-opacity-10">
                    <div class="blog_img mb-4 position-relative">
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <img class="img-fluid rounded z-3" src="{{ asset('assets/images/blog/' . $post->img) }}"
                                alt="{{ $post->title }}">
                        </a>
                    </div>
                    <div class="short_info d-sm-flex align-items-center mb-3">
                        <div class="mb-2 mb-sm-0 me-3">
                            <div class="d-flex align-items-center">
                                <div class="icon me-1">
                                    <img src="{{ asset('assets/images/tag.svg') }}" alt="Tag">
                                </div>
                                <div class="date"><span>{{ $post->category->title }}</span></div>
                            </div>
                        </div>
                        <div class="mb-2 mb-sm-0 me-3">
                            <div class="d-flex align-items-center">
                                <div class="icon me-1">
                                    <img src="{{ asset('assets/images/calendar.svg') }}" alt="Date">
                                </div>
                                <div class="date"><span>{{ $post->created_at->format('d M, Y') }}</span></div>
                            </div>
                        </div>
                        <div class="">
                            <div class="d-flex align-items-center">
                                <div class="icon me-1">
                                    <img src="{{ asset('assets/images/eye.svg') }}" alt="View">
                                </div>
                                <div class="date"><span>{{ $post->views }}</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="blog_content card-body p-0">
                        <h3 class="mb-3">
                            <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                        </h3>
                        <div class="blog_desc mb-2">{!! Str::limit(strip_tags($post->description), 150) !!}
                        </div>
                    </div>
                    <hr>
                    <div class="card-footer mt-2 bg-transparent border-0 blog_content p-0">
                        <a class="learn_more" href="{{ route('blog.show', $post->slug) }}">Read More</a>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
@endif
    <!-- ======================= Related Post End  ============================ -->


@endsection
