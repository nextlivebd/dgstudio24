@extends('frontend.layouts.app')

@section('content')

        <!--header end-->

        <!-- START homeclassicmain REVOLUTION SLIDER 6.0.1 -->

        <div class="home-slider">


            <rs-module-wrap id="rev_slider_1_1_wrapper" data-source="gallery">
                <rs-module id="rev_slider_1_1" style="" data-version="6.0.1" class="rev_slider_1_1_height">
                    <rs-slides>
                        @foreach($sliders as $key => $slider)
                        <rs-slide data-key="rs-{{ $key + 3 }}" data-title="Slide" data-thumb="{{ Str::startsWith($slider->background_image, 'frontend/') ? asset($slider->background_image) : asset('storage/' . $slider->background_image) }}" data-anim="ei:d;eo:d;s:1000;r:0;t:fade;sl:0;">
                            <img src="{{ Str::startsWith($slider->background_image, 'frontend/') ? asset($slider->background_image) : asset('storage/' . $slider->background_image) }}" title="slider-bg-{{ $slider->id }}" width="1920" height="790" class="rev-slidebg" data-no-retina>
                            
                            @if($slider->subtitle)
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-0" data-type="text" data-color="#2d4a8a" data-rsp_ch="on" data-xy="xo:50px,50px,40px,-164px;yo:326px,196px,94px,61px;" data-text="w:normal;s:18,18,15,10;l:25,25,15,9;fw:600;" data-vbility="t,t,t,f" data-frame_0="x:-50,-50,-31,-19;"
                                data-frame_1="e:Linear.easeNone;st:120;sp:400;sR:120;" data-frame_999="o:0;st:w;sR:8480;">{{ $slider->subtitle }}
                            </rs-layer>
                            @endif
                            
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-1" class="ttm-bgcolor-skincolor" data-type="shape" data-rsp_ch="on" data-xy="xo:274px,274px,-119px,-73px;yo:339px,209px,136px,83px;" data-text="w:normal;s:20,20,12,7;l:0,0,15,9;" data-dim="w:36px,36px,22px,13px;h:2px,2px,1px,1px;"
                                data-vbility="t,t,f,f" data-frame_0="x:50,50,31,19;" data-frame_1="e:Linear.easeNone;st:190;sp:200;sR:190;" data-frame_999="o:0;st:w;sR:8610;">
                            </rs-layer>

                            @if($slider->button_1_text)
                            <a id="slider-2-slide-{{ $key + 1 }}-layer-2" class="rs-layer ttm-btn ttm-btn-size-md ttm-btn-style-border ttm-btn-color-darkgrey contactus-btn3" href="{{ url($slider->button_1_link) }}" target="_self" rel="nofollow" data-type="text" data-rsp_ch="on" data-xy="x:l,l,l,c;xo:279px,279px,210px,0;yo:609px,468px,310px,233px;"
                                data-text="w:normal;s:15,15,12,11;l:29,29,25,30;fw:600;a:center;" data-border="bos:solid;boc:#263045;bow:1px,1px,1px,1px;" data-padding="t:12,12,8,5;r:35,35,22,14;b:15,15,9,6;l:35,35,22,14;" data-frame_0="y:50,50,31,19;" data-frame_1="st:760;sp:500;sR:760;"
                                data-frame_999="o:0;st:w;sR:7740;">{{ $slider->button_1_text }}
                            </a>
                            @endif

                            @if($slider->title_1)
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-3" data-type="text" data-color="#263045" data-rsp_ch="on" data-xy="x:l,l,l,c;xo:50px,50px,40px,0;yo:363px,233px,124px,59px;" data-text="w:normal;s:62,52,45,37;l:70,60,50,60;fw:600;" data-frame_0="x:-50,-50,-31,-19;"
                                data-frame_1="e:Linear.easeNone;st:260;sp:800;sR:260;" data-frame_999="o:0;st:w;sR:7940;">{!! $slider->title_1 !!}
                            </rs-layer>
                            @endif

                            @if($slider->title_2)
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-4" data-type="text" data-color="#263045" data-rsp_ch="on" data-xy="x:l,l,l,c;xo:50px,50px,40px,0;yo:436px,294px,173px,104px;" data-text="w:normal;s:62,52,45,37;l:75,65,60,60;fw:600;" data-frame_0="x:-50,-50,-31,-19;"
                                data-frame_1="st:410;sp:800;sR:410;" data-frame_999="o:0;st:w;sR:7790;">{!! $slider->title_2 !!}
                            </rs-layer>
                            @endif

                            @if($slider->button_2_text)
                            <a id="slider-2-slide-{{ $key + 1 }}-layer-5" class="rs-layer ttm-btn ttm-btn-size-md ttm-btn-bgcolor-skincolor details-btn" href="{{ url($slider->button_2_link) }}" target="_self" rel="nofollow" data-type="text" data-rsp_ch="on" data-xy="x:l,l,l,c;xo:50px,50px,40px,0;yo:608px,468px,309px,180px;"
                                data-text="w:normal;s:15,15,12,11;l:27,27,25,30;fw:600;a:center;" data-padding="t:12,12,8,5;r:35,35,22,14;b:15,15,9,6;l:35,35,22,14;" data-frame_0="y:50,50,31,19;" data-frame_1="st:720;sp:500;sR:720;" data-frame_999="o:0;st:w;sR:7780;">{{ $slider->button_2_text }} 
                            </a>
                            @endif

                            @if($slider->front_image)
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-6" data-type="image" data-rsp_ch="on" data-xy="x:r;xo:-70px,-70px,-123px,-267px;yo:220px,90px,66px,36px;" data-text="w:normal;s:20,20,12,7;l:0,0,15,9;" data-dim="w:578px,478px,362px,223px;h:564px,464px,353px,217px;"
                                data-vbility="t,t,t,f" data-frame_0="sX:0.9;sY:0.9;" data-frame_1="e:Linear.easeNone;st:100;sp:400;sR:100;" data-frame_999="o:0;st:w;sR:8500;"><img src="{{ Str::startsWith($slider->front_image, 'frontend/') ? asset($slider->front_image) : asset('storage/' . $slider->front_image) }}" alt="front-image-{{ $slider->id }}" width="578" height="564" data-no-retina>
                            </rs-layer>
                            @endif

                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-7" class="grey-bg-shape" data-type="shape" data-rsp_ch="on" data-xy="x:r;xo:-7px,-7px,-192px,-118px;yo:369px,239px,123px,75px;" data-text="w:normal;s:20,20,12,7;l:0,0,15,9;" data-dim="w:30px,30px,18px,11px;h:30px,30px,18px,11px;"
                                data-vbility="t,t,f,f" data-border="bor:50px,50px,50px,50px;" data-frame_0="x:right;" data-frame_1="st:140;sp:1000;sR:140;" data-frame_999="o:1;st:w;sp:1200;sR:7860;" data-frame_999_chars="e:Power4.easeInOut;d:10;x:-105%;o:0;rZ:-90deg;"
                                data-frame_999_mask="u:t;">
                            </rs-layer>

                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-8" class="ttm-bgcolor-darkgrey" data-type="shape" data-rsp_ch="on" data-xy="x:r;xo:65px,65px,-165px,-101px;yo:670px,540px,301px,185px;" data-text="w:normal;s:20,20,12,7;l:0,0,15,9;" data-dim="w:26px,26px,15px,9px;h:26px,26px,15px,9px;"
                                data-vbility="t,t,f,f" data-border="bor:50px,50px,50px,50px;" data-frame_0="y:bottom;" data-frame_1="st:200;sp:1000;sR:200;" data-frame_999="o:1;st:w;sp:1200;sR:7800;" data-frame_999_chars="e:Power4.easeInOut;d:10;x:-105%;o:0;rZ:-90deg;"
                                data-frame_999_mask="u:t;">
                            </rs-layer>
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-9" class="ttm-bgcolor-skincolor" data-type="shape" data-rsp_ch="on" data-xy="x:r;xo:374px,374px,-205px,-126px;yo:267px,137px,88px,54px;" data-text="w:normal;s:20,20,12,7;l:0,0,15,9;" data-dim="w:40px,40px,25px,15px;h:40px,40px,25px,15px;"
                                data-vbility="t,t,f,f" data-border="bor:50px,50px,50px,50px;" data-frame_0="y:top;" data-frame_1="st:240;sp:1000;sR:240;" data-frame_999="o:1;st:w;sp:1200;sR:7760;" data-frame_999_chars="e:Power4.easeInOut;d:10;x:-105%;o:0;rZ:-90deg;"
                                data-frame_999_mask="u:t;">
                            </rs-layer>
                            
                            @if($slider->description)
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-10" data-type="text" data-color="#40444e" data-rsp_ch="on" data-xy="x:l,l,l,c;xo:50px,50px,40px,-409px;yo:519px,380px,237px,132px;" data-text="w:normal;s:16,16,12,7;l:27,27,23,14;fw:400,400,500,500;" data-vbility="t,t,t,f"
                                data-frame_0="y:50,50,31,19;" data-frame_1="e:Linear.easeNone;st:630;sp:500;sR:630;" data-frame_999="o:0;st:w;sR:7870;">{!! $slider->description !!}
                            </rs-layer>
                            @endif
                            
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-11" class="ttm-bgcolor-skincolor slider-client" data-type="shape" data-rsp_ch="on" data-xy="x:c;xo:159px,159px,627px,386px;y:m;yo:299px,169px,38px,23px;" data-text="w:normal;s:20,20,12,7;l:0,0,15,9;" data-dim="w:150px,150px,93px,57px;h:150px,150px,93px,57px;"
                                data-border="bor:50%,50%,50%,50%;" data-frame_0="sX:0.9;sY:0.9;" data-frame_1="e:Linear.easeNone;st:310;sp:400;sR:310;" data-frame_999="o:0;st:w;sR:8290;">
                            </rs-layer>
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-12" class="slider-client" data-type="text" data-rsp_ch="on" data-xy="x:c;xo:156px,156px,626px,386px;yo:725px,530px,266px,164px;" data-text="w:normal;s:15,15,9,5;l:20,20,12,7;a:center;" data-vbility="t,t,f,f" data-frame_1="st:380;sR:380;"
                                data-frame_999="o:0;st:w;sR:8320;">100% Client<br>Satisfaction
                            </rs-layer>
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-13" class="slider-client" data-type="text" data-rsp_ch="on" data-xy="x:c;xo:155px,155px,625px,385px;yo:679px,480px,238px,146px;" data-text="w:normal;s:37,37,22,13;l:37,37,22,13;" data-vbility="t,t,f,f" data-frame_1="st:380;sR:380;" data-frame_999="o:0;st:w;sR:8320;"><i class="fa fa-paper-plane-o"></i><br />
                            </rs-layer>
                        </rs-slide>
                        @endforeach
                    </rs-slides>
                </rs-module>
                <!-- rs-module -->
            </rs-module-wrap>




        </div>
        <!-- END REVOLUTION SLIDER -->


        <!--site-main start-->
        <div class="site-main">



            <!-- aboutus-section -->
            <section class="ttm-row aboutus-section-style2 clearfix home-page">
                <div class="container">
                    <div class="row no-gutters align-items-center">
                        <!-- row -->
                        <div class="col-lg-6">
                            <!-- ttm_single_image-wrapper -->
                            <div class="ttm_single_image-wrapper">
                                <img class="img-fluid" src="{{ asset('frontend/images/') }}/about2.jpg" title="single-img-two" alt="single-img-two">
                            </div>
                            <!-- ttm_single_image-wrapper end -->
                        </div>

                        <div class="col-lg-6">
                            <div class="spacing-4 ttm-bgcolor-grey res-991-mt-30">
                                <!-- section title -->
                                <div class="section-title with-desc clearfix">
                                    <div class="title-header">
                                        <h5>About Global Graphic Giant</h5>
                                        <h3 class="title">Global Graphic Giant grew from four persons company to a 100 persons company with in 19 years by repeatedly delivering client satisfaction.</h3>
                                    </div>
                                    <div class="title-desc">
                                        <p>Global Graphic Giant is one of the fastest growing and forward thinking IT solution companies in Bangladesh, delivering outstanding software outsourcing services to clients in EU (Denmark, Norway, Germeny, Sweden), North
                                            America and Japan since 2006. We have a successful track record in serving our customers across the globe with vast experience in technical domain such as ASP .Net, C#, Java, PHP, iOS, Android. We have global
                                            presence in different time zones. We use latest technology and software for Web, e-commerce, Mobile Technology and Print Media.</p>
                                    </div>
                                </div>
                                <!-- section title end -->
                                <!-- row -->
                                <div class="row no-gutters mt-20">
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <!--  featured-icon-box -->
                                        <div class="featured-icon-box style3 left-icon icon-align-top featured-content2">
                                            <div class="featured-icon">
                                                <!--  featured-icon -->
                                                <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-lg">
                                                    <i class="ti ti-medall"></i>
                                                    <!--  ttm-icon -->
                                                </div>
                                            </div>
                                            <div class="featured-content featured-contenttest">
                                                <!--  featured-content -->
                                                <div class="featured-title">
                                                    <!--  featured-title -->
                                                    <h5>100% Satisfaction</h5>
                                                </div>
                                                <div class="featured-desc">
                                                    <!--  featured-desc -->
                                                    <p>We are with you 24/7/365 to ensure your operations run smoothly.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  featured-icon-box END -->
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <!--  featured-icon-box -->
                                        <div class="featured-icon-box style3 left-icon icon-align-top">
                                            <div class="featured-icon">
                                                <!--  featured-icon -->
                                                <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-lg">
                                                    <i class="ti ti-bookmark-alt"></i>
                                                    <!--  ttm-icon -->
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <!--  featured-content -->
                                                <div class="featured-title">
                                                    <!--  featured-title -->
                                                    <h5>Reduce Your Costs</h5>
                                                </div>
                                                <div class="featured-desc">
                                                    <!--  featured-desc -->
                                                    <p>In comparison to Western European and North American prices we can reduce your costs by 50%</p>
                                                </div>
                                            </div>
                                        </div>
                                        <!--  featured-icon-box END -->
                                    </div>

                                </div>
                                <!-- row END-->
                                <!-- separator -->
                                <div class="separator">
                                    <div class="sep-line mt-30 mb-15"></div>
                                </div>
                                <!-- separator -->

                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                    <!-- row -->
                    <div class="row">

                    </div>
                    <!-- row end-->
                </div>
            </section>
            <!-- aboutus-section end -->

            <!-- fid-section -->
            <section class="ttm-row bottomzero-padding-section bg-img6 position-relative z-1 clearfix">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-10">
                            <div class="ttm-bgcolor-skincolor ttm-bg ttm-col-bgcolor-yes ttm-left-span mb_80 res-991-mb-0">
                                <div class="ttm-col-wrapper-bg-layer ttm-bg-layer">
                                    <div class="ttm-bg-layer-inner"></div>
                                </div>
                                <div class="layer-content">
                                    <div class="row">
                                        <div class="col-lg-11">
                                            <div class="spacing-5">
                                                <!-- section title -->
                                                <div class="section-title with-desc mb-40 clearfix">
                                                    <div class="title-header">
                                                        <h5>About Global Graphic Giant</h5>
                                                        <h2 class="title">Trusted by 5,000+ <span>Happy Clients</span></h2>
                                                    </div>
                                                    <div class="title-desc">
                                                        <p>Global Graphic Giant grew from four persons company to a 100 persons company with in 19 years by repeatedly delivering client satisfaction.</p>
                                                    </div>
                                                </div>
                                                <!-- section title end -->
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <!--  featured-icon-box -->
                                                        <div class="featured-icon-box style4 left-icon">
                                                            <div class="featured-icon">
                                                                <!--  featured-icon -->
                                                                <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-md">
                                                                    <i class="flaticon flaticon-24h"></i>
                                                                    <!--  ttm-icon -->
                                                                </div>
                                                            </div>
                                                            <div class="featured-content">
                                                                <!--  featured-content -->
                                                                <div class="featured-title">
                                                                    <!--  featured-title -->
                                                                    <h5 class="fw-500">100% Satisfaction</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  featured-icon-box END -->
                                                    </div>
                                                    <div class="col-md-4">
                                                        <!--  featured-icon-box -->
                                                        <div class="featured-icon-box style4 left-icon">
                                                            <div class="featured-icon">
                                                                <!--  featured-icon -->
                                                                <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-md">
                                                                    <i class="flaticon flaticon-code"></i>
                                                                    <!--  ttm-icon -->
                                                                </div>
                                                            </div>
                                                            <div class="featured-content">
                                                                <!--  featured-content -->
                                                                <div class="featured-title">
                                                                    <!--  featured-title -->
                                                                    <h5 class="fw-500">World Class Developer</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  featured-icon-box END -->
                                                    </div>
                                                    <div class="col-md-4">
                                                        <!--  featured-icon-box -->
                                                        <div class="featured-icon-box style4 left-icon">
                                                            <div class="featured-icon">
                                                                <!--  featured-icon -->
                                                                <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-md">
                                                                    <i class="flaticon flaticon-data"></i>
                                                                    <!--  ttm-icon -->
                                                                </div>
                                                            </div>
                                                            <div class="featured-content">
                                                                <!--  featured-content -->
                                                                <div class="featured-title">
                                                                    <!--  featured-title -->
                                                                    <h5 class="fw-500">World Class Designer & 3D Artist</h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--  featured-icon-box END -->
                                                    </div>
                                                </div>
                                                <div class="row ttm-fid-row-wrapper">
                                                    <div class="col-md-3 col-sm-3 Completedbox">
                                                        <!--ttm-fid-->
                                                        <div class="ttm-fid inside ttm-fid-view-lefticon style1">
                                                            <div class="ttm-fid-left">
                                                                <!--ttm-fid-left-->
                                                                <div class="ttm-fid-icon-wrapper">
                                                                    <i class="flaticon flaticon-developer"></i>
                                                                </div>
                                                            </div>
                                                            <div class="ttm-fid-contents text-left">
                                                                <!--ttm-fid-contents-->
                                                                <h4 class="ttm-fid-inner">
                                                                    <span data-appear-animation="animateDigits" data-from="0" data-to="14" data-interval="5" data-before="" data-before-style="sup" data-after="" data-after-style="sub">478</span>
                                                                </h4>
                                                                <h3 class="ttm-fid-title">Markets</h3>
                                                                <!--ttm-fid-title-->
                                                            </div>
                                                        </div>
                                                        <!-- ttm-fid end-->
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 Completedbox">
                                                        <!--ttm-fid-->
                                                        <div class="ttm-fid inside ttm-fid-view-lefticon style1">
                                                            <div class="ttm-fid-left">
                                                                <!--ttm-fid-left-->
                                                                <div class="ttm-fid-icon-wrapper">
                                                                    <i class="flaticon flaticon-developer"></i>
                                                                </div>
                                                            </div>
                                                            <div class="ttm-fid-contents text-left">
                                                                <!--ttm-fid-contents-->
                                                                <h4 class="ttm-fid-inner">
                                                                    <span data-appear-animation="animateDigits" data-from="0" data-to="90" data-interval="5" data-before="" data-before-style="sup" data-after="" data-after-style="sub">478</span>
                                                                </h4>
                                                                <h3 class="ttm-fid-title">FTE</h3>
                                                                <!--ttm-fid-title-->
                                                            </div>
                                                        </div>
                                                        <!-- ttm-fid end-->
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 Completedbox">
                                                        <!--ttm-fid-->
                                                        <div class="ttm-fid inside ttm-fid-view-lefticon style1">
                                                            <div class="ttm-fid-left">
                                                                <div class="ttm-fid-icon-wrapper">
                                                                    <i class="flaticon flaticon-interaction"></i>
                                                                </div>
                                                            </div>
                                                            <div class="ttm-fid-contents text-left">
                                                                <h4 class="ttm-fid-inner">
                                                                    <span data-appear-animation="animateDigits" data-from="0" data-to="13214" data-interval="5" data-before="" data-before-style="sup" data-after="" data-after-style="sub">642</span>
                                                                </h4>
                                                                <h3 class="ttm-fid-title">Jobs Completed</h3>
                                                            </div>
                                                        </div>
                                                        <!-- ttm-fid end-->
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 Completedbox">
                                                        <!--ttm-fid-->
                                                        <div class="ttm-fid inside ttm-fid-view-lefticon style1">
                                                            <div class="ttm-fid-left">
                                                                <div class="ttm-fid-icon-wrapper">
                                                                    <i class="flaticon flaticon-global-1"></i>
                                                                </div>
                                                            </div>
                                                            <div class="ttm-fid-contents text-left">
                                                                <h4 class="ttm-fid-inner">
                                                                    <span data-appear-animation="animateDigits" data-from="0" data-to="323510" data-interval="5" data-before="" data-before-style="sup" data-after="" data-after-style="sub">578</span>
                                                                </h4>
                                                                <h3 class="ttm-fid-title">Deliverables</h3>
                                                            </div>
                                                        </div>
                                                        <!-- ttm-fid end-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- fid-section -->

            <!-- services-section -->
            <section class="ttm-row services-section ttm-bgcolor-darkgrey ttm-bg ttm-bgimage-yes bg-img7 clearfix">
                <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
                <div class="container">
                    <div class="row service-section">
                        <!-- row -->
                        <div class="col-lg-8 offset-lg-4">
                            <!-- section title -->
                            <div class="section-title with-desc text-center clearfix">
                                <div class="title-header">
                                    <h5>Our Services</h5>
                                    <h2 class="title">We run all kinds of Web Development, Image Design & 3D services with 19+ years of <span>experience</span></h2>
                                </div>
                            </div>
                            <!-- section title end -->
                        </div>
                    </div>
                    <!-- row end -->
                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <!-- featured-icon-box -->
                            <div class="featured-icon-box style5 text-left mb-20">
                                <div class="featured-icon">
                                    <!-- featured-icon-->
                                    <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-lg">
                                        <i class="flaticon flaticon-developer"></i>
                                    </div>
                                </div>
                                <!-- featured-icon -->
                                <div class="featured-content">
                                    <!-- featured-content -->
                                    <div class="featured-title">
                                        <h5>Web Development</h5>
                                        <!-- featured-title -->
                                    </div>
                                    <div class="featured-desc">
                                        <!-- featured-description -->
                                        <p>Global Graphic Giant Ltd. offers custom web application development on various technologies like Objective C, Java for Android, .NET, PHP, Action Script, CakePHP, MySQL, HTML5. As per the client's custom need</p>
                                    </div>
                                    <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-white btn-inline ttm-icon-btn-right mt-15" href="web-development">Read More <i class="ti ti-angle-double-right"></i></a>
                                </div>
                                <!-- featured-content END-->
                            </div>
                            <!-- featured-icon-box -->
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <!-- featured-icon-box -->
                            <div class="featured-icon-box style5 text-left mb-20">
                                <div class="featured-icon">
                                    <!-- featured-icon-->
                                    <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-lg">
                                        <i class="flaticon flaticon-code"></i>
                                    </div>
                                </div>
                                <!-- featured-icon -->
                                <div class="featured-content">
                                    <!-- featured-content -->
                                    <div class="featured-title">
                                        <h5>Website Design</h5>
                                        <!-- featured-title -->
                                    </div>
                                    <div class="featured-desc">
                                        <!-- featured-description -->
                                        <p>Web Design is essential to provider a user friendly experience for all users across all platforms (Desktops, Tablets & Smartphones). </p>
                                    </div>
                                    <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-white btn-inline ttm-icon-btn-right mt-15" href="responsive-web-design">Read More <i class="ti ti-angle-double-right"></i></a>
                                </div>
                                <!-- featured-content END-->
                            </div>
                            <!-- featured-icon-box -->
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <!-- featured-icon-box -->
                            <div class="featured-icon-box style5 text-left mb-20">
                                <div class="featured-icon">
                                    <!-- featured-icon-->
                                    <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-lg">
                                        <i class="flaticon flaticon-report"></i>
                                    </div>
                                </div>
                                <!-- featured-icon -->
                                <div class="featured-content">
                                    <!-- featured-content -->
                                    <div class="featured-title">
                                        <h5>Ecommerce Development</h5>
                                        <!-- featured-title -->
                                    </div>
                                    <div class="featured-desc">
                                        <!-- featured-description -->
                                        <p>Ecommerce development platforms to lunch a modern website. However, you would still need skillful experts to get a professional website for your business. </p>
                                    </div>
                                    <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-white btn-inline ttm-icon-btn-right mt-15" href="ecommerce-development">Read More <i class="ti ti-angle-double-right"></i></a>
                                </div>
                                <!-- featured-content END-->
                            </div>
                            <!-- featured-icon-box -->
                        </div>
                    </div>
                    <!-- row end-->
                    <!-- row -->
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <!-- featured-icon-box -->
                            <div class="featured-icon-box style5 text-left mb-20">
                                <div class="featured-icon">
                                    <!-- featured-icon-->
                                    <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-lg">
                                        <i class="flaticon flaticon-24h"></i>
                                    </div>
                                </div>
                                <!-- featured-icon -->
                                <div class="featured-content">
                                    <!-- featured-content -->
                                    <div class="featured-title">
                                        <h5>Mobile Application Development</h5>
                                        <!-- featured-title -->
                                    </div>
                                    <div class="featured-desc">
                                        <!-- featured-description -->
                                        <p>At Global Graphic Giant, we are aware of the applications you need for your phone. Therefore, we ensure that we create the application from the beginning through to the end to ensure the end users of the application
                                            can utilize the application to their liking. </p>
                                    </div>
                                    <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-white btn-inline ttm-icon-btn-right mt-15" href="web-development">Read More <i class="ti ti-angle-double-right"></i></a>
                                </div>
                                <!-- featured-content END-->
                            </div>
                            <!-- featured-icon-box -->
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <!-- featured-icon-box -->
                            <div class="featured-icon-box style5 text-left mb-20">
                                <div class="featured-icon">
                                    <!-- featured-icon-->
                                    <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-lg">
                                        <i class="flaticon flaticon-report"></i>
                                    </div>
                                </div>
                                <!-- featured-icon -->
                                <div class="featured-content">
                                    <!-- featured-content -->
                                    <div class="featured-title">
                                        <h5>Banner Production</h5>
                                        <!-- featured-title -->
                                    </div>
                                    <div class="featured-desc">
                                        <!-- featured-description -->
                                        <p>Our expert Graphics Designer can create elegant, simple, clean & eye-catching Banner or Slider that will match with your exiting brand. We have great experience & skill to create Banner or Website header for your
                                            Business on different occasion & events. </p>
                                    </div>
                                    <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-white btn-inline ttm-icon-btn-right mt-15" href="banner-design">Read More <i class="ti ti-angle-double-right"></i></a>
                                </div>
                                <!-- featured-content END-->
                            </div>
                            <!-- featured-icon-box -->
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <!-- featured-icon-box -->
                            <div class="featured-icon-box style5 text-left mb-20">
                                <div class="featured-icon">
                                    <!-- featured-icon-->
                                    <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-lg">
                                        <i class="flaticon flaticon-computer"></i>
                                    </div>
                                </div>
                                <!-- featured-icon -->
                                <div class="featured-content">
                                    <!-- featured-content -->
                                    <div class="featured-title">
                                        <h5>Image Production</h5>
                                        <!-- featured-title -->
                                    </div>
                                    <div class="featured-desc">
                                        <!-- featured-description -->
                                        <p>Global Graphic Giant is one of the most fascinating images editing service provider. That provides excellent quality of isolating image editing services. Our company will guarantee you the best quality done images.
                                            </p>
                                    </div>
                                    <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-white btn-inline ttm-icon-btn-right mt-15" href="clipping-path">Read More <i class="ti ti-angle-double-right"></i></a>
                                </div>
                                <!-- featured-content END-->
                            </div>
                            <!-- featured-icon-box -->
                        </div>
                    </div>
                    <!-- row end-->
                </div>
            </section>
            <!-- services-section end -->

            <!-- topzero-padding-section -->
            <section class="ttm-row zero-padding-section mt_95 res-991-mt-0 clearfix">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-3">
                            <!-- col-bg-img-three -->
                            <div class="col-bg-img-three ttm-bg ttm-col-bgimage-yes res-991-h-auto">
                                <div class="ttm-col-wrapper-bg-layer ttm-bg-layer">
                                    <div class="ttm-bg-layer-inner"></div>
                                </div>
                            </div>
                            <!-- Responsive View image -->
                            <img src="{{ asset('frontend/images/') }}/bg-image/Save_money.png" class="ttm-equal-height-image" alt="col-bgimage-3">
                        </div>
                        <div class="col-lg-9">
                            <div class="ttm-bgcolor-skincolor ttm-bg ttm-col-bgcolor-yes ttm-right-span">
                                <div class="ttm-col-wrapper-bg-layer ttm-bg-layer">
                                    <div class="ttm-bg-layer-inner"></div>
                                </div>
                                <div class="layer-content">
                                    <div class="spacing-6 ttm-textcolor-white">
                                        <h3 class="mb-5">Knock Us if you need to create an awesome website & web application!</h3>
                                        <p class="mb-0">Global Graphic Giant is one of the fastest growing and forward thinking IT solution companies in Bangladesh, delivering outstanding software outsourcing services to clients in EU (Denmark, Norway, Germeny, Sweden), North
                                            America and Japan since 2006. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- topzero-padding-section -->

            <!-- tab-section -->
            <section class="ttm-row tab-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- section title -->
                            <div class="section-title text-center with-desc clearfix">
                                <div class="title-header">
                                    <h5>Why Are We Different From Others</h5>
                                    <h2 class="title">We are not like traditional outsourcing providers where they only focus on cost reduction. We focus on quality first followed by other aspects. We do not want to be a cheap provider rather than quality solution provider
                                        within <span>affordable cost. </span></h2>
                                </div>
                            </div>
                            <!-- section title end -->
                        </div>
                    </div>
                    <!-- row end -->
                    <!-- row -->
                    <div class="row">

                        <div class="col-lg-12">
                            <div class="ttm-tabs text-center ttm-tab-style-classic style1">
                                <ul class="tabs mb-20">
                                    <!-- tabs -->
                                    <li class="tab active"><a href="#"> <i class="flaticon flaticon-code"></i> Reduce your costs</a></li>
                                    <li class="tab"><a href="#"> <i class="flaticon flaticon-report"></i> Simple Workflow </a></li>
                                    <li class="tab"><a href="#"> <i class="flaticon flaticon-24h"></i> 24 Hour Service </a></li>

                                </ul>
                                <!-- tabs end-->
                                <div class="content-tab width-100 box-shadow">
                                    <!--content-tabs -->
                                    <!-- content-inner -->
                                    <div class="content-inner active" style="display: block;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-left">
                                                    <h3 class="title fs-30"> Reduce your project costs</h3>
                                                    <p>In comparison to Western European and North American prices we can reduce your costs by 50% when it comes to Web development, Mobile Application development, HTML5, Flash production & Graphics Design
                                                        (Clipping Path, Image masking, Newspaper Ads design, Magazine makeup, Company branding etc.)</p>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- row end -->
                                    </div>
                                    <!-- content-inner -->
                                    <!-- row end-->
                                    <!-- content-inner -->
                                    <div class="content-inner" style="display: none;">
                                        <div class="row">

                                            <div class="col-lg-12">
                                                <div class="text-left res-991-mt-30">
                                                    <h3 class="title fs-30">Our Process Workflow</h3>
                                                    <p>We provide a well proven and efficient workflow. Just send the assignment through our FTP and get your finished materials back within few hours based on job complexity.</p>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- row end -->
                                    </div>
                                    <!-- content-inner -->
                                    <!-- row end-->
                                    <!-- content-inner -->
                                    <div class="content-inner" style="display: none;">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="text-left">
                                                    <h3 class="title fs-30">Our 24-hour service</h3>
                                                    <p>We are with you 24/7/365 to ensure your operations run smoothly. We are committed to make sure that your business is always running-without interruption.</p>

                                                </div>
                                            </div>

                                        </div>
                                        <!-- row end -->
                                    </div>
                                    <!-- content-inner -->
                                    <!-- row end-->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- tab-section end -->

            <!-- testimonial-section end -->
            <section class="ttm-row bottomzero-padding-section ttm-bgcolor-grey ttm-bg ttm-bgimage-yes bg-img8 clearfix">
                <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
                <div class="container">
                    <div class="row">
                        <!-- row -->
                        <div class="col-lg-6">
                            <div class="position-relative z-1">
                                <!-- spacing-2 -->
                                <!-- section title -->
                                <div class="section-title with-desc clearfix">
                                    <div class="title-header">
                                        <h5>About us</h5>
                                        <h2 class="title">We deal with the aspects of professional <span>Web Services</span></h2>
                                    </div>
                                </div>
                                <!-- section title end -->
                                <div class="testimonial-slide box-sahdow ttm-bgcolor-white col-bg-img-four style1 owl-carousel" data-item="1" data-nav="false" data-dots="true" data-auto="false">
                                    <!-- testimonials -->
                                    <div class="testimonials text-center">
                                        <div class="testimonial-content">
                                            <!-- testimonials-content -->
                                            <div class="testimonial-avatar">
                                                <div class="testimonial-img">
                                                    <!-- testimonials-img -->
                                                    <img class="img-center" src="{{ asset('frontend/images/') }}/testimonial/man.jpg" alt="testimonial-img">
                                                </div>
                                            </div>
                                            <blockquote>I am working with Global Graphic Giant for the past 5 years. I find Global Graphic Giantis very professional and always putting the needs of their customers first. You can always be assured the work produced by Global Graphic Giant is top
                                                quality on all levels. Always a pleasure working with Shehala.</blockquote>
                                            <div class="ttm-ratting-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="testimonial-caption">
                                                <!-- testimonials-caption -->
                                                <h6>Eddle Cipolla</h6>
                                                <label>Account Director at St. Joseph Communications, Canada</label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- testimonials END -->
                                    <!-- testimonials -->
                                    <div class="testimonials text-center">
                                        <div class="testimonial-content">
                                            <!-- testimonials-content -->
                                            <div class="testimonial-avatar">
                                                <div class="testimonial-img">
                                                    <!-- testimonials-img -->
                                                    <img class="img-center" src="{{ asset('frontend/images/') }}/testimonial/man.jpg" alt="testimonial-img">
                                                </div>
                                            </div>
                                            <blockquote>I have worked with many different outsourcing companies (suppliers of different products), Global Graphic Giantis without doubt, one of the best companies. They work fast, good and for a fair price. They are not the cheapest
                                                but, you can’t get better quality cheaper. Quality and price go hand in hand.</blockquote>
                                            <div class="ttm-ratting-star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="testimonial-caption">
                                                <!-- testimonials-caption -->
                                                <h6>Chris Mikkelsen</h6>
                                                <label>Production Chief at enVision</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- testimonials END -->
                                </div>
                                <!-- separator -->
                                <div class="separator">
                                    <div class="sep-line"></div>
                                </div>
                                <!-- separator END-->
                                <div class="card border-0">
                                    <div class="card-body">
                                        <!-- featured-icon-box -->
                                        <div class="featured-icon-box style2 left-icon icon-align-top">
                                            <div class="featured-icon">
                                                <!-- featured-icon -->
                                                <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-lg">
                                                    <i class="flaticon flaticon-call"></i>
                                                </div>
                                            </div>
                                            <div class="featured-content">
                                                <div class="featured-desc">
                                                    <!-- featured desc -->
                                                    <p>Need a service &amp; ready to order? Call us</p>
                                                </div>
                                                <div class="featured-title">
                                                    <!-- featured title -->
                                                    <h5>Contact Us: <strong class="ttm-textcolor-skincolor">+1 (416) 686-3111</strong></h5>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- featured-icon-box END-->
                                    </div>
                                </div>
                            </div>
                            <!-- spacing-2 END -->
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative res-991-mt-30">
                                <!-- ttm_single_image-wrapper -->
                                <div class="ttm_single_image-wrapper text-right">
                                    <img class="img-fluid" src="{{ asset('frontend/images/') }}/indicate2.jpg" title="single-img-four" alt="single-img-four">
                                </div>
                                <!-- ttm_single_image-wrapper end -->
                                <div class="ttm-highlight-fid-style-1">
                                    <!--ttm-fid-->
                                    <div class="ttm-fid inside without-icon">
                                        <div class="ttm-fid-contents text-left">
                                            <h4 class="ttm-fid-inner">
                                                <span data-appear-animation="animateDigits" data-from="0" data-to="19" data-interval="2" data-before="" data-before-style="sup" data-after="" data-after-style="sub">14</span>
                                            </h4>
                                            <h3 class="ttm-fid-title">Years of Experience Web Solution </h3>
                                        </div>
                                    </div>
                                    <!-- ttm-fid end-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                </div>
            </section>
            <!-- testimonial-section end -->

            <!-- first-row-title-section -->
            <section class="ttm-row second-row-title-section mt_90 ttm-bgcolor-darkgrey ttm-bg ttm-bgimage-yes bg-img9 clearfix">
                <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
                <div class="container">
                    <div class="row">
                        <!-- row -->
                        <div class="col-lg-8 offset-lg-2">
                            <div class="text-center">
                                <div class="ttm-play-icon-btn mb-35">
                                    <div class="ttm-play-icon-animation">
                                        <a href="https://www.youtube.com/embed/9fidoaaOn_4" target="_blank" class="ttm_prettyphotouuu">
                                            <div class="ttm-icon ttm-icon_element-bgcolor-skincolor ttm-icon_element-size-sm ttm-icon_element-style-round">
                                                <i class="fa fa-play"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- section-title -->
                                <div class="section-title row-title clearfix">
                                    <div class="title-header">
                                        <h2 class="title"> We help to create your business identity & <span>stunning on online,</span></h2>

                                    </div>
                                    <div class="title-desc">with Basic Website, Web Application, CMS Web Development, Dynamic Website to Advanced Level of Ecommerce Development.</div>
                                </div>
                                <!-- section-title end -->
                                <div class="mt-40">
                                    <a href="portfolio" class="ttm-btn ttm-btn-size-md ttm-btn-style-border ttm-btn-color-white">View Portfolio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- first-row-title-section END-->

