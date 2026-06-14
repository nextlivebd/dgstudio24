@extends('frontend.layouts.app')

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
                            <h1 class="title"> Blog</h1>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <span>
                                <a title="Homepage" href="{{ url('/') }}"><i class="ti ti-home"></i>&nbsp;&nbsp;Home</a>
                            </span>
                            <span class="ttm-bread-sep">&nbsp; : : &nbsp;</span>
                            <span> Blog</span>
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
            <!-- row -->
            <div class="row">
                <div class="col-lg-9 content-area">
                    
                    @if(request()->has('search'))
                        <div class="mb-4">
                            <h4>Search Results for: "{{ request()->search }}"</h4>
                        </div>
                    @endif

                    @forelse($blogs as $blog)
                    <article class="post ttm-blog-classic clearfix">
                        <!-- post-featured-wrapper -->
                        @if($blog->thumbnail)
                        <div class="ttm-post-featured-wrapper ttm-featured-wrapper">
                            <div class="ttm-post-featured">
                                <img class="img-fluid" src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}">
                            </div>
                        </div><!-- post-featured-wrapper end -->
                        @endif
                        
                        <!-- ttm-blog-classic-content -->
                        <div class="ttm-blog-classic-content">
                            <div class="ttm-post-entry-header">
                                <div class="post-meta">
                                    <span class="ttm-meta-line byline"><i class="fa fa-user"></i>By Admin</span>
                                    <span class="ttm-meta-line entry-date"><i class="fa fa-calendar"></i><time class="entry-date published" datetime="{{ $blog->published_at ? $blog->published_at->toIso8601String() : $blog->created_at->toIso8601String() }}">{{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}</time></span>
                                    <!-- Comment count hidden as requested -->
                                    <span class="ttm-meta-line views"><i class="fa fa-eye"></i>{{ $blog->views }} Views</span>
                                </div>
                            </div>
                            <div class="entry-content">
                                <header class="entry-header">
                                    <h2 class="entry-title"><a href="{{ route('blog.details', $blog->slug) }}">{{ $blog->title }}</a></h2>
                                </header>
                                <div class="ttm-box-desc-text">
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($blog->content), 300) }}</p>
                                </div>
                                <!-- separator -->
                                <div class="separator">
                                    <div class="sep-line mt-25 mb-25"></div>
                                </div>
                                <!-- separator -->
                                <div class="ttm-blogbox-desc-footer">
                                    <div class="ttm-blogbox-footer-readmore d-inline-block">
                                        <a class="ttm-btn ttm-btn-size-sm ttm-btn-color-skincolor btn-inline ttm-icon-btn-right" href="{{ route('blog.details', $blog->slug) }}">Read More <i class="ti ti-angle-double-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div><!-- ttm-blog-classic-content end -->
                    </article>
                    @empty
                        <div class="alert alert-warning">
                            No blog posts found.
                        </div>
                    @endforelse
                    
                    <!-- Pagination -->
                    <div class="ttm-pagination">
                        {{ $blogs->appends(request()->query())->links('pagination::bootstrap-4') }}
                    </div>
                </div>

                <div class="col-lg-3 widget-area">
                    <aside class="widget widget-search">
                        <form role="search" method="get" class="search-form box-shadow" action="{{ route('blog') }}">
                            <div class="form-group">
                                <input name="search" type="text" class="form-control bg-white" placeholder="Search...." value="{{ request('search') }}">
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
