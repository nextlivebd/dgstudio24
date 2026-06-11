<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index() { return view('frontend.pages.home'); }
    
    // Magic method to catch all other static page methods
    public function __call($method, $parameters)
    {
        // Convert camelCase method to kebab-case slug
        $slug = strtolower(preg_replace('/(?<!^)[A-Z]/', '-$0', $method));
        
        $page = \App\Models\Page::where('slug', $slug)->first();
        
        if ($page) {
            return view('frontend.pages.dynamic', compact('page'));
        }
        
        // Fallback to static blade file if DB entry doesn't exist
        if (view()->exists("frontend.pages.{$slug}")) {
            return view("frontend.pages.{$slug}");
        }
        
        abort(404);
    }
}
