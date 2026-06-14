@extends('frontend.layouts.app')

@section('content')
<!-- START homeclassicmain REVOLUTION SLIDER 6.0.1 -->
<div class="home-slider">
</div>
<!-- END REVOLUTION SLIDER -->

<!--site-main start-->
<div class="site-main">

    <!-- page-title -->
    @php
        $bgImage = get_setting('portfolio_banner_image') ? asset(get_setting('portfolio_banner_image')) : asset('frontend/images/project.jpg');
    @endphp
    <div class="portfolio-bg" style="background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="ttm-page-title-row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="title-box text-center">
                            <div class="page-title-heading">
                                <h1 class="title"> Portfolio </h1>
                            </div><!-- /.page-title-captions -->
                            <div class="breadcrumb-wrapper">
                                <span>
                                    <a title="Homepage" href="{{ route('home') }}"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                                </span>
                                <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                                <span>Portfolio</span>
                            </div>
                        </div>
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div>
    </div><!-- page-title end-->

    <!--site-main start-->
    <div class="site-main">
        <!-- sidebar -->
        <div class="sidebar ttm-sidebar ttm-bgcolor-white clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ttm-tabs text-center ttm-tab-style-classic style2">
                            <ul class="tabs mb-20">
                                <!-- tabs -->
                                <li class="tab active"><a href="#">All</a></li>
                                @foreach($categories as $category)
                                    <li class="tab"><a href="#">{{ $category->name }}</a></li>
                                @endforeach
                            </ul><!-- tabs end-->

                            <div class="content-tab width-100">
                                <!--content-tabs -->
                                
                                <!-- content-inner (ALL) -->
                                <div class="content-inner active">
                                    <div class="row multi-columns-row ttm-boxes-spacing-5px">
                                        @foreach($portfolios as $portfolio)
                                            <div class="ttm-box-col-wrapper col-lg-4 col-md-4 col-sm-6">
                                                <div class="featured-imagebox featured-imagebox-portfolio style2">
                                                    <div class="featured-thumbnail">
                                                        <img class="img-fluid" src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->title }}">
                                                    </div>
                                                    <div class="featured-content">
                                                        <div class="category">
                                                            <p>{{ $portfolio->category->name ?? 'Uncategorized' }}</p>
                                                        </div>
                                                        <div class="featured-title">
                                                            <h5><a href="{{ route('portfolio.details', [$portfolio->id, $portfolio->slug]) }}">{{ $portfolio->title }}</a></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- content-inner (ALL) -->
                                
                                <!-- content-inner (Per Category) -->
                                @foreach($categories as $category)
                                    <div class="content-inner">
                                        <div class="row multi-columns-row ttm-boxes-spacing-5px">
                                            @foreach($portfolios->where('portfolio_category_id', $category->id) as $portfolio)
                                                <div class="ttm-box-col-wrapper col-lg-4 col-md-4 col-sm-6">
                                                    <div class="featured-imagebox featured-imagebox-portfolio style2">
                                                        <div class="featured-thumbnail">
                                                            <img class="img-fluid" src="{{ asset($portfolio->image) }}" alt="{{ $portfolio->title }}">
                                                        </div>
                                                        <div class="featured-content">
                                                            <div class="category">
                                                                <p>{{ $category->name }}</p>
                                                            </div>
                                                            <div class="featured-title">
                                                                <h5><a href="{{ route('portfolio.details', [$portfolio->id, $portfolio->slug]) }}">{{ $portfolio->title }}</a></h5>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @if($portfolios->where('portfolio_category_id', $category->id)->isEmpty())
                                                <div class="col-12 text-center py-4">
                                                    <p>No portfolio items found in this category.</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                                <!-- content-inner (Per Category) -->
                                
                            </div>
                        </div>
                    </div>
                </div><!-- row end -->
            </div>
        </div>
        <!-- sidebar end -->
    </div><!--site-main end-->
</div>
@endsection
