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
                            Villa Torlonia
                            Villa Torlonia is a historic villa with lovely grounds and neoclassical architecture. It was
                            owned by the influential Torlonia family, renowned bankers in the 19th and early 20th
                            centuries.


                            The estate underwent substantial changes during their ownership, marked by the establishment
                            of enchanting gardens. House of the Owls, Gardens, and Neoclassical Architecture holds the
                            elegance of the period and the magnetic power of drawing tourists.


                            The highlight of Villa Torlonia is Mussolini's bunker, an underground structure where the
                            dictator sought refuge during World War II. The aristocratic origins of its role as
                            Mussolini's residence provide a nuanced understanding of Italy's pivotal historical period.


                            Situated approximately 4 kilometers (around 2.5 miles) northeast of the central Rome area,
                            its historical and architectural treasuresmake it a worthwhile journey for those seeking a
                            deeper exploration of Rome's diverse cultural heritage.


                            Palazzo Doria Pamphilj
                            Palazzo Doria Pamphilj is another architecture to explore for those fascinated by palaces
                            after Villa Torlonia. The architecture of the palace featuring courtyards, galleries, and
                            private spaces, is a testament to the grand architectural styles of its time.


                            The Doria Pamphilj Gallery within the palace houses an extraordinary art collection,
                            showcasing masterpieces by illustrious artists such as Raphael, Caravaggio, Titian, and
                            Velázquez—making it a compelling attraction for art enthusiasts.


                            Visitors can delve into the opulent lifestyle of noble families by exploring the private
                            apartments of the palace. Lavish furnishings, decorative arts, and historical artifacts
                            contribute to the immersive experience. The palace is at the center of Rome, near Piazza
                            Venezia and the Pantheon, which will be a cherry on the ice cream for the tourists.

                            Aventine Keyhole
                            The Aventine Keyhole in Rome, a once-secret attraction, is gaining popularity. Located at
                            the entrance of Priorato di Malta in the Aventine Hill neighborhood of Rome, the keyhole
                            offers a unique view of St. Peter's Dome through exquisitely manicured hedges in a
                            seldom-opened garden.

                            This peculiar and free experience attracts visitors, but capturing the perfect photo may
                            require adjusting for light and queuing. Nearby snack vendors offer refreshments. Accessible
                            and enchanting, the Aventine Keyhole remains a hidden gem despite its growing renown.


                            Enjoy City Tour provides a budget car rental Rome tour for enthusiastic tourists and helps
                            delve into Rome's seen and unseen, heard and unheard beauty. Apart from the aforementioned
                            places, there are other aesthetic places we can take you to and guide you on walking routes.


                            We can offer you a tourist guide for a city sightseeing bus tour Rome. use our mobile app or
                            website to book your desired rental car and a tourist guide for further help. We are here to
                            assist you throughout your tour in Rome, Italy.


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ======================= Blog Details End  ============================ -->

    <!-- ======================= Related Post Start  ============================ -->
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
                        <div class="blog_desc mb-2">{{ Str::limit(strip_tags($post->description), 150) }}
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
    <!-- ======================= Related Post End  ============================ -->


@endsection
