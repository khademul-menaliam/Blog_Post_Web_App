@extends('layouts.app')

@section('title', 'Sitemap')
@section('description', 'Sitemap')
@section('keywords', 'Sitemap')

@section('content')
    <!-- ======================= breadcrumb Start  ============================ -->
    <div class="breadcrumb_sec py-3">
        <div class="container">
            <nav>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Sitemap</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- ======================= breadcrumb End  ============================ -->

    <!-- ======================= Custom page Start  ============================ -->
    <div class="custom_section pb-5 sitemap">
        <div class="container">
            <div class="bg-white rounded p-4 border">
                <div class="page_content">
                    <h1 class="page_title">Sitemap</h1>
                    <p>The site is organised into several sections, as shown below. The sections are broken down by category and there is also a general section where you will find pages with useful information.</p>
                    <div class="categories mt-5">
                        <h3>Categories</h3>
                        <ul>
                            @foreach($categories as $category)

                            <li><a href="{{route('category.show', $category->slug)}}">{{$category->title}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <hr>
                    <div class="pages">
                        <h3>Common Pages</h3>
                        <ul>
                            <li><a href="{{route('blogs.index')}}">Blog</a></li>
                            <li><a href="{{route('about.us.index')}}">About US</a></li>
                            <li><a href="{{route('disclaimer.index')}}">Disclaimer</a></li>
                            <li><a href="{{route('privacy.index')}}">Privacy Policy</a></li>
                            <li><a href="{{route('terms.index')}}">Terms Conditions</a></li>
                            <li><a href="{{route('siteMap.index')}}">SiteMap</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Custom page End  ============================ -->
@endsection
