<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Page;
use App\Models\Blog;
use App\Models\Visitor;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPages = Page::count();
        $totalContacts = Contact::count();
        $totalBlogs = Blog::count();
        $recentContacts = Contact::latest()->take(5)->get();
        
        $dailyTraffic = Visitor::whereDate('visited_date', now()->format('Y-m-d'))->count();
        $totalTraffic = Visitor::count();

        return view('admin.dashboard', compact(
            'totalPages', 'totalContacts', 'totalBlogs', 
            'recentContacts', 'dailyTraffic', 'totalTraffic'
        ));
    }
}
