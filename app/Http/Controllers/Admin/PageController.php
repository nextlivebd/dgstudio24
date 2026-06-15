<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::orderBy('id')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
            'content' => 'nullable|string',
        ], [
            'slug.regex' => 'The slug must be in lowercase alphanumeric format with hyphens only (e.g. sample-page-slug).'
        ]);

        Page::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page created successfully.');
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
        ]);

        $page->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.pages.index')->with('success', 'Page updated successfully.');
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);
        $page->delete();

        return redirect()->route('admin.pages.index')->with('success', 'Page deleted successfully.');
    }
}
