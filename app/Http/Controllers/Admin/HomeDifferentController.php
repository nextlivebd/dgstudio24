<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeDifferentSection;
use App\Models\HomeDifferentTab;
use Illuminate\Http\Request;

class HomeDifferentController extends Controller
{
    // ─── Section Header ─────────────────────────────────────────────────────────

    public function index()
    {
        $section = HomeDifferentSection::first();
        $tabs    = HomeDifferentTab::orderBy('order')->get();
        return view('admin.home-different.index', compact('section', 'tabs'));
    }

    public function editSection()
    {
        $section = HomeDifferentSection::firstOrNew([]);
        return view('admin.home-different.edit-section', compact('section'));
    }

    public function updateSection(Request $request)
    {
        $request->validate([
            'subtitle'        => 'nullable|string|max:255',
            'title'           => 'nullable|string|max:500',
            'title_highlight' => 'nullable|string|max:255',
            'status'          => 'boolean',
        ]);

        $section = HomeDifferentSection::firstOrNew([]);
        $data    = $request->all();
        $data['status'] = $request->has('status');

        $section->fill($data)->save();

        return redirect()->route('admin.home-different.index')->with('success', 'Section heading settings updated successfully.');
    }

    // ─── Tabs CRUD ──────────────────────────────────────────────────────────────

    public function createTab()
    {
        return view('admin.home-different.create-tab');
    }

    public function storeTab(Request $request)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'icon'                => 'nullable|string|max:255',
            'content_title'       => 'nullable|string|max:255',
            'content_description' => 'nullable|string',
            'order'               => 'integer|min:0',
            'status'              => 'boolean',
        ]);

        HomeDifferentTab::create([
            'title'               => $request->title,
            'icon'                => $request->icon,
            'content_title'       => $request->content_title,
            'content_description' => $request->content_description,
            'order'               => $request->input('order', 0),
            'status'              => $request->has('status'),
        ]);

        return redirect()->route('admin.home-different.index')->with('success', 'Tab created successfully.');
    }

    public function editTab(HomeDifferentTab $tab)
    {
        return view('admin.home-different.edit-tab', compact('tab'));
    }

    public function updateTab(Request $request, HomeDifferentTab $tab)
    {
        $request->validate([
            'title'               => 'required|string|max:255',
            'icon'                => 'nullable|string|max:255',
            'content_title'       => 'nullable|string|max:255',
            'content_description' => 'nullable|string',
            'order'               => 'integer|min:0',
            'status'              => 'boolean',
        ]);

        $tab->update([
            'title'               => $request->title,
            'icon'                => $request->icon,
            'content_title'       => $request->content_title,
            'content_description' => $request->content_description,
            'order'               => $request->input('order', 0),
            'status'              => $request->has('status'),
        ]);

        return redirect()->route('admin.home-different.index')->with('success', 'Tab updated successfully.');
    }

    public function destroyTab(HomeDifferentTab $tab)
    {
        $tab->delete();
        return redirect()->route('admin.home-different.index')->with('success', 'Tab deleted successfully.');
    }
}
