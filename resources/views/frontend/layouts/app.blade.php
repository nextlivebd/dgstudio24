<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="Global Graphic Giant, IT Solution, Web Development, Image Production" />
    <meta name="description" content="{{ get_setting('meta_description', 'Global Graphic Giant – A Complete IT Solution') }}" />
    <meta property="og:image" content="{{ get_setting('og_image') ? asset(get_setting('og_image')) : '' }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>{{ get_setting('meta_title', 'Global Graphic Giant – A Complete IT Solution') }}</title>

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
                                <ul class="top-contact text-left">
                                    <li><i class="fa fa-phone"></i>+8801712528945, +8801612528945</li>
                                    <li><i class="fa fa-envelope-o"></i><a href="mailto:contact@ggg24.design">contact@ggg24.design </a></li>
                                </ul>
                                <div class="topbar-right text-right">
                                    <ul class="top-contact">
                                        <li><i class="fa fa-clock-o"></i>Office Hour: 24/6</li>
                                    </ul>
                                    <div class="ttm-social-links-wrapper list-inline">
                                        <ul class="social-icons">
                                            <li><a href="https://www.facebook.com/Shehala.IT.Limited" class=" tooltip-bottom" data-tooltip="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
                                            </li>
                                            <li><a href="https://twitter.com/ShehalaItLtd" class=" tooltip-bottom" data-tooltip="Twitter" target="_blank"><i class="fa fa-twitter"></i></a>
                                            </li>
                                            <li><a href="https://www.youtube.com/user/ShehalaIt" class=" tooltip-bottom" data-tooltip="Youtube" target="_blank"><i class="fa fa-youtube"></i></a>
                                            </li>
                                            <li><a href="https://bd.linkedin.com/in/shehala" class=" tooltip-bottom" data-tooltip="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a>
                                            </li>
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
                                            @php
                                                $services = ['web-application-development', 'digital-catalog-system', 'cms-banner-system', 'content-management-system', 'website-maintenance', 'banner-order-system', 'responsive-web-design', 'logo-design', 'psdto-html5', 'psd-design', 'wordpress-woocommerce', 'joomla-virtueMart', 'magento-ecommerce', 'opencart-ecommerce', 'paypal-integration', 'DIBS-integration', 'local-payment-getway-integration', 'wordpress-plugin-development', 'joomla-module-development', 'joomla-plugin-development', 'joomla-component-development', 'banner-design', 'html5-banner-development', 'cms-banner-development', 'flash-banner-development', 'gif-banner-development', 'static-banner-development', '3D-production', '3d-model', 'ar-model-visualization', 'clipping-path', 'multi-layer-clipping-element-masking', 'image-manipulation', 'background-removal', 'shadows', 'vectorizing-raster-to-vector-conversion', 'newspaper-advertisement', 'magazine-design-language-conversion'];
                                            @endphp
                                            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a> </li>
                                            <li class="{{ request()->is('about-us') ? 'active' : '' }}"><a href="{{ url('about-us') }}">About Us</a></li>
                                            <li class="{{ in_array(request()->path(), $services) ? 'active' : '' }}"><a href="#">Services</a>
                                                <ul>
                                                    <li><a href="#">Web Development</a>
                                                        <ul>
                                                            <li class="{{ request()->is('web-application-development') ? 'active' : '' }}"><a href="{{ url('web-application-development') }}">Web Application</a></li>
                                                            <li class="{{ request()->is('digital-catalog-system') ? 'active' : '' }}"><a href="{{ url('digital-catalog-system') }}">Digital Catalog System</a></li>
                                                            <li class="{{ request()->is('cms-banner-system') ? 'active' : '' }}"><a href="{{ url('cms-banner-system') }}">CMS Banner System</a></li>
                                                            <li class="{{ request()->is('content-management-system') ? 'active' : '' }}"><a href="{{ url('content-management-system') }}">Content Management System</a></li>
                                                            <li class="{{ request()->is('website-maintenance') ? 'active' : '' }}"><a href="{{ url('website-maintenance') }}">Website Maintenance</a></li>
                                                            <li class="{{ request()->is('banner-order-system') ? 'active' : '' }}"><a href="{{ url('banner-order-system') }}">Banner Order System</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Website Design</a>
                                                        <ul>
                                                            <li class="{{ request()->is('responsive-web-design') ? 'active' : '' }}"><a href="{{ url('responsive-web-design') }}">Responsive Web Design</a></li>
                                                            <li class="{{ request()->is('logo-design') ? 'active' : '' }}"><a href="{{ url('logo-design') }}">Logo Design</a></li>
                                                            <li class="{{ request()->is('psdto-html5') ? 'active' : '' }}"><a href="{{ url('psdto-html5') }}">PSD to XHTML/CSS3</a></li>
                                                            <li class="{{ request()->is('psd-design') ? 'active' : '' }}"><a href="{{ url('psd-design') }}">PSD Design</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Ecommerce Development</a>
                                                        <ul>
                                                            <li class="{{ request()->is('wordpress-woocommerce') ? 'active' : '' }}"><a href="{{ url('wordpress-woocommerce') }}">WordPress WooCommerce</a></li>
                                                            <li class="{{ request()->is('joomla-virtueMart') ? 'active' : '' }}"><a href="{{ url('joomla-virtueMart') }}">Joomla VirtueMart</a></li>
                                                            <li class="{{ request()->is('magento-ecommerce') ? 'active' : '' }}"><a href="{{ url('magento-ecommerce') }}">Magento Ecommerce</a></li>
                                                            <li class="{{ request()->is('opencart-ecommerce') ? 'active' : '' }}"><a href="{{ url('opencart-ecommerce') }}">Opencart Ecommerce</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Payment Gateway Solutions</a>
                                                        <ul>
                                                            <li class="{{ request()->is('paypal-integration') ? 'active' : '' }}"><a href="{{ url('paypal-integration') }}">Paypal Integration</a></li>
                                                            <li class="{{ request()->is('DIBS-integration') ? 'active' : '' }}"><a href="{{ url('DIBS-integration') }}">DIBS Integration</a></li>
                                                            <li class="{{ request()->is('local-payment-getway-integration') ? 'active' : '' }}"><a href="{{ url('local-payment-getway-integration') }}">Local Payment Gateway</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">CMS Extensions</a>
                                                        <ul>
                                                            <li class="{{ request()->is('wordpress-plugin-development') ? 'active' : '' }}"><a href="{{ url('wordpress-plugin-development') }}">WordPress Plugin</a></li>
                                                            <li class="{{ request()->is('joomla-module-development') ? 'active' : '' }}"><a href="{{ url('joomla-module-development') }}">Joomla Module</a></li>
                                                            <li class="{{ request()->is('joomla-plugin-development') ? 'active' : '' }}"><a href="{{ url('joomla-plugin-development') }}">Joomla Plugin</a></li>
                                                            <li class="{{ request()->is('joomla-component-development') ? 'active' : '' }}"><a href="{{ url('joomla-component-development') }}">Joomla Component</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Banner Production</a>
                                                        <ul>
                                                            <li class="{{ request()->is('banner-design') ? 'active' : '' }}"><a href="{{ url('banner-design') }}">Banner Design</a></li>
                                                            <li class="{{ request()->is('html5-banner-development') ? 'active' : '' }}"><a href="{{ url('html5-banner-development') }}">HTML5 Banner</a></li>
                                                            <li class="{{ request()->is('cms-banner-development') ? 'active' : '' }}"><a href="{{ url('cms-banner-development') }}">CMS Banner</a></li>
                                                            <li class="{{ request()->is('flash-banner-development') ? 'active' : '' }}"><a href="{{ url('flash-banner-development') }}">Flash Banner</a></li>
                                                            <li class="{{ request()->is('gif-banner-development') ? 'active' : '' }}"><a href="{{ url('gif-banner-development') }}">GIF Banner</a></li>
                                                            <li class="{{ request()->is('static-banner-development') ? 'active' : '' }}"><a href="{{ url('static-banner-development') }}">Static Banner</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="{{ url('3D-production') }}">3D Production</a>
                                                        <ul>
                                                            <li class="{{ request()->is('3d-model') ? 'active' : '' }}"><a href="{{ url('3d-model') }}">3D Model</a></li>
                                                            <li class="{{ request()->is('ar-model-visualization') ? 'active' : '' }}"><a href="{{ url('ar-model-visualization') }}">3D & AR/VR Model</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Image Production</a>
                                                        <ul>
                                                            <li class="{{ request()->is('clipping-path') ? 'active' : '' }}"><a href="{{ url('clipping-path') }}">Clipping Path</a></li>
                                                            <li class="{{ request()->is('multi-layer-clipping-element-masking') ? 'active' : '' }}"><a href="{{ url('multi-layer-clipping-element-masking') }}">Element Masking</a></li>
                                                            <li class="{{ request()->is('image-manipulation') ? 'active' : '' }}"><a href="{{ url('image-manipulation') }}">Image Manipulation</a></li>
                                                            <li class="{{ request()->is('background-removal') ? 'active' : '' }}"><a href="{{ url('background-removal') }}">Background Removal</a></li>
                                                            <li class="{{ request()->is('shadows') ? 'active' : '' }}"><a href="{{ url('shadows') }}">Shadows</a></li>
                                                            <li class="{{ request()->is('vectorizing-raster-to-vector-conversion') ? 'active' : '' }}"><a href="{{ url('vectorizing-raster-to-vector-conversion') }}">Vectorizing</a></li>
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">Page Production</a>
                                                        <ul>
                                                            <li class="{{ request()->is('newspaper-advertisement') ? 'active' : '' }}"><a href="{{ url('newspaper-advertisement') }}">Newspaper Advertisement</a></li>
                                                            <li class="{{ request()->is('magazine-design-language-conversion') ? 'active' : '' }}"><a href="{{ url('magazine-design-language-conversion') }}">Magazine Design</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="{{ request()->is('portfolio') ? 'active' : '' }}"><a href="{{ url('portfolio') }}">Portfolio</a> </li>
                                            <li class="{{ request()->is('blog') ? 'active' : '' }}"><a href="{{ url('blog') }}">Our clients</a></li>
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
                                            <p>Ikramul Vila, 827/1, East Shewrapara [2nd Floor], Kafrul, Mirpur, Dhaka- 1216, Bangladesh.</p>
                                        </div>
                                    </div>
                                </div>
                                <!--  featured-icon-box END -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 order-md-3">
                            <div class="text-sm-right">
                                <a class="ttm-btn ttm-btn-size-md ttm-btn-style-border ttm-icon-btn-left ttm-btn-color-white" href="mailto:contact@ggg24.design" title="">  contact@ggg24.design  <i class="fa fa-envelope-o"></i></a>
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
Global Graphic Giant is one of the fastest growing and forward thinking ITES solution companies in Bangladesh, delivering outstanding software outsourcing services to clients in EU (Germany, France, Italy, UK, Spain), North America and Japan since 2006.                                </div>
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
                                                <h5>+8801712528945, +8801612528945</h5>
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
                                    <div class="col-lg-6">

                                        <h6>Dhaka Office</h6>
                                        <p>Ikramul Vila,<br>
                                            827/1,
                                            East Shewrapara [2nd Floor],
                                            Kafrul, Mirpur, Dhaka- 1216, Bangladesh.
                                            <br/>

                                            <i class="fa fa-phone"></i> +8801712528945, +8801612528945<br/>
                                            <i class="fa fa-envelope-o"></i><a href="mailto:contact@ggg24.design">  contact@ggg24.design </a>
                                        </p><br/>

                                        <h6>Danish Office</h6>
                                        <p>Højvangsvej 41 2600 Glostrup Denmark<br/>
                                            <i class="fa fa-phone"></i> +45 89 87 06 63<br/>
                                            <i class="fa fa-envelope-o"></i><a href="mailto:contact@ggg24.design">  contact@ggg24.design </a>

                                        </p>

                                    </div>
                                    <div class="col-lg-6">
                                        <h6> Canada Office</h6>
                                        <p>7 Chatterson Street, Whitby, Ontario, Canada, L1R 0B1<br/>
                                            <i class="fa fa-phone"></i> +1 (416) 686-3111<br/>
                                            <i class="fa fa-phone"></i> +1 (888) 340-9240 ( Toll free )<br/>
                                            <i class="fa fa-envelope-o"></i><a href="mailto:contact@ggg24.design"> contact@ggg24.design</a>

                                        </p><br/>

                                        <h6>U.S.A Office</h6>
                                        <p>410 Mercedes Street Benbrook TX-76126 U.S.A <br/>
                                            <i class="fa fa-phone"></i> +1 (817) 249-9595<br/>
                                            <i class="fa fa-envelope-o"></i><a href="mailto:contact@ggg24.design"> contact@ggg24.design</a>
                                        </p>
                                    </div>
                                </div>

                                <div class="textwidget widget-text">


                                    <h5 class="mb-20">Follow Us On</h5>
                                    <div class="social-icons circle social-hover">
                                        <ul class="list-inline">
                                            <li class="social-facebook"><a class="tooltip-top" target="_blank" href="https://www.facebook.com/Shehala.IT.Limited" data-tooltip="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                            <li class="social-twitter"><a class="tooltip-top" target="_blank" href="https://twitter.com/ShehalaItLtd" data-tooltip="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                            <li class="social-flickr"><a class=" tooltip-top" target="_blank" href="#" data-tooltip="flickr"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>
                                            <li class="social-linkedin"><a class=" tooltip-top" target="_blank" href="https://bd.linkedin.com/in/shehala"
                                                    data-tooltip="LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
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
                                <span>Copyright &copy; {{ date('Y') }}&nbsp;Global Graphic Giant - All right reserved.</span>

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