<!-- portfolio-section -->
<section class="ttm-row bottomzero-padding-section position-relative clearfix home-portfolio">
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <!-- section title -->
                <div class="section-title text-center with-desc clearfix">
                    <div class="title-header">
                        <h5>Look At Portfolio</h5>
                        <h2 class="title">
                            Check out our <span>Portfolio</span>
                        </h2>
                    </div>
                </div>
                <!-- section title end -->

            </div>
        </div>

        <!-- row -->
        <div class="row multi-columns-row ttm-boxes-spacing-10px ttm-bgcolor-white">

            <!-- Item 1 -->
            <div class="ttm-box-col-wrapper col-lg-4 col-md-6 col-sm-6">
                <div class="featured-imagebox featured-imagebox-portfolio style2">

                    <div class="featured-thumbnail">
                        <img class="img-fluid"
                             src="{{ asset('frontend/images/portfolio-images/FnFrTDMZtBZhigI46dtB.jpg') }}"
                             alt="Århus Håndbold">
                    </div>

                    <div class="featured-content">
                        <div class="category">
                            <p>WordPress</p>
                        </div>

                        <div class="featured-title">
                            <h5>
                                <a href="{{ url('portfolio-details/6/1') }}">
                                    Århus Håndbold
                                </a>
                            </h5>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Item 2 -->
            <div class="ttm-box-col-wrapper col-lg-4 col-md-6 col-sm-6">
                <div class="featured-imagebox featured-imagebox-portfolio style2">

                    <div class="featured-thumbnail">
                        <img class="img-fluid"
                             src="{{ asset('frontend/images/portfolio-images/ZmzoV1cxPYFGu8UeT4Pi.jpg') }}"
                             alt="JPL Golf">
                    </div>

                    <div class="featured-content">
                        <div class="category">
                            <p>WordPress</p>
                        </div>

                        <div class="featured-title">
                            <h5>
                                <a href="{{ url('portfolio-details/12/1') }}">
                                    JPL Golf
                                </a>
                            </h5>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Item 3 -->
            <div class="ttm-box-col-wrapper col-lg-4 col-md-6 col-sm-6">
                <div class="featured-imagebox featured-imagebox-portfolio style2">

                    <div class="featured-thumbnail">
                        <img class="img-fluid"
                             src="{{ asset('frontend/images/portfolio-images/Ld8r6TL3KDgDPBlc4HOt.jpg') }}"
                             alt="Allt om handarbete">
                    </div>

                    <div class="featured-content">
                        <div class="category">
                            <p>Joomla</p>
                        </div>

                        <div class="featured-title">
                            <h5>
                                <a href="{{ url('portfolio-details/14/2') }}">
                                    Allt om handarbete
                                </a>
                            </h5>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Item 4 -->
            <div class="ttm-box-col-wrapper col-lg-4 col-md-6 col-sm-6">
                <div class="featured-imagebox featured-imagebox-portfolio style2">

                    <div class="featured-thumbnail">
                        <img class="img-fluid"
                             src="{{ asset('frontend/images/portfolio-images/2SC6qwIRc7mX6zKYKIdz.jpg') }}"
                             alt="Divider">
                    </div>

                    <div class="featured-content">
                        <div class="category">
                            <p>3D Services</p>
                        </div>

                        <div class="featured-title">
                            <h5>
                                <a href="{{ url('portfolio-details/24/11') }}">
                                    Divider
                                </a>
                            </h5>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Item 5 -->
            <div class="ttm-box-col-wrapper col-lg-4 col-md-6 col-sm-6">
                <div class="featured-imagebox featured-imagebox-portfolio style2">

                    <div class="featured-thumbnail">
                        <img class="img-fluid"
                             src="{{ asset('frontend/images/portfolio-images/piQ1zfM7onZ3ClcGxRHr.jpg') }}"
                             alt="Burda Style">
                    </div>

                    <div class="featured-content">
                        <div class="category">
                            <p>Magazine Design</p>
                        </div>

                        <div class="featured-title">
                            <h5>
                                <a href="{{ url('portfolio-details/34/13') }}">
                                    Burda Style
                                </a>
                            </h5>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Item 6 -->
            <div class="ttm-box-col-wrapper col-lg-4 col-md-6 col-sm-6">
                <div class="featured-imagebox featured-imagebox-portfolio style2">

                    <div class="featured-thumbnail">
                        <img class="img-fluid"
                             src="{{ asset('frontend/images/portfolio-images/PAIsGUEnKWC1zNCEXzFN.jpg') }}"
                             alt="Newspaper Add">
                    </div>

                    <div class="featured-content">
                        <div class="category">
                            <p>Newspaper Add</p>
                        </div>

                        <div class="featured-title">
                            <h5>
                                <a href="{{ url('portfolio-details/39/14') }}">
                                    Newspaper Add
                                </a>
                            </h5>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Button -->
            <div class="col-md-12 text-center mt-4">
                <a class="ttm-btn ttm-btn-size-lg ttm-btn-shape-square ttm-icon-btn-right ttm-btn-bgcolor-skincolor"
                   href="{{ url('portfolio') }}">
                    View More
                    <i class="ti ti-arrow-circle-right"></i>
                </a>
            </div>

        </div>
        <!-- row end -->

    </div>
