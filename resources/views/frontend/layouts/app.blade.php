<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="@yield('meta_keywords', 'Global Graphic Giant, IT Solution, Web Development, Image Production')" />
    <meta name="description" content="@yield('meta_description', get_setting('meta_description', 'Global Graphic Giant – A Complete IT Solution'))" />
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="@yield('meta_title', get_setting('meta_title', 'Global Graphic Giant – A Complete IT Solution'))" />
    <meta property="og:description" content="@yield('meta_description', get_setting('meta_description', 'Global Graphic Giant – A Complete IT Solution'))" />
    <meta property="og:image" content="@yield('og_image', get_setting('og_image') ? asset(get_setting('og_image')) : '')" />
    
    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:url" content="{{ url()->current() }}" />
    <meta name="twitter:title" content="@yield('meta_title', get_setting('meta_title', 'Global Graphic Giant – A Complete IT Solution'))" />
    <meta name="twitter:description" content="@yield('meta_description', get_setting('meta_description', 'Global Graphic Giant – A Complete IT Solution'))" />
    <meta name="twitter:image" content="@yield('og_image', get_setting('og_image') ? asset(get_setting('og_image')) : '')" />

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    
    @hasSection('canonical')
        <link rel="canonical" href="@yield('canonical')" />
    @else
        <link rel="canonical" href="{{ url()->current() }}" />
    @endif

    <title>@yield('meta_title', get_setting('meta_title', 'Global Graphic Giant – A Complete IT Solution'))</title>

    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ get_setting('favicon') ? asset(get_setting('favicon')) : asset('frontend/images/favicon.jpg') }}" />

    <!-- bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.min.css') }}" />

    <!-- animate -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.css') }}" />

    <!-- owl-carousel -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/owl.carousel.css') }}">

    <!-- fontawesome -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/font-awesome.css') }}" />

    <!-- themify -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/themify-icons.css') }}" />

    <!-- flaticon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/flaticon.css') }}" />

    <!-- custom -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/custom.css') }}" />

    <!-- REVOLUTION LAYERS STYLES -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/revolution/css/rs6.css') }}">

    <!-- prettyphoto -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/prettyPhoto.css') }}">

    <!-- shortcodes -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/shortcodes.css') }}" />

    <!-- main -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/main.css') }}" />

    <!-- responsive -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/responsive.css') }}" />

</head>

