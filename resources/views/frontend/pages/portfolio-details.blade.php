@extends('frontend.layouts.app')

@section('content')
<!-- page-title -->
@php
    $bgImage = get_setting('portfolio_banner_image') ? asset(get_setting('portfolio_banner_image')) : asset('frontend/images/project.jpg');
@endphp
<div class="portfolio-bg" style="background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="page-title-heading">
                        <h2 class="title">{{ $portfolio->title }}</h2>
                    </div>
                    <div class="breadcrumb-wrapper">
                        <span>
                            <a title="Homepage" href="{{ route('home') }}">Home</a>
                        </span>
                        <span class="ttm-bread-sep">&nbsp; / &nbsp;</span>
                        <span>
                            <a title="Portfolio" href="{{ route('portfolio') }}">Portfolio</a>
                        </span>
                        <span class="ttm-bread-sep">&nbsp; / &nbsp;</span>
                        <span>{{ $portfolio->title }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>                    
</div><!-- ttm-page-title-row end-->
</div><!-- portfolio-bg end-->

<!--site-main start-->
<div class="site-main">

    <!-- portfolio-details-section -->
    <section class="ttm-row portfolio-details-section clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- ttm-portfolio-single-content -->
                    <div class="ttm-portfolio-single-content">
                        @if($portfolio->image)
                        <div class="ttm-portfolio-single-image mb-40">
                            <img class="img-fluid w-100" src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->title }}">
                        </div>
                        @endif
                        
                        <div class="ttm-portfolio-description">
                            <h3>Project Description</h3>
                            <div class="mt-20">
                                {!! $portfolio->description !!}
                            </div>
                        </div>
                    </div><!-- ttm-portfolio-single-content end-->
                </div>
                
                <div class="col-lg-4">
                    <div class="ttm-portfolio-single-sidebar">
                        <div class="ttm-pf-single-detail-box ttm-bgcolor-grey">
                            <ul class="ttm-pf-detailbox-list">
                                @if($portfolio->category)
                                <li>
                                    <i class="ti ti-folder"></i>
                                    <div class="ttm-pf-detailbox-content">
                                        <h5>Category</h5>
                                        <p>{{ $portfolio->category->name }}</p>
                                    </div>
                                </li>
                                @endif
                                
                                @if($portfolio->client_name)
                                <li>
                                    <i class="ti ti-user"></i>
                                    <div class="ttm-pf-detailbox-content">
                                        <h5>Client Name</h5>
                                        <p>{{ $portfolio->client_name }}</p>
                                    </div>
                                </li>
                                @endif
                                
                                @if($portfolio->project_date)
                                <li>
                                    <i class="ti ti-calendar"></i>
                                    <div class="ttm-pf-detailbox-content">
                                        <h5>Project Date</h5>
                                        <p>{{ $portfolio->project_date }}</p>
                                    </div>
                                </li>
                                @endif
                                
                                @if($portfolio->website_url)
                                <li>
                                    <i class="ti ti-world"></i>
                                    <div class="ttm-pf-detailbox-content">
                                        <h5>Website</h5>
                                        <p><a href="{{ $portfolio->website_url }}" target="_blank" rel="noopener">{{ $portfolio->website_url }}</a></p>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                        
                        @if($relatedPortfolios->isNotEmpty())
                        <div class="widget widget-recent-post mt-40">
                            <h3 class="widget-title">Related Projects</h3>
                            <ul class="widget-post ttm-recent-post-list">
                                @foreach($relatedPortfolios as $related)
                                <li>
                                    @if($related->image)
                                    <a href="{{ route('portfolio.details', [$related->id, $related->slug]) }}"><img src="{{ asset($related->image) }}" alt="post-img"></a>
                                    @endif
                                    <div class="post-detail">
                                        <a href="{{ route('portfolio.details', [$related->id, $related->slug]) }}">{{ $related->title }}</a>
                                        <span class="post-date"><i class="fa fa-calendar"></i>{{ $related->created_at->format('M d, Y') }}</span>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- portfolio-details-section end -->

</div><!--site-main end-->
@endsection
