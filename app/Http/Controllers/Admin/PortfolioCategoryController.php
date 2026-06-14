<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PortfolioCategory;
use Illuminate\Support\Str;

class PortfolioCategoryController extends Controller
{
    public function index()
    {
        $categories = PortfolioCategory::latest()->get();
        return view('admin.portfolio-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.portfolio-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (PortfolioCategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        PortfolioCategory::create([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status
        ]);

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Portfolio category created successfully.');
    }

    public function edit(PortfolioCategory $portfolioCategory)
    {
        return view('admin.portfolio-categories.edit', compact('portfolioCategory'));
    }

    public function update(Request $request, PortfolioCategory $portfolioCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|boolean'
        ]);

        $slug = Str::slug($request->name);
        if ($portfolioCategory->name !== $request->name) {
            $originalSlug = $slug;
            $count = 1;
            while (PortfolioCategory::where('slug', $slug)->where('id', '!=', $portfolioCategory->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        } else {
            $slug = $portfolioCategory->slug;
        }

        $portfolioCategory->update([
            'name' => $request->name,
            'slug' => $slug,
            'status' => $request->status
        ]);

        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Portfolio category updated successfully.');
    }

    public function destroy(PortfolioCategory $portfolioCategory)
    {
        $portfolioCategory->delete();
        return redirect()->route('admin.portfolio-categories.index')->with('success', 'Portfolio category deleted successfully.');
    }
}
