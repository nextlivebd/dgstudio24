<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ServiceCategory;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index()
    {
        $categories = ServiceCategory::with('parent')->latest()->get();
        return view('admin.service-categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = ServiceCategory::whereNull('parent_id')->where('status', 1)->get();
        return view('admin.service-categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'parent_id' => 'nullable|exists:service_categories,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable',
            'status' => 'required|boolean'
        ]);

        $slug = Str::slug($request->name);
        $originalSlug = $slug;
        $count = 1;
        while (ServiceCategory::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        ServiceCategory::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => $slug,
            'icon' => $request->icon,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('admin.service-categories.index')->with('success', 'Service category created successfully.');
    }

    public function edit(ServiceCategory $serviceCategory)
    {
        $categories = ServiceCategory::whereNull('parent_id')->where('id', '!=', $serviceCategory->id)->where('status', 1)->get();
        return view('admin.service-categories.edit', compact('serviceCategory', 'categories'));
    }

    public function update(Request $request, ServiceCategory $serviceCategory)
    {
        $request->validate([
            'parent_id' => 'nullable|exists:service_categories,id',
            'name' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'description' => 'nullable',
            'status' => 'required|boolean'
        ]);

        $slug = Str::slug($request->name);
        if ($serviceCategory->name !== $request->name) {
            $originalSlug = $slug;
            $count = 1;
            while (ServiceCategory::where('slug', $slug)->where('id', '!=', $serviceCategory->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        } else {
            $slug = $serviceCategory->slug;
        }

        $serviceCategory->update([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => $slug,
            'icon' => $request->icon,
            'description' => $request->description,
            'status' => $request->status
        ]);

        return redirect()->route('admin.service-categories.index')->with('success', 'Service category updated successfully.');
    }

    public function destroy(ServiceCategory $serviceCategory)
    {
        $serviceCategory->delete();
        return redirect()->route('admin.service-categories.index')->with('success', 'Service category deleted successfully.');
    }
}
