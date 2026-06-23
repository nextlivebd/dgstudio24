<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category')->latest()->get();
        $section  = \App\Models\ServicesSectionSetting::first();
        return view('admin.services.index', compact('services', 'section'));
    }

    public function create()
    {
        $categories = ServiceCategory::where('status', 1)->get();
        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean'
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Service::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $imagePath = null;
        if ($request->hasFile('thumbnail_image')) {
            $image = $request->file('thumbnail_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $imagePath = 'uploads/services/' . $imageName;
        }

        Service::create([
            'service_category_id' => $request->service_category_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'thumbnail_image' => $imagePath,
            'status' => $request->status
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service created successfully.');
    }

    public function edit(Service $service)
    {
        $categories = ServiceCategory::where('status', 1)->get();
        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'service_category_id' => 'required|exists:service_categories,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable',
            'thumbnail_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|boolean'
        ]);

        $slug = Str::slug($request->title);
        if ($service->title !== $request->title) {
            $originalSlug = $slug;
            $count = 1;
            while (Service::where('slug', $slug)->where('id', '!=', $service->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        } else {
            $slug = $service->slug;
        }

        $imagePath = $service->thumbnail_image;
        if ($request->hasFile('thumbnail_image')) {
            if ($service->thumbnail_image && File::exists(public_path($service->thumbnail_image))) {
                File::delete(public_path($service->thumbnail_image));
            }

            $image = $request->file('thumbnail_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/services'), $imageName);
            $imagePath = 'uploads/services/' . $imageName;
        }

        $service->update([
            'service_category_id' => $request->service_category_id,
            'title' => $request->title,
            'slug' => $slug,
            'description' => $request->description,
            'thumbnail_image' => $imagePath,
            'status' => $request->status
        ]);

        return redirect()->route('admin.services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        if ($service->thumbnail_image && File::exists(public_path($service->thumbnail_image))) {
            File::delete(public_path($service->thumbnail_image));
        }
        
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Service deleted successfully.');
    }

    public function editSection()
    {
        $section = \App\Models\ServicesSectionSetting::firstOrNew([]);
        return view('admin.services.edit-section', compact('section'));
    }

    public function updateSection(Request $request)
    {
        $request->validate([
            'subtitle'        => 'nullable|string|max:255',
            'title'           => 'nullable|string|max:500',
            'title_highlight' => 'nullable|string|max:255',
            'status'          => 'boolean',
        ]);

        $section = \App\Models\ServicesSectionSetting::firstOrNew([]);
        $data    = $request->all();
        $data['status'] = $request->has('status');

        $section->fill($data)->save();

        return redirect()->route('admin.services.index')->with('success', 'Services section settings updated successfully.');
    }
}
