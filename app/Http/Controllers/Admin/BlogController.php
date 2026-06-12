<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('categories')->latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug',
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'status' => 'required|in:draft,published,unpublished',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (Blog::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count++;
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('blogs/thumbnails', 'public');
        }

        $blog = Blog::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'published_at' => $request->published_at,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        $blog->categories()->attach($request->categories);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        $selectedCategories = $blog->categories->pluck('id')->toArray();
        return view('admin.blogs.edit', compact('blog', 'categories', 'selectedCategories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:blogs,slug,' . $blog->id,
            'content' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'status' => 'required|in:draft,published,unpublished',
            'published_at' => 'nullable|date',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
        ]);

        $slug = $request->slug ? Str::slug($request->slug) : Str::slug($request->title);
        if ($blog->slug !== $slug) {
            $originalSlug = $slug;
            $count = 1;
            while (Blog::where('slug', $slug)->where('id', '!=', $blog->id)->exists()) {
                $slug = $originalSlug . '-' . $count++;
            }
        } else {
            $slug = $blog->slug;
        }

        $thumbnailPath = $blog->thumbnail;
        if ($request->hasFile('thumbnail')) {
            if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            $thumbnailPath = $request->file('thumbnail')->store('blogs/thumbnails', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'thumbnail' => $thumbnailPath,
            'status' => $request->status,
            'is_featured' => $request->has('is_featured') ? 1 : 0,
            'published_at' => $request->published_at,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
        ]);

        $blog->categories()->sync($request->categories);

        return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->thumbnail && Storage::disk('public')->exists($blog->thumbnail)) {
            Storage::disk('public')->delete($blog->thumbnail);
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }

    public function uploadImage(Request $request)
    {
        // Allow webp and other standard formats
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048'
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('blogs/content', 'public');
            return response()->json(['url' => asset('storage/' . $path)]);
        }
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
