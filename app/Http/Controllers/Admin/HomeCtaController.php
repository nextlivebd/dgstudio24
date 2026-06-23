<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeCtaSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeCtaController extends Controller
{
    public function index()
    {
        $section = HomeCtaSection::first();
        return view('admin.home-cta.index', compact('section'));
    }

    public function edit()
    {
        $section = HomeCtaSection::firstOrNew([]);
        return view('admin.home-cta.edit', compact('section'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'       => 'nullable|string|max:500',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:4096',
            'status'      => 'boolean',
        ]);

        $section = HomeCtaSection::firstOrNew([]);

        $data = $request->except('image');
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            // Delete old image if it exists and is not the default
            if ($section->image && File::exists(public_path($section->image)) && !str_contains($section->image, 'frontend/images/')) {
                File::delete(public_path($section->image));
            }
            $img      = $request->file('image');
            $imgName  = time() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/home-cta'), $imgName);
            $data['image'] = 'uploads/home-cta/' . $imgName;
        }

        $section->fill($data)->save();

        return redirect()->route('admin.home-cta.index')->with('success', 'Home CTA section settings updated successfully.');
    }
}
