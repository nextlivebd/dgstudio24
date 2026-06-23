<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() { 
        $sliders = \App\Models\Slider::where('status', true)->orderBy('order')->get();
        $recentBlogs = \App\Models\Blog::with('categories')->where('status', 'published')->latest()->take(3)->get();
        $recentPortfolios = \App\Models\Portfolio::with('category')->where('status', 1)->latest()->take(6)->get();
        $homeAbout = \App\Models\HomeAboutSection::where('status', true)->first();
        $homeAboutFeatures = \App\Models\HomeAboutFeature::where('status', true)->orderBy('order')->get();
        $testimonialSection = \App\Models\TestimonialSection::where('status', true)->first();
        $testimonials = \App\Models\Testimonial::where('status', true)->orderBy('order')->get();
        $homeTrustedSection = \App\Models\HomeTrustedSection::where('status', true)->first();
        $homeTrustedFeatures = \App\Models\HomeTrustedFeature::where('status', true)->orderBy('order')->get();
        $homeTrustedCounters = \App\Models\HomeTrustedCounter::where('status', true)->orderBy('order')->get();
        $servicesSectionSetting = \App\Models\ServicesSectionSetting::where('status', true)->first();
        $homeCtaSection = \App\Models\HomeCtaSection::where('status', true)->first();
        $homeDifferentSection = \App\Models\HomeDifferentSection::where('status', true)->first();
        $homeDifferentTabs = \App\Models\HomeDifferentTab::where('status', true)->orderBy('order')->get();
        $homeVideoBanner = \App\Models\HomeVideoBanner::first();

        return view('frontend.pages.home', compact(
            'sliders', 'recentBlogs', 'recentPortfolios', 'homeAbout', 'homeAboutFeatures', 
            'testimonialSection', 'testimonials', 'homeTrustedSection', 'homeTrustedFeatures', 'homeTrustedCounters',
            'servicesSectionSetting', 'homeCtaSection', 'homeDifferentSection', 'homeDifferentTabs',
            'homeVideoBanner'
        )); 
    }
    
    public function portfolio() {
        $categories = \App\Models\PortfolioCategory::where('status', 1)->get();
        $portfolios = \App\Models\Portfolio::with('category')->where('status', 1)->latest()->get();
        return view('frontend.pages.portfolio', compact('categories', 'portfolios'));
    }

    public function blog(Request $request) {
        $query = \App\Models\Blog::with('categories')->where('status', 'published');

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            $query->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('content', 'like', '%' . $searchTerm . '%');
        }

        $blogs = $query->latest('published_at')->paginate(5);
        $categories = \App\Models\Category::withCount('blogs')->get();
        $latestBlogs = \App\Models\Blog::where('status', 'published')->latest('published_at')->take(3)->get();

        return view('frontend.pages.blog', compact('blogs', 'categories', 'latestBlogs'));
    }

    public function blogDetails($slug) {
        $blog = \App\Models\Blog::with('categories')->where('slug', $slug)->firstOrFail();
        
        // Increment views
        $blog->increment('views');

        $categories = \App\Models\Category::withCount('blogs')->get();
        $latestBlogs = \App\Models\Blog::where('status', 'published')->latest('published_at')->take(3)->get();

        return view('frontend.pages.blog-details', compact('blog', 'categories', 'latestBlogs'));
    }

    public function portfolioDetails($id, $slug = null) {
        $portfolio = \App\Models\Portfolio::with('category')->findOrFail($id);
        
        // Fetch related portfolios from the same category
        $relatedPortfolios = \App\Models\Portfolio::where('portfolio_category_id', $portfolio->portfolio_category_id)
                                                  ->where('id', '!=', $portfolio->id)
                                                  ->where('status', 1)
                                                  ->latest()
                                                  ->take(3)
                                                  ->get();
                                                  
        return view('frontend.pages.portfolio-details', compact('portfolio', 'relatedPortfolios'));
    }
    public function serviceDetails($slug) {
        $service = \App\Models\Service::with('category')->where('slug', $slug)->first();
        
        if ($service) {
            $relatedServices = \App\Models\Service::where('service_category_id', $service->service_category_id)
                                                  ->where('id', '!=', $service->id)
                                                  ->where('status', 1)
                                                  ->latest()
                                                  ->take(5)
                                                  ->get();

            return view('frontend.pages.service-details', compact('service', 'relatedServices'));
        }

        // If not a service, maybe it's a category slug (like web-development)
        $category = \App\Models\ServiceCategory::with('services', 'children.services')->where('slug', $slug)->first();
        if ($category) {
            // Find the first service of this category to display
            $firstService = $category->services->first() ?? ($category->children->first()->services->first() ?? null);
            if ($firstService) {
                return redirect()->route('service.details', $firstService->slug);
            }
        }
        // Check if it's a dynamic Page
        $page = \App\Models\Page::where('slug', $slug)->first();
        if ($page) {
            return view('frontend.pages.dynamic', compact('page'));
        }
        
        // Fallback to static blade file if DB entry doesn't exist (map hyphens to underscores for file check)
        $viewName = str_replace('-', '_', $slug);
        if (view()->exists("frontend.pages.{$viewName}")) {
            return view("frontend.pages.{$viewName}");
        }

        abort(404);
    }

    public function contactUs() {
        $contactInfos = \App\Models\ContactInformation::where('is_active', true)->get();
        return view('frontend.pages.contact_us', compact('contactInfos'));
    }
    

}
