@extends('frontend.layouts.app')

@section('content')
<!-- page-title -->
@php
    $bgImage = get_setting('service_banner_image') ? asset(get_setting('service_banner_image')) : asset('frontend/images/webdesign.jpg');
@endphp
<div class="webdesign-bg" style="background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="ttm-page-title-row">
        <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="ttm-page-title-row-inner">
                    <div class="page-title-heading">
                        <h2 class="title">{{ $service->title }}</h2>
                    </div>
                    <div class="breadcrumb-wrapper">
                        <span>
                            <a title="Homepage" href="{{ url('/') }}">Home</a>
                        </span>
                        <span>{{ $service->category->name ?? 'Service' }}</span>
                        <span>{{ $service->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- page-title end -->

<!-- site-main -->
<div class="site-main">
    <div class="ttm-row sidebar ttm-sidebar-left clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 widget-area">
                    <aside class="widget widget-nav-menu">
                        <ul class="widget-menu">
                            @foreach($globalServiceCategories as $category)
                                @php
                                    // If we don't have a dedicated category page, link to its first service
                                    $firstService = $category->services->first() ?? ($category->children->first()->services->first() ?? null);
                                    $link = $firstService ? route('service.details', $firstService->slug) : '#';
                                    
                                    $isActive = isset($service->category) && ($service->category->id == $category->id || $service->category->parent_id == $category->id);
                                @endphp
                                <li class="{{ $isActive ? 'active' : '' }}">
                                    <a href="{{ $link }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </aside>
                    
                    <aside class="widget widget-text">
                        <h3 class="widget-title">About Us</h3>
                        <div class="ttm-author-widget">
                            <h4 class="author-name">{{ get_setting('site_title', 'Global Graphic Giant') }}</h4>
                            <p class="author-widget_text">{{ get_setting('company_short_description', 'Global Graphic Giant is one of the fastest growing and forward thinking ITES solution companies in Bangladesh.') }}</p>
                        </div>
                    </aside>
              
                    <aside class="widget widget_media_image">
                        <div class="banner-img-box ttm-textcolor-white text-left">
                            <div class="featured-content featured-content-banner">
                                <i class="flaticon flaticon-call"></i>
                                <div class="featured-title ttm-box-title">
                                    <h5>How Can We Help?</h5>
                                </div>
                                <div class="featured-desc">
                                    <p>If you need any help, please<br> feel free to contact us.</p>
                                </div>
                                @php
                                    $mainPhones = json_decode(get_setting('main_phones', '[]'), true);
                                    $mainEmails = json_decode(get_setting('main_emails', '[]'), true);
                                    $topEmail = (is_array($mainEmails) && count($mainEmails) > 0) ? $mainEmails[0]['text'] : 'info@example.com';
                                @endphp
                                <ul>
                                    <li><i class="fa fa-phone"></i>
                                        @if(is_array($mainPhones) && count($mainPhones) > 0)
                                            {{ $mainPhones[0]['text'] }}
                                        @else
                                            +1 (416) 686-3111
                                        @endif
                                    </li>
                                    <li><i class="fa fa-envelope-o"></i><a href="mailto:{{ $topEmail }}">{{ $topEmail }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
                
                <div class="col-lg-9 content-area">
                    <div class="ttm-service-single-content-area">
                        @if($service->thumbnail_image)
                            <div class="ttm-service-description mb-30">
                                <img src="{{ asset($service->thumbnail_image) }}" alt="{{ $service->title }}" class="img-fluid w-100 rounded">
                            </div>
                        @endif
                        
                        <div class="ttm-service-description">
                            <h3>{{ $service->title }}</h3>
                            <div class="mt-20">
                                {!! $service->description !!}
                            </div>
                        </div>

                        @if($relatedServices->isNotEmpty())
                            <div class="mt-40">
                                <h4>Related Services</h4>
                                <div class="row mt-20">
                                    @foreach($relatedServices as $related)
                                        <div class="col-md-6 mb-30">
                                            <div class="featured-icon-box style1 border">
                                                <div class="featured-content p-4">
                                                    <div class="featured-title">
                                                        <h5><a href="{{ route('service.details', $related->slug) }}">{{ $related->title }}</a></h5>
                                                    </div>
                                                    <div class="featured-desc">
                                                        <p>{{ Str::limit(strip_tags($related->description), 100) }}</p>
                                                    </div>
                                                    <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-skincolor btn-inline mt-10" href="{{ route('service.details', $related->slug) }}">Read More <i class="ti ti-angle-double-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
</div>
<!-- site-main end -->
@endsection

