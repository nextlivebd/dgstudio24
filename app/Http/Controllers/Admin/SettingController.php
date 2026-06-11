<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        return view('admin.settings.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_title' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico,webp|max:1024',
            'og_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $settings = $request->except(['_token', 'logo', 'favicon', 'og_image']);

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        // Handle Image Uploads
        $this->handleUpload($request, 'logo');
        $this->handleUpload($request, 'favicon');
        $this->handleUpload($request, 'og_image');

        return redirect()->back()->with('success', 'Site settings updated successfully!');
    }

    private function handleUpload(Request $request, $key)
    {
        if ($request->hasFile($key)) {
            $file = $request->file($key);
            $filename = time() . '_' . $key . '.' . $file->getClientOriginalExtension();
            // Store directly to public/uploads folder so it's accessible without symlink
            $file->move(public_path('uploads/settings'), $filename);
            
            $path = 'uploads/settings/' . $filename;
            
            // Delete old file if exists
            $oldSetting = Setting::where('key', $key)->first();
            if ($oldSetting && $oldSetting->value && file_exists(public_path($oldSetting->value))) {
                unlink(public_path($oldSetting->value));
            }

            Setting::updateOrCreate(['key' => $key], ['value' => $path]);
        }
    }
}