</section>
<!-- portfolio-section end -->

            <!-- our-partner-section -->
            <div class="ttm-row our-partner-section ttm-bgcolor-skincolor mt_90 res-991-mt-0 clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- ttm-client -->
                            <div class="clients-slide owl-carousel owl-theme owl-loaded" data-item="5" data-nav="false" data-dots="false" data-auto="false">
                                <div class="client-box ttm-box-view-boxed-logo">
                                    <div class="client">
                                        <div class="ttm-client-logo-tooltip" data-tooltip="client-01">
                                            <img class="img-fluid" src="{{ asset('frontend/images/') }}/client/client-01.jpeg" alt="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="client-box ttm-box-view-boxed-logo">
                                    <div class="client">
                                        <div class="ttm-client-logo-tooltip" data-tooltip="client-02">
                                            <img class="img-fluid" src="{{ asset('frontend/images/') }}/client/client-2.jpeg" alt="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="client-box ttm-box-view-boxed-logo">
                                    <div class="client">
                                        <div class="ttm-client-logo-tooltip" data-tooltip="client-03">
                                            <img class="img-fluid" src="{{ asset('frontend/images/') }}/client/client-3.jpeg" alt="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="client-box ttm-box-view-boxed-logo">
                                    <div class="client">
                                        <div class="ttm-client-logo-tooltip" data-tooltip="client-04">
                                            <img class="img-fluid" src="{{ asset('frontend/images/') }}/client/client-4.jpeg" alt="image">
                                        </div>
                                    </div>
                                </div>
                                <div class="client-box ttm-box-view-boxed-logo">
                                    <div class="client">
                                        <div class="ttm-client-logo-tooltip" data-tooltip="client-05">
                                            <img class="img-fluid" src="{{ asset('frontend/images/') }}/client/client-5.jpeg" alt="image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ttm-client end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- our-partner-section END-->

            <!-- blog-section end -->
            <section class="ttm-row blog-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- section title -->
                            <div class="section-title text-center with-desc clearfix">
                                <div class="title-header">
                                    <h5>Our Blog</h5>
                                    <h2 class="title">Check out our <span>Latest News</span></h2>
                                </div>
                            </div>
                            <!-- section title end -->
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row">
                        <!-- blog-slide -->
                        <div class="blog-slide owl-carousel owl-theme owl-loaded " data-item="3" data-nav="false" data-dots="false" data-auto="false">
                            <!-- featured-imagebox-blog -->
                            <div class="featured-imagebox featured-imagebox-blog">
                                <div class="featured-thumbnail">
                                    <!-- featured-thumbnail -->
                                    <img class="img-fluid" src="{{ asset('frontend/images/') }}/blog/shehala-ecommerce.png" alt="">
                                    <div class="ttm-blog-overlay-iconbox">
                                        <a href="role-and-essence-of-clipping-path-services-for-modern-ecommerce"><i class="ti ti-plus"></i></a>
                                    </div>
                                    <div class="ttm-box-view-overlay"></div>
                                </div>
                                <div class="featured-content">
                                    <!-- featured-content -->
                                    <div class="ttm-box-post-date">
                                        <!-- ttm-box-post-date -->
                                        <span class="ttm-entry-date">
                                            <time class="entry-date" datetime="2019-01-16T07:07:55+00:00">8<span class="entry-month entry-year">Feb</span></time>
                                        </span>
                                    </div>
                                    <div class="featured-title">
                                        <!-- featured-title -->
                                        <h5><a href="role-and-essence-of-clipping-path-services-for-modern-ecommerce">Role and Essence of Clipping Path Services for Modern Ecommerce</a></h5>
                                    </div>
                                    <div class="post-meta">
                                        <!-- post-meta -->
                                        <span class="ttm-meta-line"><i class="fa fa-comments"></i> comments</span>
                                        <span class="ttm-meta-line"><i class="fa fa-user"></i> Shehala</span>

                                    </div>
                                    <div class="featured-desc">
                                        <!-- featured-description -->
                                        <p>It is now common knowledge that clipping path design has a dominant role in modern online marketing. Among most...</p>
                                    </div>
                                    <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-skincolor btn-inline ttm-icon-btn-right mt-20" href="role-and-essence-of-clipping-path-services-for-modern-ecommerce">Read More <i class="ti ti-angle-double-right"></i></a>
                                </div>
                            </div>
                            <!-- featured-imagebox-blog end -->
                            <!-- featured-imagebox-blog -->
                            <div class="featured-imagebox featured-imagebox-blog">
                                <div class="featured-thumbnail">
                                    <!-- featured-thumbnail -->
                                    <img class="img-fluid" src="{{ asset('frontend/images/') }}/blog/online_business.png" alt="">
                                    <div class="ttm-blog-overlay-iconbox">
                                        <a href="7-image-editing-tips-to-dominate-in-online-business"><i class="ti ti-plus"></i></a>
                                    </div>
                                    <div class="ttm-box-view-overlay"></div>
                                </div>
                                <div class="featured-content">
                                    <!-- featured-content -->
                                    <div class="ttm-box-post-date">
                                        <!-- ttm-box-post-date -->
                                        <span class="ttm-entry-date">
                                            <time class="entry-date" datetime="2019-01-16T07:07:55+00:00">10<span class="entry-month entry-year">Feb</span></time>
                                        </span>
                                    </div>
                                    <div class="featured-title">
                                        <!-- featured-title -->
                                        <h5><a href="7-image-editing-tips-to-dominate-in-online-business">Seven Image Editing Tips To Dominate In Online Business</a></h5>
                                    </div>
                                    <div class="post-meta">
                                        <!-- post-meta -->
                                        <span class="ttm-meta-line"><i class="fa fa-comments"></i> comments</span>
                                        <span class="ttm-meta-line"><i class="fa fa-user"></i> Shehala</span>

                                    </div>
                                    <div class="featured-desc">
                                        <!-- featured-description -->
                                        <p>If you are planning to set up an online business or take your business ahead, you should consider...</p>
                                    </div>
                                    <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-skincolor btn-inline ttm-icon-btn-right mt-20" href="7-image-editing-tips-to-dominate-in-online-business">Read More <i class="ti ti-angle-double-right"></i></a>
                                </div>
                            </div>
                            <!-- featured-imagebox-blog end -->
                            <!-- featured-imagebox-blog -->
                            <div class="featured-imagebox featured-imagebox-blog">
                                <div class="featured-thumbnail">
                                    <!-- featured-thumbnail -->
                                    <img class="img-fluid" src="{{ asset('frontend/images/') }}/blog/visual_content.png" alt="">
                                    <div class="ttm-blog-overlay-iconbox">
                                        <a href="8-reasons-why-visual-content-is-important-for-online-marketing"><i class="ti ti-plus"></i></a>
                                    </div>
                                    <div class="ttm-box-view-overlay"></div>
                                </div>
                                <div class="featured-content">
                                    <!-- featured-content -->
                                    <div class="ttm-box-post-date">
                                        <!-- ttm-box-post-date -->
                                        <span class="ttm-entry-date">
                                            <time class="entry-date" datetime="2019-01-16T07:07:55+00:00">13<span class="entry-month entry-year">Feb</span></time>
                                        </span>
                                    </div>
                                    <div class="featured-title">
                                        <!-- featured-title -->
                                        <h5><a href="8-reasons-why-visual-content-is-important-for-online-marketing">Eight Reasons Why Visual Content is Important for Online Marketing</a></h5>
                                    </div>
                                    <div class="post-meta">
                                        <!-- post-meta -->
                                        <span class="ttm-meta-line"><i class="fa fa-comments"></i> comments</span>
                                        <span class="ttm-meta-line"><i class="fa fa-user"></i> Shehala</span>

                                    </div>
                                    <div class="featured-desc">
                                        <!-- featured-description -->
                                        <p>Every day millions of contents are posted online in different forms of posts like blog articles, e-books</p>
                                    </div>
                                    <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-skincolor btn-inline ttm-icon-btn-right mt-20" href="8-reasons-why-visual-content-is-important-for-online-marketing">Read More <i class="ti ti-angle-double-right"></i></a>
                                </div>
                            </div>
                            <!-- featured-imagebox-blog end -->

                        </div>
                    </div>
                    <!-- row end -->
                </div>
            </section>
            <!-- process-section end -->


        </div>
        <!--site-main end-->
        <div style="clear: both;"></div>
        <!--footer start-->
        
@endsection