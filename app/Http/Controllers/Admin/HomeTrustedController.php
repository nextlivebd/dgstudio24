<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeTrustedSection;
use App\Models\HomeTrustedFeature;
use App\Models\HomeTrustedCounter;
use Illuminate\Http\Request;

class HomeTrustedController extends Controller
{
    // ─── Section Settings ────────────────────────────────────────────────────────

    public function index()
    {
        $section  = HomeTrustedSection::first();
        $features = HomeTrustedFeature::orderBy('order')->get();
        $counters = HomeTrustedCounter::orderBy('order')->get();
        return view('admin.home-trusted.index', compact('section', 'features', 'counters'));
    }

    public function editSection()
    {
        $section = HomeTrustedSection::firstOrNew([]);
        return view('admin.home-trusted.edit-section', compact('section'));
    }

    public function updateSection(Request $request)
    {
        $request->validate([
            'subtitle'        => 'nullable|string|max:255',
            'title'           => 'nullable|string|max:500',
            'title_highlight' => 'nullable|string|max:255',
            'description'     => 'nullable|string',
            'status'          => 'boolean',
        ]);

        $section = HomeTrustedSection::firstOrNew([]);
        $data = $request->all();
        $data['status'] = $request->has('status');

        $section->fill($data)->save();

        return redirect()->route('admin.home-trusted.index')
                         ->with('success', 'Trusted section settings updated successfully.');
    }

    // ─── Features CRUD ──────────────────────────────────────────────────────────

    public function createFeature()
    {
        return view('admin.home-trusted.create-feature');
    }

    public function storeFeature(Request $request)
    {
        $request->validate([
            'icon'   => 'nullable|string|max:255',
            'title'  => 'required|string|max:255',
            'order'  => 'integer|min:0',
            'status' => 'boolean',
        ]);

        HomeTrustedFeature::create([
            'icon'   => $request->icon,
            'title'  => $request->title,
            'order'  => $request->input('order', 0),
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.home-trusted.index')
                         ->with('success', 'Feature created successfully.');
    }

    public function editFeature(HomeTrustedFeature $feature)
    {
        return view('admin.home-trusted.edit-feature', compact('feature'));
    }

    public function updateFeature(Request $request, HomeTrustedFeature $feature)
    {
        $request->validate([
            'icon'   => 'nullable|string|max:255',
            'title'  => 'required|string|max:255',
            'order'  => 'integer|min:0',
            'status' => 'boolean',
        ]);

        $feature->update([
            'icon'   => $request->icon,
            'title'  => $request->title,
            'order'  => $request->input('order', 0),
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.home-trusted.index')
                         ->with('success', 'Feature updated successfully.');
    }

    public function destroyFeature(HomeTrustedFeature $feature)
    {
        $feature->delete();
        return redirect()->route('admin.home-trusted.index')
                         ->with('success', 'Feature deleted successfully.');
    }

    // ─── Counters CRUD ──────────────────────────────────────────────────────────

    public function createCounter()
    {
        return view('admin.home-trusted.create-counter');
    }

    public function storeCounter(Request $request)
    {
        $request->validate([
            'icon'   => 'nullable|string|max:255',
            'count'  => 'required|integer|min:0',
            'label'  => 'required|string|max:255',
            'order'  => 'integer|min:0',
            'status' => 'boolean',
        ]);

        HomeTrustedCounter::create([
            'icon'   => $request->icon,
            'count'  => $request->count,
            'label'  => $request->label,
            'order'  => $request->input('order', 0),
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.home-trusted.index')
                         ->with('success', 'Counter created successfully.');
    }

    public function editCounter(HomeTrustedCounter $counter)
    {
        return view('admin.home-trusted.edit-counter', compact('counter'));
    }

    public function updateCounter(Request $request, HomeTrustedCounter $counter)
    {
        $request->validate([
            'icon'   => 'nullable|string|max:255',
            'count'  => 'required|integer|min:0',
            'label'  => 'required|string|max:255',
            'order'  => 'integer|min:0',
            'status' => 'boolean',
        ]);

        $counter->update([
            'icon'   => $request->icon,
            'count'  => $request->count,
            'label'  => $request->label,
            'order'  => $request->input('order', 0),
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.home-trusted.index')
                         ->with('success', 'Counter updated successfully.');
    }

    public function destroyCounter(HomeTrustedCounter $counter)
    {
        $counter->delete();
        return redirect()->route('admin.home-trusted.index')
                         ->with('success', 'Counter deleted successfully.');
    }
}
