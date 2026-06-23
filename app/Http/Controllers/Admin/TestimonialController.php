<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TestimonialSection;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TestimonialController extends Controller
{
    // ─── Index ──────────────────────────────────────────────────────────────────

    public function index()
    {
        $section      = TestimonialSection::first();
        $testimonials = Testimonial::orderBy('order')->get();
        return view('admin.testimonials.index', compact('section', 'testimonials'));
    }

    // ─── Section Settings ────────────────────────────────────────────────────────

    public function editSection()
    {
        $section = TestimonialSection::firstOrNew([]);
        return view('admin.testimonials.edit-section', compact('section'));
    }

    public function updateSection(Request $request)
    {
        $request->validate([
            'subtitle'          => 'nullable|string|max:255',
            'title'             => 'nullable|string|max:500',
            'title_highlight'   => 'nullable|string|max:255',
            'cta_text'          => 'nullable|string|max:500',
            'cta_phone'         => 'nullable|string|max:50',
            'right_image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'experience_count'  => 'nullable|integer|min:0',
            'experience_label'  => 'nullable|string|max:255',
            'status'            => 'boolean',
        ]);

        $section = TestimonialSection::firstOrNew([]);
        $data    = $request->except('right_image');
        $data['status'] = $request->has('status');

        if ($request->hasFile('right_image')) {
            if ($section->right_image && File::exists(public_path($section->right_image))) {
                File::delete(public_path($section->right_image));
            }
            $img     = $request->file('right_image');
            $imgName = time() . '.' . $img->getClientOriginalExtension();
            $dir     = public_path('uploads/testimonials');
            if (!File::exists($dir)) File::makeDirectory($dir, 0755, true);
            $img->move($dir, $imgName);
            $data['right_image'] = 'uploads/testimonials/' . $imgName;
        }

        $section->fill($data)->save();

        return redirect()->route('admin.testimonials.index')
                         ->with('success', 'Testimonial section updated successfully.');
    }

    // ─── Individual Testimonials CRUD ───────────────────────────────────────────

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'quote'    => 'required|string',
            'rating'   => 'required|integer|min:1|max:5',
            'position' => 'nullable|string|max:255',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order'    => 'integer|min:0',
        ]);

        $avatarPath = null;
        if ($request->hasFile('avatar')) {
            $img     = $request->file('avatar');
            $imgName = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $dir     = public_path('uploads/testimonials');
            if (!File::exists($dir)) File::makeDirectory($dir, 0755, true);
            $img->move($dir, $imgName);
            $avatarPath = 'uploads/testimonials/' . $imgName;
        }

        Testimonial::create([
            'name'     => $request->name,
            'quote'    => $request->quote,
            'rating'   => $request->rating,
            'position' => $request->position,
            'avatar'   => $avatarPath,
            'order'    => $request->input('order', 0),
            'status'   => $request->has('status'),
        ]);

        return redirect()->route('admin.testimonials.index')
                         ->with('success', 'Testimonial added successfully.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'quote'    => 'required|string',
            'rating'   => 'required|integer|min:1|max:5',
            'position' => 'nullable|string|max:255',
            'avatar'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'order'    => 'integer|min:0',
        ]);

        $avatarPath = $testimonial->avatar;
        if ($request->hasFile('avatar')) {
            if ($testimonial->avatar && File::exists(public_path($testimonial->avatar))) {
                File::delete(public_path($testimonial->avatar));
            }
            $img     = $request->file('avatar');
            $imgName = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $dir     = public_path('uploads/testimonials');
            if (!File::exists($dir)) File::makeDirectory($dir, 0755, true);
            $img->move($dir, $imgName);
            $avatarPath = 'uploads/testimonials/' . $imgName;
        }

        $testimonial->update([
            'name'     => $request->name,
            'quote'    => $request->quote,
            'rating'   => $request->rating,
            'position' => $request->position,
            'avatar'   => $avatarPath,
            'order'    => $request->input('order', 0),
            'status'   => $request->has('status'),
        ]);

        return redirect()->route('admin.testimonials.index')
                         ->with('success', 'Testimonial updated successfully.');
    }

    public function destroy(Testimonial $testimonial)
    {
        if ($testimonial->avatar && File::exists(public_path($testimonial->avatar))) {
            File::delete(public_path($testimonial->avatar));
        }
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
                         ->with('success', 'Testimonial deleted successfully.');
    }
}
