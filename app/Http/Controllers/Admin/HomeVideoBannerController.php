<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeVideoBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class HomeVideoBannerController extends Controller
{
    public function index()
    {
        $banner = HomeVideoBanner::first();
        return view('admin.home-video-banner.index', compact('banner'));
    }

    public function edit()
    {
        $banner = HomeVideoBanner::firstOrNew([]);
        return view('admin.home-video-banner.edit', compact('banner'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title'            => 'nullable|string|max:500',
            'title_highlight'  => 'nullable|string|max:255',
            'description'      => 'nullable|string',
            'btn_text'         => 'nullable|string|max:255',
            'btn_url'          => 'nullable|string|max:500',
            'video_url'        => 'nullable|string|max:500',
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:8192',
            'logo_source'      => 'nullable|in:site_logo,custom_logo,none',
            'custom_logo'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:4096',
            'status'           => 'boolean',
        ]);

        $banner = HomeVideoBanner::firstOrNew([]);
        $data   = $request->except(['background_image', 'custom_logo']);
        $data['status'] = $request->has('status');

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            if ($banner->background_image && File::exists(public_path($banner->background_image))) {
                File::delete(public_path($banner->background_image));
            }
            $img     = $request->file('background_image');
            $imgName = time() . '_bg.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/home-video-banner'), $imgName);
            $data['background_image'] = 'uploads/home-video-banner/' . $imgName;
        }

        // Handle custom logo upload
        if ($request->hasFile('custom_logo')) {
            if ($banner->custom_logo && File::exists(public_path($banner->custom_logo))) {
                File::delete(public_path($banner->custom_logo));
            }
            $logo     = $request->file('custom_logo');
            $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('uploads/home-video-banner'), $logoName);
            $data['custom_logo'] = 'uploads/home-video-banner/' . $logoName;
        }

        $banner->fill($data)->save();

        return redirect()->route('admin.home-video-banner.index')->with('success', 'Video banner settings updated successfully.');
    }

    // Remove custom logo
    public function removeCustomLogo()
    {
        $banner = HomeVideoBanner::first();
        if ($banner && $banner->custom_logo && File::exists(public_path($banner->custom_logo))) {
            File::delete(public_path($banner->custom_logo));
        }
        if ($banner) {
            $banner->update(['custom_logo' => null, 'logo_source' => 'site_logo']);
        }
        return redirect()->route('admin.home-video-banner.index')->with('success', 'Custom logo removed.');
    }

    // Remove background image
    public function removeBackground()
    {
        $banner = HomeVideoBanner::first();
        if ($banner && $banner->background_image && File::exists(public_path($banner->background_image))) {
            File::delete(public_path($banner->background_image));
        }
        if ($banner) {
            $banner->update(['background_image' => null]);
        }
        return redirect()->route('admin.home-video-banner.index')->with('success', 'Background image removed. Default will be used.');
    }
}
