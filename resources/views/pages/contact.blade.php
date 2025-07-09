@extends('layouts.app')

@section('title', getSiteSettings()->content_meta_title)
@section('description', getSiteSettings()->content_meta_description)
@section('keywords', getSiteSettings()->content_meta_keywords)


@section('content')



<!-- ======================= breadcrumb Start  ============================ -->
<div class="breadcrumb_sec py-3">
    <div class="container">
        <nav>
            <ol class="breadcrumb m-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active">Contact Us</li>
            </ol>
        </nav>
    </div>
</div>
<!-- ======================= breadcrumb End  ============================ -->

<!-- ======================= Contact Start  ============================ -->
<div class="contact_section pb-5 overflow-hidden">
    <div class="container">
        <div class="row gy-3 mb-4 justify-content-center">
            <div class="col-xl-4 col-md-6">
                <div class="contact_item shadow-sm d-flex align-items-center">
                    <div class="contact_icon me-3">
                            <img src="assets/images/icons/phone-dark.svg" alt="Phone">
                    </div>
                    <div class="contact_body">
                        <h5 class="contact_title mb-2">Phone</h5>
                        <ul class="contact_info">
                            <li>
                                <a href="Tel:{{getSiteSettings()->phone}}">{{getSiteSettings()->phone}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
                <div class="contact_item shadow-sm d-flex align-items-center">
                    <div class="contact_icon me-3">
                        <img src="assets/images/icons/email-dark.svg" alt="Email">
                    </div>
                    <div class="contact_body">
                        <h5 class="contact_title mb-2">Email</h5>
                        <ul class="contact_info">
                            <li>
                                <a href="mailto:{{getSiteSettings()->email}}">{{getSiteSettings()->email}}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-8">
                <div class="contact_item shadow-sm d-flex align-items-center">
                    <div class="contact_icon me-3">
                        <img src="assets/images/icons/location.svg" alt="Address">
                    </div>
                    <div class="contact_body">
                        <h5 class="contact_title mb-2">Address</h5>
                        <ul class="contact_info">
                            <li>{{getSiteSettings()->address}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-5">
            <div class="col-xl-6">
                <div class="contact_form">
                        @if(session('success'))
                            <div class="alert alert-success mt-2 mb-2">
                            {{ session('success') }}
                            </div>
                        @endif
                    <form class="row" action="{{route('savecontact')}}" method="post">
                        @csrf
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label form--label">Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" placeholder="Your Name" class="form-control shadow-none" required="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label form--label">E-Mail <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" placeholder="Enter E-Mail Address" class="form-control shadow-none"
                                required="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="subject" class="form-label form--label">Subject <span class="text-danger">*</span></label>
                            <input type="text" name="subjects" id="subject" placeholder="Write your subject" class="form-control shadow-none"
                                required="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="message" class="form-label form--label">Your Message <span class="text-danger">*</span></label>
                            <textarea required="" name="message" id="message" placeholder="Write your message"
                                class="form-control shadow-none" rows="5"></textarea>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm px-5 text-uppercase">Submit</button>
                        </div>
                    </form>
                @if($errors->any())
                <div class="alert alert-danger mt-2 mb-2">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                </div>
            </div>
            <div class="col-xl-6">
                <div class="ratio ratio-16x9">
                    <iframe src="{{getSiteSettings()->map_url}}" style="border:0; width:100%;" class="rounded" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection





