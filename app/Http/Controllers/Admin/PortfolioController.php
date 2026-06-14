<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Portfolio;
use App\Models\PortfolioCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class PortfolioController extends Controller
{
    public function index()
    {
        $portfolios = Portfolio::with('category')->latest()->get();
        return view('admin.portfolios.index', compact('portfolios'));
    }

    public function create()
    {
        $categories = PortfolioCategory::where('status', 1)->get();
        return view('admin.portfolios.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'project_date' => 'nullable|string|max:255',
            'website_url' => 'nullable|string|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean'
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Portfolio::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/portfolios'), $imageName);
            $imagePath = 'uploads/portfolios/' . $imageName;
        }

        Portfolio::create([
            'portfolio_category_id' => $request->portfolio_category_id,
            'title' => $request->title,
            'slug' => $slug,
            'client_name' => $request->client_name,
            'project_date' => $request->project_date,
            'website_url' => $request->website_url,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status
        ]);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio created successfully.');
    }

    public function edit(Portfolio $portfolio)
    {
        $categories = PortfolioCategory::where('status', 1)->get();
        return view('admin.portfolios.edit', compact('portfolio', 'categories'));
    }

    public function update(Request $request, Portfolio $portfolio)
    {
        $request->validate([
            'portfolio_category_id' => 'required|exists:portfolio_categories,id',
            'title' => 'required|string|max:255',
            'client_name' => 'nullable|string|max:255',
            'project_date' => 'nullable|string|max:255',
            'website_url' => 'nullable|string|max:255',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean'
        ]);

        $slug = Str::slug($request->title);
        if ($portfolio->title !== $request->title) {
            $originalSlug = $slug;
            $count = 1;
            while (Portfolio::where('slug', $slug)->where('id', '!=', $portfolio->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        } else {
            $slug = $portfolio->slug;
        }

        $imagePath = $portfolio->image;
        if ($request->hasFile('image')) {
            // Delete old image
            if ($portfolio->image && File::exists(public_path($portfolio->image))) {
                File::delete(public_path($portfolio->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/portfolios'), $imageName);
            $imagePath = 'uploads/portfolios/' . $imageName;
        }

        $portfolio->update([
            'portfolio_category_id' => $request->portfolio_category_id,
            'title' => $request->title,
            'slug' => $slug,
            'client_name' => $request->client_name,
            'project_date' => $request->project_date,
            'website_url' => $request->website_url,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => $request->status
        ]);

        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio updated successfully.');
    }

    public function destroy(Portfolio $portfolio)
    {
        if ($portfolio->image && File::exists(public_path($portfolio->image))) {
            File::delete(public_path($portfolio->image));
        }
        
        $portfolio->delete();
        return redirect()->route('admin.portfolios.index')->with('success', 'Portfolio deleted successfully.');
    }
}
