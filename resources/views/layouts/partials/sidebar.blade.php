    {{-- <!-- ======================= slider section  ============================ -->
    <div class="slider_section bg-white overflow-hidden pt-4 pb-4">
        <div class="container">
            <div class="row g-4">
                <!-- Left side large banner -->
                <div class="col-lg-8">
                    <a href="your-link-here" class="banner">
                        <div class="banner-left">
                            <img src="https://blog.bikroy.com/en/wp-content/uploads/2024/09/Blog-Size-Biraat-Haat-Winner-780x470.jpg" class="img-fluid w-100" alt="Main Banner">
                            <div class="banner-content">
                                <h2>Birat Haat 2024 Contest Winners Announced by Bikroy and Minister</h2>
                                <p>Bikroy, a leading online platform for livestock trading in Bangladesh, hosted the winners' announcement ceremony...</p>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Right side small banners -->
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <a href="your-link-here" class="banner">
                                <div class="banner-small">
                                    <img src="https://blog.bikroy.com/en/wp-content/uploads/2024/08/Ad-Boost-Blog-780x470-1.png" class="img-fluid w-100" alt="Small Banner 1">
                                    <div class="banner-content">
                                        <h3>Boost Your Ads for Better Results with Bikroy's Latest Feature</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-12">
                            <a href="your-link-here" class="banner">
                                <div class="banner-small">
                                    <img src="https://blog.bikroy.com/en/wp-content/uploads/2024/08/Ad-Boost-Blog-780x470-1.png" class="img-fluid w-100" alt="Small Banner 2">
                                    <div class="banner-content">
                                        <h3>Introducing the Amazing "Saved Search" Feature on Bikroy</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ======================= slider End  ============================ -->
     <!-- banner advertisement start -->
     <div class="blog_section bg-white overflow-hidden pt-4 pb-4">
        <div class="container">
        <div class="row g-4">
            <div class="col-12 mt-0">
                <a href="#">
                <div class="ad-banner">
                    <img src="assets/images/banner.png" alt="Advertisement" class="ad-image">
                    </div>
                </a>
        </div>
     </div>
    </div>

     <!-- banner advertisement end --> --}}


       <div class="blog_sidebar">
                        <div class="p-3 p-xl-4 border rounded">
                            <div class="card_header mb-4">
                                <h3>Categories</h3>
                            </div>
                            <div class="categories_list">
                                <ul>
                                    @foreach($category as $data)
                                        <li><a href="{{ route('category.show', $data->slug) }}">{{$data->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="p-3 p-xl-4 border rounded mt-2">
                            <div class="card_header mb-4">
                                <h3>Latest Posts</h3>
                            </div>
                            <div class="latestpost_list">
                                 <ul>
                                    @foreach($latestPost as $data)
                                        <li><a href="{{ route('blog.show', $data->slug) }}">{{$data->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
        </div>
