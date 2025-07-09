    <!-- ======================= Footer Start  ========================== -->
    <footer class="footer-section">
        <div class="newsletter-section">
            <div class="container">
                <div class="newsletter-wrapper d-md-flex justify-content-between align-items-center">
                    <div class="newsletter-title mb-3 mb-md-0 me-md-4">
                        <div class="section_heading">
                            <h2 class="section_title text-white">Newsletter Subscription</h2>
                            <p class="sub_title text-white text-sm">Subscribe us to get latest news of promotional trip
                            </p>
                        </div>
                    </div>
                    <div class="newsletter-form">
                        @if(session('success'))
                            <div class="alert alert-success mt-2 mb-2">
                            {{ session('success') }}
                            </div>
                        @endif
                        <form action="{{ route('newsletter.subscribe') }}" method="post">
                            @csrf
                            <div class="input-group">
                                <input name="email" type="email" class="form-control shadow-none"
                                    placeholder="Enter your email address" required="">
                                <button type="submit" class="input-group-text bg-primary border-primary text-white">
                                    Subscribe
                                    <img src="{{asset('assets/images/icons/subscribe.svg')}}" alt="Subscribe">
                                </button>
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
            </div>
        </div>
        <div class="container">
            <div class="footer__top pt-5 pb-5">
                <div class="footer-wrapper">
                    <div class="row gy-4 gy-lg-0">
                        <div class="col-lg-5">
                            <div class="footer_widget">
                                <div class="widget_heading mb-4 text-white">
                                    <h3>Contact Info</h3>
                                </div>
                                <div class="mb-4">
                                    <div class="site_info d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <img src="{{asset('assets/images/icons/phone.svg')}}" alt="For Support">
                                        </div>
                                        <div>
                                            <h5>For Support</h5>
                                            <h6><a href="tel:{{getSiteSettings()->phone}}">{{getSiteSettings()->phone}}</a></h6>
                                        </div>
                                    </div>
                                    <div class="site_info d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <img src="{{asset('assets/images/icons/email.svg')}}" alt="Send Us Email">
                                        </div>
                                        <div>
                                            <h5>Send Us Email</h5>
                                            <h6><a
                                                    href="mailto:{{getSiteSettings()->email}}">{{getSiteSettings()->email}}</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                                <ul class="social-icons">
                                    <li>
                                        <a href="{{getSiteSettings()->facebook}}" title="facebook" target="_blank">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{getSiteSettings()->instagram}}" title="instagram" target="_blank">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{getSiteSettings()->twitter}}" title="twitter" target="_blank">
                                            <i class="fab fa-x-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{getSiteSettings()->youtube}}" title="youtube" target="_blank">
                                            <i class="fab fa-youtube"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="footer_widget">
                                <div class="widget_heading mb-4 text-white">
                                    <h3>General Links</h3>
                                </div>
                                <div class="links">
                                    <ul>
                                        <li><a href="{{route('blogs.index')}}">Blog</a></li>
                                        <li><a href="{{route('privacy.index')}}">Privacy Policy</a></li>
                                        <li><a href="{{route('terms.index')}}">Terms Conditions</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-3">
                            <div class="footer_widget latest_post">
                                <div class="widget_heading mb-4 text-white">
                                    <h3>Latest Post</h3>
                                </div>
                                <div class="links">
                                <ul>
                                    @foreach($latestPost as $data)
                                        <li><a href="{{ route('blog.show', $data->slug) }}">{{$data->title}}</a></li>
                                    @endforeach
                                </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__bottom py-3 text-center">
            Copyright © 2024 All Rights Reserved
        </div>
    </footer>
    <!-- ======================= Footer End  ============================ -->
