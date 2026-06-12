<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'subtitle' => 'nullable|string|max:255',
            'title_1' => 'nullable|string|max:255',
            'title_2' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_1_text' => 'nullable|string|max:255',
            'button_1_link' => 'nullable|string|max:255',
            'button_2_text' => 'nullable|string|max:255',
            'button_2_link' => 'nullable|string|max:255',
            'status' => 'boolean',
            'order' => 'integer',
        ]);

        $data = $request->except(['background_image', 'front_image']);
        $data['status'] = $request->has('status');

        if ($request->hasFile('background_image')) {
            $data['background_image'] = $request->file('background_image')->store('sliders', 'public');
        }

        if ($request->hasFile('front_image')) {
            $data['front_image'] = $request->file('front_image')->store('sliders', 'public');
        }

        Slider::create($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'background_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'front_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'subtitle' => 'nullable|string|max:255',
            'title_1' => 'nullable|string|max:255',
            'title_2' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'button_1_text' => 'nullable|string|max:255',
            'button_1_link' => 'nullable|string|max:255',
            'button_2_text' => 'nullable|string|max:255',
            'button_2_link' => 'nullable|string|max:255',
            'order' => 'integer',
        ]);

        $data = $request->except(['background_image', 'front_image']);
        $data['status'] = $request->has('status');

        if ($request->hasFile('background_image')) {
            if ($slider->background_image && Storage::disk('public')->exists($slider->background_image)) {
                Storage::disk('public')->delete($slider->background_image);
            }
            $data['background_image'] = $request->file('background_image')->store('sliders', 'public');
        }

        if ($request->hasFile('front_image')) {
            if ($slider->front_image && Storage::disk('public')->exists($slider->front_image)) {
                Storage::disk('public')->delete($slider->front_image);
            }
            $data['front_image'] = $request->file('front_image')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->background_image && Storage::disk('public')->exists($slider->background_image)) {
            Storage::disk('public')->delete($slider->background_image);
        }
        if ($slider->front_image && Storage::disk('public')->exists($slider->front_image)) {
            Storage::disk('public')->delete($slider->front_image);
        }
        
        $slider->delete();

        return redirect()->route('admin.sliders.index')->with('success', 'Slider deleted successfully.');
    }
}
