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
                            
                            {{-- Single flex-column text group layer. All text stacks naturally without absolute-positioning overlaps. --}}
                            <rs-layer
                                id="slider-2-slide-{{ $key + 1 }}-layer-textgroup"
                                data-type="text"
                                data-rsp_ch="on"
                                data-xy="x:l;xo:50px,50px,40px,15px;y:m;yo:30px,20px,0px,0px;"
                                data-dim="w:560px,560px,700px,440px;"
                                data-text="w:normal;"
                                data-frame_0="x:-60;o:0;"
                                data-frame_1="e:Power3.easeOut;st:150;sp:700;sR:150;"
                                data-frame_999="o:0;st:w;sR:7900;">
                                <div class="slc-inner">
                                    @if($slider->subtitle)
                                        <div class="slc-subtitle">{{ $slider->subtitle }}</div>
                                        <div class="slc-divider"></div>
                                    @endif
                                    @if($slider->title_1 || $slider->title_2)
                                        <h2 class="slc-title">
                                            @if($slider->title_1){!! $slider->title_1 !!}@endif
                                            @if($slider->title_2) {!! $slider->title_2 !!}@endif
                                        </h2>
                                    @endif
                                    @if($slider->description)
                                        <div class="slc-desc">{!! $slider->description !!}</div>
                                    @endif
                                    @if($slider->button_2_text || $slider->button_1_text)
                                    <div class="slc-buttons">
                                        @if($slider->button_2_text)
                                            <a class="ttm-btn ttm-btn-size-md ttm-btn-bgcolor-skincolor" href="{{ url($slider->button_2_link) }}">{{ $slider->button_2_text }}</a>
                                        @endif
                                        @if($slider->button_1_text)
                                            <a class="ttm-btn ttm-btn-size-md ttm-btn-style-border ttm-btn-color-darkgrey" href="{{ url($slider->button_1_link) }}">{{ $slider->button_1_text }}</a>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </rs-layer>

                            @if($slider->front_image)
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-6" class="slider-front-img" data-type="image" data-rsp_ch="on" data-xy="x:r;xo:-70px,-70px,-123px,-267px;yo:220px,90px,66px,36px;" data-text="w:normal;s:20,20,12,7;l:0,0,15,9;" data-dim="w:578px,478px,362px,223px;h:564px,464px,353px,217px;"
                                data-vbility="t,t,f,f" data-frame_0="sX:0.9;sY:0.9;" data-frame_1="e:Linear.easeNone;st:100;sp:400;sR:100;" data-frame_999="o:0;st:w;sR:8500;"><img src="{{ Str::startsWith($slider->front_image, 'frontend/') ? asset($slider->front_image) : asset('storage/' . $slider->front_image) }}" alt="front-image-{{ $slider->id }}" width="578" height="564" data-no-retina>
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
                            
                            {{-- Description is now inside the single text group layer above --}}
                            
                            <rs-layer id="slider-2-slide-{{ $key + 1 }}-layer-11" class="ttm-bgcolor-skincolor slider-client" data-type="shape" data-rsp_ch="on" data-xy="x:c;xo:159px,159px,627px,386px;y:m;yo:299px,169px,38px,23px;" data-text="w:normal;s:20,20,12,7;l:0,0,15,9;" data-dim="w:150px,150px,93px,57px;h:150px,150px,93px,57px;"
                                data-vbility="t,t,f,f" data-border="bor:50%,50%,50%,50%;" data-frame_0="sX:0.9;sY:0.9;" data-frame_1="e:Linear.easeNone;st:310;sp:400;sR:310;" data-frame_999="o:0;st:w;sR:8290;">
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
            @if(isset($homeAbout) && $homeAbout)
            <section class="ttm-row aboutus-section-style2 clearfix home-page">
                <div class="container">
                    <div class="row no-gutters align-items-center">
                        <!-- row -->
                        <div class="col-lg-6">
                            <!-- ttm_single_image-wrapper -->
                            <div class="ttm_single_image-wrapper">
                                @if($homeAbout->image)
                                    <img class="img-fluid" src="{{ asset($homeAbout->image) }}" title="about-image" alt="about-image">
                                @else
                                    <img class="img-fluid" src="{{ asset('frontend/images/') }}/about2.jpg" title="single-img-two" alt="single-img-two">
                                @endif
                            </div>
                            <!-- ttm_single_image-wrapper end -->
                        </div>

                        <div class="col-lg-6">
                            <div class="spacing-4 ttm-bgcolor-grey res-991-mt-30">
                                <!-- section title -->
                                <div class="section-title with-desc clearfix">
                                    <div class="title-header">
                                        @if($homeAbout->subtitle)
                                            <h5>{{ $homeAbout->subtitle }}</h5>
                                        @endif
                                        @if($homeAbout->title)
                                            <h3 class="title">{{ $homeAbout->title }}</h3>
                                        @endif
                                    </div>
                                    @if($homeAbout->description)
                                    <div class="title-desc">
                                        <p>{{ $homeAbout->description }}</p>
                                    </div>
                                    @endif
                                </div>
                                <!-- section title end -->
                                <!-- row -->
                                @if(isset($homeAboutFeatures) && $homeAboutFeatures->isNotEmpty())
                                <div class="row no-gutters mt-20">
                                    @foreach($homeAboutFeatures as $feature)
                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                        <!--  featured-icon-box -->
                                        <div class="featured-icon-box style3 left-icon icon-align-top featured-content2">
                                            <div class="featured-icon">
                                                <!--  featured-icon -->
                                                <div class="ttm-icon ttm-icon_element-color-skincolor ttm-icon_element-size-lg">
                                                    @if($feature->icon)
                                                        <i class="{{ $feature->icon }}"></i>
                                                    @else
                                                        <i class="ti ti-star"></i>
                                                    @endif
                                                    <!--  ttm-icon -->
                                                </div>
                                            </div>
                                            <div class="featured-content featured-contenttest">
                                                <!--  featured-content -->
                                                <div class="featured-title">
                                                    <!--  featured-title -->
                                                    <h5>{{ $feature->title }}</h5>
                                                </div>
                                                @if($feature->description)
                                                <div class="featured-desc">
                                                    <!--  featured-desc -->
                                                    <p>{{ $feature->description }}</p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--  featured-icon-box END -->
                                    </div>
                                    @endforeach
                                </div>
                                @endif
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
            @endif
            <!-- aboutus-section end -->


            <!-- fid-section -->
            @if(isset($homeTrustedSection) && $homeTrustedSection)
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
                                                        @if($homeTrustedSection->subtitle)
                                                            <h5>{{ $homeTrustedSection->subtitle }}</h5>
                                                        @endif
                                                        <h2 class="title">{{ $homeTrustedSection->title }} @if($homeTrustedSection->title_highlight)<span>{{ $homeTrustedSection->title_highlight }}</span>@endif</h2>
                                                    </div>
                                                    @if($homeTrustedSection->description)
                                                        <div class="title-desc">
                                                            <p>{!! $homeTrustedSection->description !!}</p>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- section title end -->
                                                
                                                @if(isset($homeTrustedFeatures) && $homeTrustedFeatures->isNotEmpty())
                                                    <div class="row">
                                                        @foreach($homeTrustedFeatures as $feature)
                                                            <div class="col-md-4">
                                                                <!--  featured-icon-box -->
                                                                <div class="featured-icon-box style4 left-icon">
                                                                    @if($feature->icon)
                                                                        <div class="featured-icon">
                                                                            <!--  featured-icon -->
                                                                            <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-md">
                                                                                <i class="{{ $feature->icon }}"></i>
                                                                                <!--  ttm-icon -->
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="featured-content">
                                                                        <!--  featured-content -->
                                                                        <div class="featured-title">
                                                                            <!--  featured-title -->
                                                                            <h5 class="fw-500">{{ $feature->title }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!--  featured-icon-box END -->
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                                @if(isset($homeTrustedCounters) && $homeTrustedCounters->isNotEmpty())
                                                    <div class="row ttm-fid-row-wrapper">
                                                        @foreach($homeTrustedCounters as $counter)
                                                            <div class="col-md-3 col-sm-3 Completedbox">
                                                                <!--ttm-fid-->
                                                                <div class="ttm-fid inside ttm-fid-view-lefticon style1">
                                                                    @if($counter->icon)
                                                                        <div class="ttm-fid-left">
                                                                            <!--ttm-fid-left-->
                                                                            <div class="ttm-fid-icon-wrapper">
                                                                                <i class="{{ $counter->icon }}"></i>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="ttm-fid-contents text-left">
                                                                        <!--ttm-fid-contents-->
                                                                        <h4 class="ttm-fid-inner">
                                                                            <span data-appear-animation="animateDigits" data-from="0" data-to="{{ $counter->count }}" data-interval="5" data-before="" data-before-style="sup" data-after="" data-after-style="sub">{{ $counter->count }}</span>
                                                                        </h4>
                                                                        <h3 class="ttm-fid-title">{{ $counter->label }}</h3>
                                                                        <!--ttm-fid-title-->
                                                                    </div>
                                                                </div>
                                                                <!-- ttm-fid end-->
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
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
                                    @if(isset($servicesSectionSetting) && $servicesSectionSetting)
                                        @if($servicesSectionSetting->subtitle)
                                            <h5>{{ $servicesSectionSetting->subtitle }}</h5>
                                        @endif
                                        <h2 class="title">{{ $servicesSectionSetting->title }} @if($servicesSectionSetting->title_highlight)<span>{{ $servicesSectionSetting->title_highlight }}</span>@endif</h2>
                                    @else
                                        <h5>Our Services</h5>
                                        <h2 class="title">We run all kinds of Web Development, Image Design & 3D services with 19+ years of <span>experience</span></h2>
                                    @endif
                                </div>
                            </div>
                            <!-- section title end -->
                        </div>
                    </div>
                    <!-- row end -->
                    <!-- row -->
                    <div class="row">
                        @if(isset($globalServiceCategories) && $globalServiceCategories->isNotEmpty())
                            @foreach($globalServiceCategories as $category)
                                <div class="col-lg-4 col-md-4">
                                    <!-- featured-icon-box -->
                                    <div class="featured-icon-box style5 text-left mb-20">
                                        <div class="featured-icon">
                                            <!-- featured-icon-->
                                            <div class="ttm-icon ttm-icon_element-color-white ttm-icon_element-size-lg">
                                                <i class="{{ $category->icon ? (Str::startsWith($category->icon, 'flaticon-') ? 'flaticon ' . $category->icon : $category->icon) : 'flaticon flaticon-developer' }}"></i>
                                            </div>
                                        </div>
                                        <!-- featured-icon -->
                                        <div class="featured-content">
                                            <!-- featured-content -->
                                            <div class="featured-title">
                                                <h5>{{ $category->name }}</h5>
                                                <!-- featured-title -->
                                            </div>
                                            <div class="featured-desc">
                                                <!-- featured-description -->
                                                <p>{{ Str::limit($category->description ?? '', 150) }}</p>
                                            </div>
                                            <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-white btn-inline ttm-icon-btn-right mt-15" href="{{ route('service.details', $category->slug) }}">Read More <i class="ti ti-angle-double-right"></i></a>
                                        </div>
                                        <!-- featured-content END-->
                                    </div>
                                    <!-- featured-icon-box -->
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <!-- row end-->
                </div>
            </section>
            <!-- services-section end -->

            <!-- topzero-padding-section -->
            @if(isset($homeCtaSection) && $homeCtaSection)
            <section class="ttm-row zero-padding-section mt_95 res-991-mt-0 clearfix">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col-lg-3">
                            <!-- col-bg-img-three -->
                            <div class="col-bg-img-three ttm-bg ttm-col-bgimage-yes res-991-h-auto">
                                <div class="ttm-col-wrapper-bg-layer ttm-bg-layer" style="background-image: url('{{ asset($homeCtaSection->image ?? 'frontend/images/bg-image/Save_money.png') }}') !important;">
                                    <div class="ttm-bg-layer-inner"></div>
                                </div>
                            </div>
                            <!-- Responsive View image -->
                            <img src="{{ asset($homeCtaSection->image ?? 'frontend/images/bg-image/Save_money.png') }}" class="ttm-equal-height-image" alt="col-bgimage-3">
                        </div>
                        <div class="col-lg-9">
                            <div class="ttm-bgcolor-skincolor ttm-bg ttm-col-bgcolor-yes ttm-right-span">
                                <div class="ttm-col-wrapper-bg-layer ttm-bg-layer">
                                    <div class="ttm-bg-layer-inner"></div>
                                </div>
                                <div class="layer-content">
                                    <div class="spacing-6 ttm-textcolor-white">
                                        <h3 class="mb-5">{{ $homeCtaSection->title }}</h3>
                                        <p class="mb-0">{{ $homeCtaSection->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
            <!-- topzero-padding-section -->

            <!-- tab-section -->
            @if(isset($homeDifferentSection) && $homeDifferentSection && isset($homeDifferentTabs) && $homeDifferentTabs->isNotEmpty())
            <section class="ttm-row tab-section clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- section title -->
                            <div class="section-title text-center with-desc clearfix">
                                <div class="title-header">
                                    @if($homeDifferentSection->subtitle)
                                        <h5>{{ $homeDifferentSection->subtitle }}</h5>
                                    @endif
                                    <h2 class="title">{{ $homeDifferentSection->title }} @if($homeDifferentSection->title_highlight)<span>{{ $homeDifferentSection->title_highlight }}</span>@endif</h2>
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
                                    @foreach($homeDifferentTabs as $index => $tab)
                                        <li class="tab {{ $index === 0 ? 'active' : '' }}">
                                            <a href="#">
                                                @if($tab->icon)
                                                    <i class="flaticon {{ $tab->icon }}"></i>
                                                @endif
                                                {{ $tab->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- tabs end-->
                                <div class="content-tab width-100 box-shadow">
                                    @foreach($homeDifferentTabs as $index => $tab)
                                        <div class="content-inner {{ $index === 0 ? 'active' : '' }}" style="display: {{ $index === 0 ? 'block' : 'none' }};">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-left">
                                                        <h3 class="title fs-30">{{ $tab->content_title }}</h3>
                                                        <p>{{ $tab->content_description }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
            <!-- tab-section end -->

            <!-- testimonial-section end -->
            @if(isset($testimonialSection) && $testimonialSection)
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
                                        @if($testimonialSection->subtitle)
                                            <h5>{{ $testimonialSection->subtitle }}</h5>
                                        @endif
                                        <h2 class="title">{{ $testimonialSection->title }} @if($testimonialSection->title_highlight)<span>{{ $testimonialSection->title_highlight }}</span>@endif</h2>
                                    </div>
                                </div>
                                <!-- section title end -->
                                
                                @if(isset($testimonials) && $testimonials->count() > 0)
                                    <div class="testimonial-slide box-sahdow ttm-bgcolor-white col-bg-img-four style1 owl-carousel" data-item="1" data-nav="false" data-dots="true" data-auto="false">
                                        @forelse($testimonials as $t)
                                            <!-- testimonials -->
                                            <div class="testimonials text-center">
                                                <div class="testimonial-content">
                                                    <!-- testimonials-content -->
                                                    <div class="testimonial-avatar">
                                                        <div class="testimonial-img">
                                                            <!-- testimonials-img -->
                                                            <img class="img-center" src="{{ $t->avatar ? asset($t->avatar) : asset('frontend/images/testimonial/man.jpg') }}" alt="testimonial-img">
                                                        </div>
                                                    </div>
                                                    <blockquote>{{ $t->quote }}</blockquote>
                                                    <div class="ttm-ratting-star">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <i class="fa fa-star{{ $i <= $t->rating ? '' : '-o' }}"></i>
                                                        @endfor
                                                    </div>
                                                    <div class="testimonial-caption">
                                                        <!-- testimonials-caption -->
                                                        <h6>{{ $t->name }}</h6>
                                                        @if($t->position)
                                                            <label>{{ $t->position }}</label>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- testimonials END -->
                                        @empty
                                        @endforelse
                                    </div>
                                @endif

                                @if($testimonialSection->cta_text || $testimonialSection->cta_phone)
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
                                                    @if($testimonialSection->cta_text)
                                                        <div class="featured-desc">
                                                            <!-- featured desc -->
                                                            <p>{{ $testimonialSection->cta_text }}</p>
                                                        </div>
                                                    @endif
                                                    @if($testimonialSection->cta_phone)
                                                        <div class="featured-title">
                                                            <!-- featured title -->
                                                            <h5>Contact Us: <strong class="ttm-textcolor-skincolor">{{ $testimonialSection->cta_phone }}</strong></h5>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- featured-icon-box END-->
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <!-- spacing-2 END -->
                        </div>
                        <div class="col-lg-6">
                            <div class="position-relative res-991-mt-30">
                                <!-- ttm_single_image-wrapper -->
                                <div class="ttm_single_image-wrapper text-right">
                                    <img class="img-fluid" src="{{ $testimonialSection->right_image ? asset($testimonialSection->right_image) : asset('frontend/images/indicate2.jpg') }}" title="single-img-four" alt="single-img-four">
                                </div>
                                <!-- ttm_single_image-wrapper end -->
                                @if($testimonialSection->experience_count !== null)
                                    <div class="ttm-highlight-fid-style-1">
                                        <!--ttm-fid-->
                                        <div class="ttm-fid inside without-icon">
                                            <div class="ttm-fid-contents text-left">
                                                <h4 class="ttm-fid-inner">
                                                    <span data-appear-animation="animateDigits" data-from="0" data-to="{{ $testimonialSection->experience_count }}" data-interval="2" data-before="" data-before-style="sup" data-after="" data-after-style="sub">{{ $testimonialSection->experience_count }}</span>
                                                </h4>
                                                @if($testimonialSection->experience_label)
                                                    <h3 class="ttm-fid-title">{{ $testimonialSection->experience_label }}</h3>
                                                @endif
                                            </div>
                                        </div>
                                        <!-- ttm-fid end-->
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- row end -->
                </div>
            </section>
            @endif
            <!-- testimonial-section end -->->

            <!-- first-row-title-section -->
            @php
                $vb = $homeVideoBanner ?? null;
                $bgStyle = '';
                if ($vb && $vb->background_image) {
                    $bgStyle = 'background-image: url(' . asset($vb->background_image) . '); background-size: cover; background-position: center;';
                }
            @endphp
            @if(!$vb || $vb->status)
            <section class="ttm-row second-row-title-section mt_90 ttm-bgcolor-darkgrey ttm-bg ttm-bgimage-yes bg-img9 clearfix" @if($bgStyle) style="{{ $bgStyle }}" @endif>
                <div class="ttm-row-wrapper-bg-layer ttm-bg-layer"></div>
                <div class="container">
                    <div class="row">
                        <!-- row -->
                        <div class="col-lg-8 offset-lg-2">
                            <div class="text-center">

                                @if($vb)
                                    {{-- Logo display --}}
                                    @if($vb->logo_source === 'custom_logo' && $vb->custom_logo)
                                        <div class="mb-30">
                                            <img src="{{ asset($vb->custom_logo) }}" alt="Logo" style="max-height: 80px; object-fit: contain;">
                                        </div>
                                    @elseif($vb->logo_source === 'site_logo' && !$vb->video_url)
                                        <div class="mb-30">
                                            <img src="{{ get_setting('logo') ? asset(get_setting('logo')) : asset('frontend/images/shehalaitlimited.png') }}" alt="{{ get_setting('site_title', 'DG Studio') }} Logo" style="max-height: 80px; object-fit: contain;">
                                        </div>
                                    @endif
                                @endif

                                @if(!$vb || $vb->video_url)
                                <div class="ttm-play-icon-btn mb-35">
                                    <div class="ttm-play-icon-animation">
                                        <a href="{{ $vb && $vb->video_url ? $vb->video_url : 'https://www.youtube.com/embed/9fidoaaOn_4' }}" target="_blank" class="ttm_prettyphotouuu">
                                            <div class="ttm-icon ttm-icon_element-bgcolor-skincolor ttm-icon_element-size-sm ttm-icon_element-style-round">
                                                <i class="fa fa-play"></i>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endif

                                <!-- section-title -->
                                <div class="section-title row-title clearfix">
                                    <div class="title-header">
                                        <h2 class="title">
                                            {{ $vb ? $vb->title : 'We help to create your business identity &' }}
                                            @if($vb && $vb->title_highlight)
                                                <span>{{ $vb->title_highlight }}</span>
                                            @else
                                                <span>stunning on online,</span>
                                            @endif
                                        </h2>
                                    </div>
                                    <div class="title-desc">{{ $vb ? $vb->description : 'with Basic Website, Web Application, CMS Web Development, Dynamic Website to Advanced Level of Ecommerce Development.' }}</div>
                                </div>
                                <!-- section-title end -->

                                @if(!$vb || $vb->btn_text)
                                <div class="mt-40">
                                    <a href="{{ $vb && $vb->btn_url ? url($vb->btn_url) : url('portfolio') }}" class="ttm-btn ttm-btn-size-md ttm-btn-style-border ttm-btn-color-white">
                                        {{ $vb && $vb->btn_text ? $vb->btn_text : 'View Portfolio' }}
                                    </a>
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
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

            @if(isset($recentPortfolios) && $recentPortfolios->isNotEmpty())
                @foreach($recentPortfolios as $portfolio)
                <!-- Item -->
                <div class="ttm-box-col-wrapper col-lg-4 col-md-6 col-sm-6">
                    <div class="featured-imagebox featured-imagebox-portfolio style2">

                        <div class="featured-thumbnail">
                            @if($portfolio->image)
                                <img class="img-fluid" src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->title }}">
                            @else
                                <img class="img-fluid" src="{{ asset('frontend/images/portfolio-images/default.jpg') }}" alt="Default">
                            @endif
                        </div>

                        <div class="featured-content">
                            <div class="category">
                                <p>{{ $portfolio->category->name ?? 'Uncategorized' }}</p>
                            </div>

                            <div class="featured-title">
                                <h5>
                                    <a href="{{ url('portfolio-details/' . $portfolio->id . '/' . ($portfolio->category_id ?? 1)) }}">
                                        {{ $portfolio->title }}
                                    </a>
                                </h5>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach
            @endif

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
                            @if(isset($recentBlogs) && $recentBlogs->isNotEmpty())
                                @foreach($recentBlogs as $blog)
                                <!-- featured-imagebox-blog -->
                                <div class="featured-imagebox featured-imagebox-blog">
                                    <div class="featured-thumbnail">
                                        <!-- featured-thumbnail -->
                                        @if($blog->thumbnail)
                                            <img class="img-fluid" src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}">
                                        @else
                                            <img class="img-fluid" src="{{ asset('frontend/images/blog/default.jpg') }}" alt="Default Thumbnail">
                                        @endif
                                        <div class="ttm-blog-overlay-iconbox">
                                            <a href="{{ url('blog/' . $blog->slug) }}"><i class="ti ti-plus"></i></a>
                                        </div>
                                        <div class="ttm-box-view-overlay"></div>
                                    </div>
                                    <div class="featured-content">
                                        <!-- featured-content -->
                                        <div class="ttm-box-post-date">
                                            <!-- ttm-box-post-date -->
                                            <span class="ttm-entry-date">
                                                <time class="entry-date" datetime="{{ $blog->created_at->toIso8601String() }}">{{ $blog->created_at->format('d') }}<span class="entry-month entry-year">{{ $blog->created_at->format('M') }}</span></time>
                                            </span>
                                        </div>
                                        <div class="featured-title">
                                            <!-- featured-title -->
                                            <h5><a href="{{ url('blog/' . $blog->slug) }}">{{ $blog->title }}</a></h5>
                                        </div>
                                        <div class="post-meta">
                                            <!-- post-meta -->
                                            <span class="ttm-meta-line"><i class="fa fa-user"></i> Admin</span>
                                        </div>
                                        <div class="featured-desc">
                                            <!-- featured-description -->
                                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 100) }}</p>
                                        </div>
                                        <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-skincolor btn-inline ttm-icon-btn-right mt-20" href="{{ url('blog/' . $blog->slug) }}">Read More <i class="ti ti-angle-double-right"></i></a>
                                    </div>
                                </div>
                                <!-- featured-imagebox-blog end -->
                                @endforeach
                            @endif
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