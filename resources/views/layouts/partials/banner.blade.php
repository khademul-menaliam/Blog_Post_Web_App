    <!-- ======================= slider section  ============================ -->
    <div class="slider_section bg-white overflow-hidden pt-4 pb-4">
        <div class="container">
            <div class="row g-4">
                <!-- Left side large banner (Main Banner) -->
                <div class="col-lg-8">
                    @if($mainBanner)
                        <a href="{{ route('blog.show', $mainBanner->slug) }}" class="banner">
                            <div class="banner-left">
                                <img src="{{ asset('assets/images/blog/' . $mainBanner->img) }}" class="img-fluid w-100" alt="{{ $mainBanner->title }}">
                                <div class="banner-content">
                                    <h2>{{ $mainBanner->title }}</h2>
                                    <p>{!! Str::limit(strip_tags($mainBanner->description), 150) !!}</p>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>

                <!-- Right side small banners (Others) -->
                <div class="col-lg-4">
                    <div class="row">
                        @foreach($othersBanner as $banner)
                            <div class="col-12 mb-3">
                                <a href="{{ route('blog.show', $banner->slug) }}" class="banner">
                                    <div class="banner-small">
                                        <img src="{{ asset('assets/images/blog/' . $banner->img) }}" class="img-fluid w-100" alt="{{ $banner->title }}">
                                        <div class="banner-content">
                                            <h3>{!! Str::limit($banner->title, 80) !!}</h3>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
<!-- ======================= slider End  ============================ -->

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
                <div class="col-12">
                        <a target="_blank" href="{{route('advertisement.clicks', $banner->id) }}">
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


