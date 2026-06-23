<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeAboutSection;
use App\Models\HomeAboutFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeAboutController extends Controller
{
    // ─── About Section ──────────────────────────────────────────────────────────

    public function index()
    {
        $section  = HomeAboutSection::first();
        $features = HomeAboutFeature::orderBy('order')->get();
        return view('admin.home-about.index', compact('section', 'features'));
    }

    public function editSection()
    {
        $section = HomeAboutSection::firstOrNew([]);
        return view('admin.home-about.edit-section', compact('section'));
    }

    public function updateSection(Request $request)
    {
        $request->validate([
            'subtitle'    => 'nullable|string|max:255',
            'title'       => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:4096',
            'status'      => 'boolean',
        ]);

        $section = HomeAboutSection::firstOrNew([]);

        $data = $request->except('image');
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            // Delete old image
            if ($section->image && File::exists(public_path($section->image))) {
                File::delete(public_path($section->image));
            }
            $img      = $request->file('image');
            $imgName  = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/home-about'), $imgName);
            $data['image'] = 'uploads/home-about/' . $imgName;
        }

        $section->fill($data)->save();

        return redirect()->route('admin.home-about.index')->with('success', 'About section updated successfully.');
    }

    // ─── Feature Boxes ──────────────────────────────────────────────────────────

    public function createFeature()
    {
        return view('admin.home-about.create-feature');
    }

    public function storeFeature(Request $request)
    {
        $request->validate([
            'icon'        => 'nullable|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'integer|min:0',
            'status'      => 'boolean',
        ]);

        HomeAboutFeature::create([
            'icon'        => $request->icon,
            'title'       => $request->title,
            'description' => $request->description,
            'order'       => $request->input('order', 0),
            'status'      => $request->has('status'),
        ]);

        return redirect()->route('admin.home-about.index')->with('success', 'Feature box created successfully.');
    }

    public function editFeature(HomeAboutFeature $feature)
    {
        return view('admin.home-about.edit-feature', compact('feature'));
    }

    public function updateFeature(Request $request, HomeAboutFeature $feature)
    {
        $request->validate([
            'icon'        => 'nullable|string|max:255',
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'order'       => 'integer|min:0',
            'status'      => 'boolean',
        ]);

        $feature->update([
            'icon'        => $request->icon,
            'title'       => $request->title,
            'description' => $request->description,
            'order'       => $request->input('order', 0),
            'status'      => $request->has('status'),
        ]);

        return redirect()->route('admin.home-about.index')->with('success', 'Feature box updated successfully.');
    }

    public function destroyFeature(HomeAboutFeature $feature)
    {
        $feature->delete();
        return redirect()->route('admin.home-about.index')->with('success', 'Feature box deleted successfully.');
    }
}