<body>

    <!--page start-->
    <div class="page">

        <!--header start-->
        <header id="masthead" class="header ttm-header-style-01">

            <!-- ttm-header-wrap -->
            <div class="ttm-header-wrap">
                <!-- ttm-stickable-header-w -->
                <div id="ttm-stickable-header-w" class="ttm-stickable-header-w clearfix">
                    <!-- ttm-topbar-wrapper -->
                    <div class="ttm-topbar-wrapper clearfix">
                        <div class="container">
                            <div class="ttm-topbar-content">
                                @php
                                    $mainPhones = json_decode(get_setting('main_phones', '[]'), true);
                                    $mainEmails = json_decode(get_setting('main_emails', '[]'), true);
                                    $socialLinks = json_decode(get_setting('social_links', '[]'), true);
                                    
                                    $topPhone = (is_array($mainPhones) && count($mainPhones) > 0) ? $mainPhones[0]['text'] : '+1 (416) 686-3111';
                                    $topEmail = (is_array($mainEmails) && count($mainEmails) > 0) ? $mainEmails[0]['text'] : 'info@shehala.com';
                                    
                                    if (!function_exists('mapIcon')) {
                                        function mapIcon($icon) {
                                            $map = [
                                                'fab fa-facebook-f' => 'fa fa-facebook',
                                                'fab fa-linkedin-in' => 'fa fa-linkedin',
                                                'fab fa-pinterest-p' => 'fa fa-pinterest',
                                                'fab fa-telegram-plane' => 'fa fa-telegram',
                                                'fab fa-tiktok' => 'fa fa-music',
                                                'fas fa-phone-alt' => 'fa fa-phone',
                                                'fas fa-map-marker-alt' => 'fa fa-map-marker',
                                            ];
                                            return $map[$icon] ?? str_replace(['fas ', 'fab ', 'far '], 'fa ', $icon);
                                        }
                                    }
                                    
                                    if (!function_exists('getSocialName')) {
                                        function getSocialName($icon) {
                                            if (strpos($icon, 'facebook') !== false) return 'Facebook';
                                            if (strpos($icon, 'twitter') !== false) return 'Twitter';
                                            if (strpos($icon, 'linkedin') !== false) return 'LinkedIn';
                                            if (strpos($icon, 'youtube') !== false) return 'YouTube';
                                            if (strpos($icon, 'instagram') !== false) return 'Instagram';
                                            if (strpos($icon, 'whatsapp') !== false) return 'WhatsApp';
                                            if (strpos($icon, 'pinterest') !== false) return 'Pinterest';
                                            return 'Social';
                                        }
                                    }
                                @endphp
                                <ul class="top-contact text-left">
                                    <li><i class="fa fa-phone"></i>{{ $topPhone }} </li>
                                    <li><i class="fa fa-envelope-o"></i><a href="mailto:{{ $topEmail }}">{{ $topEmail }}</a></li>
                                </ul>
                                <div class="topbar-right text-right">
                                    <ul class="top-contact">
                                        <li><i class="fa fa-clock-o"></i>Office Hour: {{ get_setting('office_hours', '24/6') }}</li>
                                    </ul>
                                    <div class="ttm-social-links-wrapper list-inline">
                                        <ul class="social-icons">
                                            @if(is_array($socialLinks) && count($socialLinks) > 0)
                                                @foreach($socialLinks as $social)
                                                <li><a href="{{ $social['text'] }}" class=" tooltip-bottom" data-tooltip="{{ $social['name'] ?? getSocialName($social['icon']) }}"><i class="{{ mapIcon($social['icon']) }}"></i></a></li>
                                                @endforeach
                                            @else
                                                <li><a href="#" class=" tooltip-bottom"><i class="fa fa-facebook"></i></a></li>
                                                <li><a href="#" class=" tooltip-bottom"><i class="fa fa-twitter"></i></a></li>
                                                <li><a href="#" class=" tooltip-bottom"><i class="fa fa-youtube"></i></a></li>
                                                <li><a href="#" class=" tooltip-bottom"><i class="fa fa-linkedin"></i></a></li>
                                            @endif
                                        </ul>
                                    </div>
                                    <div class="header-btn">
                                        <a class="ttm-btn ttm-btn-size-md ttm-btn-bgcolor-skincolor" href="{{ url('contact-us') }}">Request a Quote</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ttm-topbar-wrapper end -->
                    <div id="site-header-menu" class="site-header-menu">
                        <div class="site-header-menu-inner ttm-stickable-header">
                            <div class="container">
                                <!-- site-branding -->
                                <div class="site-branding">
                                    <a class="home-link" href="{{ url('/') }}" title="{{ get_setting('site_title', 'Global Graphic Giant') }}" rel="home">
                                        <img id="logo-img" class="img-center" src="{{ get_setting('logo') ? asset(get_setting('logo')) : asset('frontend/images/shehalaitlimited.png') }}" alt="{{ get_setting('site_title', 'Global Graphic Giant') }} Logo">
                                    </a>
                                </div>
                                <!-- site-branding end -->
                                <!--site-navigation -->
                                <div id="site-navigation" class="site-navigation">
                                    <div class="ttm-rt-contact">
                                        <!-- header-icons -->
                                        <div class="ttm-header-icons ">

                                        </div>
                                        <!-- header-icons end -->
                                    </div>

                                    <div class="ttm-menu-toggle">
                                        <input type="checkbox" id="menu-toggle-form" />
                                        <label for="menu-toggle-form" class="ttm-menu-toggle-block">
                                            <span class="toggle-block toggle-blocks-1"></span>
                                            <span class="toggle-block toggle-blocks-2"></span>
                                            <span class="toggle-block toggle-blocks-3"></span>
                                        </label>
                                    </div>
                                    <nav id="menu" class="menu">
                                        <ul class="dropdown">
                                            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a> </li>
                                            <li class="{{ request()->is('about-us') ? 'active' : '' }}"><a href="{{ url('about-us') }}">About Us</a></li>
                                            
                                            <li class="{{ request()->is('service/*') ? 'active' : '' }}"><a href="#">Services</a>
                                                @if(isset($globalServiceCategories) && $globalServiceCategories->isNotEmpty())
                                                    <ul>
                                                        @foreach($globalServiceCategories as $category)
                                                            <li><a href="#">{{ $category->name }}</a>
                                                                @if($category->children->isNotEmpty() || $category->services->isNotEmpty())
                                                                    <ul>
                                                                        @foreach($category->children as $child)
                                                                            <li><a href="#">{{ $child->name }}</a>
                                                                                @if($child->services->isNotEmpty())
                                                                                    <ul>
                                                                                        @foreach($child->services as $service)
                                                                                            <li class="{{ request()->is('service/' . $service->slug) ? 'active' : '' }}">
                                                                                                <a href="{{ route('service.details', $service->slug) }}">{{ $service->title }}</a>
                                                                                            </li>
                                                                                        @endforeach
                                                                                    </ul>
                                                                                @endif
                                                                            </li>
                                                                        @endforeach

                                                                        @foreach($category->services as $service)
                                                                            <li class="{{ request()->is('service/' . $service->slug) ? 'active' : '' }}">
                                                                                <a href="{{ route('service.details', $service->slug) }}">{{ $service->title }}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                            
                                            <li class="{{ request()->is('portfolio') ? 'active' : '' }}"><a href="{{ url('portfolio') }}">Portfolio</a> </li>
                                            <li class="{{ request()->is('blog*') ? 'active' : '' }}"><a href="{{ url('blog') }}">Blog</a></li>
                                            <li class="{{ request()->is('contact-us') ? 'active' : '' }}"><a href="{{ url('contact-us') }}">Contact Us</a></li>
                                        </ul>
                                    </nav>
                                </div>
                                <!-- site-navigation end-->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ttm-stickable-header-w end-->
            </div>
            <!--ttm-header-wrap end -->

        </header>
        <!--header end-->

        @yield('content')

        <footer class="footer widget-footer clearfix">
            <div class="first-footer ttm-bgcolor-skincolor ttm-bg ttm-bgimage-yes bg-img1">
                <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
                <div class="container">
                    <div class="row align-items-md-center">
                        <div class="col-lg-4 col-md-4 col-sm-12 order-md-2">
                            <div class="footer-logo text-sm-center">
                                <img src="{{ get_setting('logo') ? asset(get_setting('logo')) : asset('frontend/images/shehalaitlimited.png') }}" alt="{{ get_setting('site_title', 'Global Graphic Giant') }}" style="max-height:60px;">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 order-md-1">
                            <div class="text-left">
                                <!--  featured-icon-box -->
                                <div class="featured-icon-box left-icon icon-align-top">
                                    <div class="featured-icon">
                                        <!--  featured-icon -->
                                        <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-md">
                                            <i class="ti ti-location-pin"></i>
                                            <!--  ttm-icon -->
                                        </div>
                                    </div>
                                    <div class="featured-content">
                                        <!--  featured-content -->
                                        <div class="featured-desc">
                                            <p>
                                                @if(isset($globalCorporateOffice) && is_array($globalCorporateOffice->addresses) && count($globalCorporateOffice->addresses) > 0)
                                                    {{ is_array($globalCorporateOffice->addresses[0]) ? $globalCorporateOffice->addresses[0]['text'] : $globalCorporateOffice->addresses[0] }}
                                                @else
                                                    Ikramul Vila, 827/1, East Shewrapara [2nd Floor], Kafrul, Mirpur, Dhaka- 1216, Bangladesh.
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!--  featured-icon-box END -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 order-md-3">
                            <div class="text-sm-right">
                                <a class="ttm-btn ttm-btn-size-md ttm-btn-style-border ttm-icon-btn-left ttm-btn-color-white" href="mailto:{{ $topEmail }}" title="">  {{ $topEmail }}  <i class="fa fa-envelope-o"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="second-footer ttm-textcolor-white bg-img2">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 widget-area">
                            <div class="widget widget_text  clearfix">
                                <h3 class="widget-title">About Our Company</h3>
                                <div class="textwidget widget-text">
                                    {{ get_setting('company_short_description', 'Global Graphic Giant is one of the fastest growing and forward thinking ITES solution companies in Bangladesh, delivering outstanding software outsourcing services to clients in EU (Germany, France, Italy, UK, Spain), North America and Japan since 2006.') }}
                                </div>
                                <div class="quicklink-box">
                                    <!--  featured-icon-box -->
                                    <div class="featured-icon-box left-icon">
                                        <div class="featured-icon">
                                            <!--  featured-icon -->
                                            <div class="ttm-icon ttm-icon_element-style-round ttm-icon_element-bgcolor-skincolor ttm-icon_element-size-md ttm-icon_element-style-round">
                                                <span class="flaticon flaticon-clock"></span>
                                                <!--  ttm-icon -->
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <!--  featured-content -->
                                            <div class="featured-desc">
                                                <!--  featured-desc -->
                                                <p>Talk To Our Support</p>
                                            </div>
                                            <div class="featured-title">
                                                <!--  featured-title -->
                                                <h5>
                                                    @if(is_array($mainPhones) && count($mainPhones) > 0)
                                                        {{ implode(', ', array_column($mainPhones, 'text')) }}
                                                    @else
                                                        +1 (416) 686-3111
                                                    @endif
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <!--  featured-icon-box END -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3 widget-area">
                            <div class="widget link-widget clearfix">
                                <h3 class="widget-title">Quick Links</h3>

                                <ul id="menu-footer-services">
                                    <li><a href="{{ url('about-us') }}">Why Global Graphic Giant?</a></li>
                                    <li><a href="{{ url('about-us') }}">About Us</a></li>
                                    <li><a href="{{ url('portfolio') }}">Portfolio</a></li>
                                    <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 widget-area">
                            <div class="widget flicker_widget clearfix">
                                <h3 class="widget-title">Contact Information</h3>
                                <div class="row">
                                    @if(isset($globalContactInfos) && $globalContactInfos->isNotEmpty())
                                        @foreach($globalContactInfos->chunk(ceil($globalContactInfos->count() / 2)) as $chunk)
                                            <div class="col-lg-6">
                                                @foreach($chunk as $info)
                                                    <h6>{{ $info->office_name }}</h6>
                                                    <p>
                                                        @if(is_array($info->addresses))
                                                            @foreach($info->addresses as $address)
                                                                {{ $address['text'] ?? $address }}<br/>
                                                            @endforeach
                                                        @endif
                                                        @if(is_array($info->phones))
                                                            @foreach($info->phones as $phone)
                                                                <i class="{{ mapIcon(is_array($phone) ? ($phone['icon'] ?? 'fas fa-phone') : 'fas fa-phone') }}"></i> {{ is_array($phone) ? ($phone['text'] ?? '') : $phone }}<br/>
                                                            @endforeach
                                                        @endif
                                                        @if(is_array($info->emails))
                                                            @foreach($info->emails as $email)
                                                                <i class="{{ mapIcon(is_array($email) ? ($email['icon'] ?? 'fas fa-envelope') : 'fas fa-envelope') }}"></i> <a href="mailto:{{ is_array($email) ? ($email['text'] ?? '') : $email }}"> {{ is_array($email) ? ($email['text'] ?? '') : $email }} </a><br/>
                                                            @endforeach
                                                        @endif
                                                    </p><br/>
                                                @endforeach
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="textwidget widget-text">


                                    <h5 class="mb-20">Follow Us On</h5>
                                    <div class="social-icons circle social-hover">
                                        <ul class="list-inline">
                                            @if(is_array($socialLinks) && count($socialLinks) > 0)
                                                @foreach($socialLinks as $social)
                                                @php $sName = $social['name'] ?? getSocialName($social['icon']); @endphp
                                                <li class="social-{{ strtolower($sName) }}"><a class="tooltip-top" target="_blank" href="{{ $social['text'] }}" data-tooltip="{{ $sName }}"><i class="{{ mapIcon($social['icon']) }}" aria-hidden="true"></i></a></li>
                                                @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-footer-text ttm-bgcolor-darkgrey ttm-textcolor-white">
                <div class="container">
                    <div class="row copyright">
                        <div class="col-md-6">
                            <div class="">
                                <span>Copyright &copy; {{ date('Y') }}&nbsp;{{ get_setting('site_title', 'Global Graphic Giant') }} - All right reserved.</span>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-md-right res-767-mt-10">
                                <div class="d-lg-inline-flex">
                                    <ul id="menu-footer-menu" class="footer-nav-menu">
                                        <li><a href="{{ url('about-us') }}">About Us</a></li>
                                        <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
                                        <li><a href="{{ url('contact-us') }}">Privacy</a></li>
                                    </ul>
                                    <div class="float-md-right ml-20 res-767-ml-0">
                                        <img src="{{ asset('frontend/images/footer-payment-img.png') }}" alt="payment-img">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--footer end-->

        <!--back-to-top start-->
        <a id="totop" href="#top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!--back-to-top end-->

    </div>
    <!-- page end -->

    <!-- Javascript -->

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/tether.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.easing.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-waypoints.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-validate.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('frontend/js/numinate.min6959.js') }}"></script>
    <script src="{{ asset('frontend/js/lazysizes.min.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <!-- Revolution Slider -->
    <script src="{{ asset('frontend/revolution/js/revolution.tools.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/rs6.min.js') }}"></script>
    <script src="{{ asset('frontend/revolution/js/slider.js') }}"></script>

    <!-- Javascript end-->

</body>

</html>