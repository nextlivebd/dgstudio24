@extends('frontend.layouts.app')

@section('meta_title', $blog->meta_title ?? $blog->title)
@section('meta_description', $blog->meta_description ?? Str::limit(strip_tags($blog->content), 160))
@section('meta_keywords', $blog->meta_keywords)
@section('og_image', $blog->thumbnail ? asset('storage/' . $blog->thumbnail) : '')
@section('og_type', 'article')

@section('content')
<div class="home-slider">
</div>
@php
    $bgImage = get_setting('blog_banner_image') ? asset(get_setting('blog_banner_image')) : asset('frontend/images/aboutbg.jpg');
@endphp
<div class="about-bg" style="background-image: url('{{ $bgImage }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="ttm-page-title-row">
        <div class="container">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="title-box text-center">
                        <div class="page-title-heading">
                            <h1 class="title">{{ $blog->title }}</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="{{ url('/') }}"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                            </span>
                            <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                            <span>
                                <a title="Blog" href="{{ route('blog') }}">Blog</a>
                            </span>
                            <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                            <span>{{ \Illuminate\Support\Str::limit($blog->title, 20) }}</span>
                        </div>  
                    </div>
                </div>
            </div>
        </div>                      
    </div>
</div>

<div class="site-main">
    <!-- sidebar -->
    <div class="sidebar ttm-bgcolor-white clearfix">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 content-area">
                    <article class="post ttm-blog-classic clearfix">
                        <!-- post-featured-wrapper -->
                        @if($blog->thumbnail)
                        <div class="ttm-post-featured-wrapper ttm-featured-wrapper">
                            <div class="ttm-post-featured">
                                <img class="img-fluid w-100" src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}">
                            </div>
                        </div>
                        @endif
                        
                        <!-- ttm-blog-classic-content -->
                        <div class="ttm-blog-classic-content">
                            <div class="ttm-post-entry-header">
                                <div class="post-meta">
                                    <span class="ttm-meta-line byline"><i class="fa fa-user"></i>By Admin</span>
                                    <span class="ttm-meta-line entry-date"><i class="fa fa-calendar"></i><time class="entry-date published" datetime="{{ $blog->published_at ? $blog->published_at->toIso8601String() : $blog->created_at->toIso8601String() }}">{{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}</time></span>
                                    <span class="ttm-meta-line views"><i class="fa fa-eye"></i>{{ $blog->views }} Views</span>
                                </div>
                            </div>
                            <div class="entry-content">
                                <div class="ttm-box-desc-text mt-3">
                                    {!! $blog->content !!}
                                </div>
                                
                                <div class="separator">
                                    <div class="sep-line mt-25 mb-25"></div>
                                </div>
                                
                                <div class="ttm-blogbox-desc-footer">
                                    <div class="ttm-social-share-wrapper">
                                        <div class="ttm-social-share-title">Share This Post: </div>
                                        <div class="social-icons circle">
                                            <ul>
                                                <li class="facebook-icon"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                <li class="twitter-icon"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                                <li class="googleplus-icon"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                                <li class="linkedin-icon"><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <div class="col-lg-3 widget-area">
                    <aside class="widget widget-search">
                        <form role="search" method="get" class="search-form box-shadow" action="{{ route('blog') }}">
                            <div class="form-group">
                                <input name="search" type="text" class="form-control bg-white" placeholder="Search....">
                                <i class="fa fa-search"></i>
                            </div>
                        </form>
                    </aside>
                    <aside class="widget widget-categories">
                        <h3 class="widget-title">Categories</h3>
                        <ul>
                            @foreach($categories as $category)
                                <li><a href="#">{{ $category->name }} ({{ $category->blogs_count }})</a></li>
                            @endforeach
                        </ul>
                    </aside>
                    <aside class="widget post-widget">
                        <h3 class="widget-title">Latest News</h3>
                        <ul class="widget-post ttm-recent-post-list">
                            @foreach($latestBlogs as $latest)
                            <li>
                                @if($latest->thumbnail)
                                <a href="{{ route('blog.details', $latest->slug) }}"><img src="{{ asset('storage/' . $latest->thumbnail) }}" alt="post-img"></a>
                                @endif
                                <a href="{{ route('blog.details', $latest->slug) }}">{{ $latest->title }}</a>
                                <span class="post-date"><i class="fa fa-calendar"></i> {{ $latest->published_at ? $latest->published_at->format('F d, Y') : $latest->created_at->format('F d, Y') }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </aside>
                </div>
            </div><!-- row end -->
        </div>
    </div>
    <!-- sidebar end -->
</div>

@endsection
