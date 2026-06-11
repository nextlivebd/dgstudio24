<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPages = \App\Models\Page::count();
        $totalContacts = \App\Models\Contact::count();
        $recentContacts = \App\Models\Contact::orderBy('created_at', 'desc')->take(5)->get();
        
        return view('admin.dashboard', compact('totalPages', 'totalContacts', 'recentContacts'));
    }
}
