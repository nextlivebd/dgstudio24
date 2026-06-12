@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h3 mb-0 text-gray-800">Blogs</h2>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Blog
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Categories</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($blogs as $blog)
                            <tr>
                                <td>
                                    @if($blog->thumbnail)
                                        <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="Thumbnail" width="80" class="img-thumbnail">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>
                                    {{ $blog->title }}
                                    @if($blog->is_featured)
                                        <span class="badge bg-warning text-dark ms-1"><i class="fas fa-star"></i> Featured</span>
                                    @endif
                                </td>
                                <td>
                                    @foreach($blog->categories as $category)
                                        <span class="badge bg-info text-dark">{{ $category->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @if($blog->status == 'published')
                                        <span class="badge bg-success">Published</span>
                                    @elseif($blog->status == 'draft')
                                        <span class="badge bg-secondary">Draft</span>
                                    @else
                                        <span class="badge bg-danger">Unpublished</span>
                                    @endif
                                </td>
                                <td>{{ $blog->views }}</td>
                                <td>
                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this blog?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No blogs found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
