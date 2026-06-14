@extends('frontend.layouts.app')

@section('content')
<!-- page-title -->
@php
    $bgImage = get_setting('page_banner_image') ? asset(get_setting('page_banner_image')) : asset('frontend/images/aboutbg.jpg');
@endphp
<div class="contactbg" style="background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="title-box text-center">
                        <div class="page-title-heading">
                            <h1 class="title"> Contact Us</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="{{ url('/') }}"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                            </span>
                            <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                            <span> Contact us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--site-main start-->
<div class="site-main">

    <!-- services-slide-section -->
    <section class="ttm-row zero-padding-section clearfix">
        <div class="container">
            <div class="row no-gutters">
                <!-- row -->
                <div class="col-lg-5">
                    <div class="spacing-9">
                        <!-- section title -->
                        <div class="section-title with-desc clearfix">
                            <div class="title-header">
                                <h5>Come Visit Us At</h5>
                                <h2 class="title">Our Address</h2>
                            </div>
                        </div><!-- section title end -->
                        
                        @if(isset($contactInfos) && $contactInfos->isNotEmpty())
                            @foreach($contactInfos as $info)
                            <div class="row">
                                <div class="col-12">
                                    <div class="featured-icon-box style2 left-icon icon-align-top">
                                        <div class="featured-icon">
                                            <div class="ttm-icon ttm-icon_element-bgcolor-skincolor ttm-icon_element-size-md ttm-icon_element-style-round">
                                                <i class="fa fa-map-marker"></i>
                                            </div>
                                        </div>
                                        <div class="featured-content">
                                            <div class="featured-title">
                                                <h5>{{ $info->office_name }}</h5>
                                            </div>
                                            <div class="featured-desc">
                                                <p>
                                                    @if(is_array($info->addresses) && count($info->addresses) > 0)
                                                        @foreach($info->addresses as $address)
                                                            <i class="{{ is_array($address) ? ($address['icon'] ?? 'fa fa-map-marker') : 'fa fa-map-marker' }}"></i> {{ is_array($address) ? ($address['text'] ?? '') : $address }}<br>
                                                        @endforeach
                                                    @endif

                                                    @if(is_array($info->emails) && count($info->emails) > 0)
                                                        @foreach($info->emails as $email)
                                                            <i class="{{ is_array($email) ? ($email['icon'] ?? 'fa fa-envelope-o') : 'fa fa-envelope-o' }}"></i> <a href="mailto:{{ is_array($email) ? ($email['text'] ?? '') : $email }}"> {{ is_array($email) ? ($email['text'] ?? '') : $email }} </a><br>
                                                        @endforeach
                                                    @endif

                                                    @if(is_array($info->phones) && count($info->phones) > 0)
                                                        @foreach($info->phones as $phone)
                                                            <i class="{{ is_array($phone) ? ($phone['icon'] ?? 'fa fa-phone') : 'fa fa-phone' }}"></i> {{ is_array($phone) ? ($phone['text'] ?? '') : $phone }}<br>
                                                        @endforeach
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- separator -->
                            <div class="separator">
                                <div class="sep-line mt-25 mb-25"></div>
                            </div>
                            @endforeach
                        @else
                            <p>Contact information not available at the moment.</p>
                        @endif

                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="spacing-10 ttm-bgcolor-grey ttm-bg ttm-col-bgcolor-yes ttm-right-span">
                        <div class="ttm-col-wrapper-bg-layer ttm-bg-layer">
                            <div class="ttm-bg-layer-inner"></div>
                        </div>
                        <!-- section title -->
                        <div class="section-title with-desc clearfix">
                            <div class="title-header">
                                <h4>Please fill up below details and we will be in touch with you soon with the reply you desired.</h4>
                                <p>Fields marked with an * are required</p>
                            </div>
                        </div><!-- section title end -->
                        
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        
                        <form method="POST" action="{{ route('contact.submit') }}" accept-charset="UTF-8" id="ttm-quote-form" class="row ttm-quote-form clearfix">
                            @csrf
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input name="businessname" type="text" class="form-control bg-white" placeholder="Business Name">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input name="name" type="text" placeholder="Contact Person*" required="required" class="form-control bg-white">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input name="phone" type="text" placeholder="Phone" class="form-control bg-white">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <input name="email" type="text" placeholder="Email*" required="required" class="form-control bg-white">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label>Services you needed</label>
                                    <select class="form-control bg-white" name="services">
                                        <option value="website-designing" selected="selected">Website Designing</option>
                                        <option value="website-development">Website Development</option>
                                        <option value="web-programming">Web Programming</option>
                                        <option value="ecommerce-development">Ecommerce Development</option>
                                        <option value="mobile-application-development">Mobile Application Development</option>
                                        <option value="search-engine-optimization">Search Engine Optimization</option>
                                        <option value="other">Other Services</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label></label>
                                    <input name="website" type="text" placeholder="If you have existing website URL" class="form-control bg-white">
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <textarea name="message" rows="5" placeholder="Write A Message..." required="required" class="form-control bg-white"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="text-left">
                                    <button type="submit" id="submit" class="ttm-btn ttm-btn-size-md ttm-btn-bgcolor-skincolor">
                                        Submit Quote
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- row end -->
        </div>
    </section>
    <!-- services-slide-section end -->

    <!-- map-section -->
    <div class="ttm-row map-section clearfix">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="map-wrapper">
                        @if(isset($contactInfos) && $contactInfos->isNotEmpty())
                            @php
                                $corporateInfo = $contactInfos->where('is_corporate', 1)->where('map_embed', '!=', null)->first();
                                $mapInfo = $corporateInfo ?? $contactInfos->where('map_embed', '!=', null)->first();
                            @endphp
                            @if($mapInfo)
                                {!! $mapInfo->map_embed !!}
                            @else
                                <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1qlJ4DqNZifeFGX3ATAjxH9A35Nu9qLxA" width="100%" height="480"></iframe>
                            @endif
                        @else
                            <iframe src="https://www.google.com/maps/d/u/0/embed?mid=1qlJ4DqNZifeFGX3ATAjxH9A35Nu9qLxA" width="100%" height="480"></iframe>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- map-section end -->

</div>

@endsection
